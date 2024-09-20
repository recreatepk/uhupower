<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model', 'PM');
		$this->load->model('Quotation_model', 'QM');
		$this->load->model('Quotation_service_model','QSM'); // Get_quotation_service
		$this->load->model('Supplier_model', 'SM');
		$this->load->model('Service_model','Ser_M');
		$this->load->model('Invoice_model', 'IM');
		$this->load->model('User_model', 'UM');
		$this->load->library('User_Utility');

	}

	public function index()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(38);
		$input_data = $this->input->post('dates');

		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-', $input_data);
			$start_date = date('Y/m/d`', strtotime($temp[0]));
			$end_date = date('Y/m/d', strtotime($temp[1]));
			// echo 'with date';	
		} else {
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d', strtotime($one_week));
			$end_date = date('Y/m/d', strtotime($current_date));
		}

		$data['qoutations'] = $this->QM->Get_quotations_w_supplier_date($start_date, $end_date);

		$quotes_ids = [];
		foreach ($data['qoutations'] as $quotes) {
			$quotes_ids[] = $quotes['quotation_id'];
		}
		$data['quotes_service'] = $this->QSM->Get_quotation_service($quotes_ids);
		$this->load->view('qoutation/qoutations', $data);
	}

	public function add_qoutation()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(39);
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$data['products'] = $this->PM->Get_all_products();
		$data['services'] = $this->Ser_M->Get_services();
		$data['product_categories'] = $this->PM->Get_all_product_cat();

		$this->load->view('qoutation/add_qoutation', $data);
	}

	public function adding_quotation()
	{

		$data = $this->input->post();

		$quote_data['quotation_supplier_id'] = $data['purchase_order_supplier_id'];
		$quote_data['quotation_order_date'] = $data['purchase_order_date'];
		$quotation_id = $this->QM->Insert_quotation($quote_data);

		$quote_detail['quotation_id'] = $quotation_id;
		$quote_detail['subject'] = $data['subject'];
		$quote_detail['compnay_name'] = $data['compnay_name'];
		$quote_detail['warranty'] = $data['warranty'];
		$quote_detail['p_terms'] = $data['p_terms'];
		$quote_detail['delivery'] = $data['delivery'];
		$quote_detail['validity'] = $data['validity'];
		$quote_detail['notes'] = $data['notes'];

		$this->QM->Insert_qutation_details($quote_detail);

		foreach ($data['products'] as $quotation) {
			$quote_product_data['quotation_id'] = $quotation_id;
			$quote_product_data['quotation_product_id'] = $quotation['purchase_order_product_id'];
			$quote_product_data['quotation_qty'] = $quotation['purchase_order_product_qty'];
			$quote_product_data['quotation_cost'] = $quotation['purchase_order_product_cost'];
			$quote_product_data['quotation_tax'] = $quotation['purchase_order_product_tax'];
			$this->QM->Insert_quotation_product($quote_product_data);
		}

		$quote_service['quotation_id'] = $quote_detail['quotation_id'];
		foreach ($data['service'] as $service) {
			$quote_service['render_service_id'] = $service['service_id'];
			$quote_service['cost'] = $service['service_cost'];
			$quote_service['tax'] = $service['service_tax'];
			$this->QSM->Insert_quotation_service($quote_service);
		}

		$this->session->set_flashdata('add', 'add');
		redirect('Quotation/add_qoutation');
	}

	public function Delete_quotation($quotation_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(41);
		$this->QM->delete_quotation($quotation_id);
		$this->session->set_flashdata('del', 'del');
		redirect('Quotation');
	}

	public function change_quotation_status($quotation_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(38);
		$data['quotes'] = $this->QM->Get_quotation_w_supplier($quotation_id);
		$data['products'] = $this->QM->Get_quotation_products_w_names($quotation_id);
		$data['quotation_details'] = $this->QM->Get_quotation_details($quotation_id);
		$data['rendered_services'] = $this->QSM->Get_quotation_service($quotation_id);
		$data['employee_data'] = $this->UM->Get_user($data['quotation_details'][0]['employee_id']);
		$this->load->view('qoutation/quotation', $data);
	}

	public function change_status($status, $quotation_id)
	{
		if ($status == 1) {
			$this->QM->Change_status($status, $quotation_id);
			$this->session->set_flashdata('status', 'status');
			redirect("Quotation/change_quotation_status/$quotation_id");
		}

		if ($status == 2) {
			$this->QM->Change_status($status, $quotation_id);
			$this->session->set_flashdata('status', 'status');
			redirect("Quotation/change_quotation_status/$quotation_id");
		}

		if ($status == 3) {
			$this->user_utility->check_permission(42);
			$this->QM->Change_status($status, $quotation_id);
			$this->QM->Update_employee_id($quotation_id, $_SESSION['id']);
			$this->session->set_flashdata('status', 'status');
			redirect("Quotation/change_quotation_status/$quotation_id");

		}
		if ($status == 4) {
			$this->user_utility->check_permission(42);
			$this->make_invoice_by_quotation($quotation_id);
			$this->QM->Change_status($status, $quotation_id);
			$this->session->set_flashdata('status', 'status');
			redirect("Quotation/change_quotation_status/$quotation_id");

		}

	}

	public function make_invoice_by_quotation($quotation_id = '')
	{
		if ($quotation_id != '') {
			$quotation = $this->QM->Get_quotation($quotation_id);
			$invoice_data['quotation_id'] = $quotation[0]['quotation_id'];
			$invoice_data['supplier_id'] = $quotation[0]['quotation_supplier_id'];
			$invoice_data['invoice_date'] = $quotation[0]['quotation_order_date'];
			// print_r($invoice_data);die;
			$check1 = $this->qty_check_inventory_by_quote($quotation_id);

			if ($check1 != 0) {
				$id = $this->IM->make_invoice($invoice_data);
			} else {
				$this->session->set_flashdata('qty_error', 'qty_error');
				redirect("Quotation");
			}

			// print_r($id);die;
			$products = $this->QM->Get_quotation_products_w_names($quotation_id);


			foreach ($products as $product) {
				$check2 = $this->qty_check_inventory_by_quote($quotation_id);
				// print_r($product);die;
				if ($check2 == 0) {
					$this->session->set_flashdata('qty_error', 'qty_error');
					redirect("Quotation");
				} else {
					foreach ($check2 as $product_inventory) {
						if ($product_inventory['inventory_product_id'] == $product['quotation_product_id']) {
							$invoice_product_data['invoice_id'] = $id;
							$invoice_product_data['product_id'] = $product['quotation_product_id'];
							$invoice_product_data['invoice_qty'] = $product['quotation_qty'];
							$invoice_product_data['invoice_cost'] = $product['quotation_cost'];
							$invoice_product_data['invoice_tax'] = $product['quotation_tax'];
							$this->IM->Insert_invoice_product($invoice_product_data);
						}
					}
				}

			}
		}
	}

	public function edit_invoice($invoice_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(43);
		$data['invoices'] = $this->IM->Get_invoice($invoice_id);
		$data['all_products'] = $this->PM->Get_all_products();
		$data['all_suppliers'] = $this->SM->Get_all_supplier();
		$data['all_product_categories'] = $this->PM->Get_all_product_cat();
		$data['invoices_products'] = $this->IM->Get_invoice_products_w_names($invoice_id);
		// print_r($data);die;
		$this->load->view('invoice/edit_invoice', $data);

	}

	public function editing_invoice($invoice_id)
	{
		$invoice_supplier_id = $this->input->post('invoice_supplier_id');
		$invoice_order_date = $this->input->post('invoice_date');
		$products = $this->input->post('products');

		$invoice_data['invoice_date'] = $invoice_order_date;
		$invoicedata['supplier_id'] = $invoice_supplier_id;
		$this->IM->Update_invoice($invoice_data, $invoice_id);
		// print_r($products);die;
		foreach ($products as $product) {

			$invoice_product_data['invoice_qty'] = $product['invoice_qty'];
			$invoice_product_data['product_id'] = $product['product_id'];
			$invoice_product_data['invoice_cost'] = $product['invoice_cost'];
			$invoice_product_data['invoice_tax'] = $product['invoice_tax'];
			if (!isset($product['invoice_poduct_id']) || empty($product['invoice_poduct_id'])) {
				$invoice_product_data['invoice_id'] = $invoice_id;
				$invoice_product_data['invoice_purchase_order_id'] = $product['invoice_purchase_order_id'];
				$this->IM->Insert_invoice_product($invoice_product_data);
			} else {
				$this->IM->Update_invoice_products($invoice_product_data, $product['invoice_poduct_id']);
			}

		}
		$this->session->set_flashdata('edit', 'edit');
		redirect("Quotation/edit_invoice/$invoice_id");
	}


	public function edit_quotation($quotation_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(45);
		$data['quotation_data'] = $this->QM->Get_quotation($quotation_id);
		$data['quotation'] = $data['quotation_data'][0];
		$data['all_suppliers'] = $this->SM->Get_all_supplier();
		$data['all_products'] = $this->PM->Get_all_products();
		$data['quote_services'] = $this->QSM->Get_quotation_service($quotation_id);
		$data['services'] = $this->Ser_M->Get_services();
		$data['all_product_categories'] = $this->PM->Get_all_product_cat();
		$data['quotation_products'] = $this->QM->Get_quotation_products_w_names($quotation_id);
		$data['quotation_details_data'] = $this->QM->Get_quotation_details($quotation_id);
		$data['quotation_details'] = $data['quotation_details_data'][0];

		$this->load->view('qoutation/edit_quotation', $data);
	}


	public function editing_quotation($quotation_id)
	{
		$quotation_supplier_id = $this->input->post('quotation_supplier_id');
		$quotation_order_date = $this->input->post('quotation_order_date');
		$products = $this->input->post('products');
		$data = $this->input->post();

		$quote_data['quotation_order_date'] = $quotation_order_date;
		$quote_data['quotation_supplier_id'] = $quotation_supplier_id;
		$this->QM->Update_quotation($quote_data, $quotation_id);

		$quote_detail['quotation_id'] = $quotation_id;
		$quote_detail['subject'] = $data['subject'];
		$quote_detail['compnay_name'] = $data['compnay_name'];
		$quote_detail['warranty'] = $data['warranty'];
		$quote_detail['p_terms'] = $data['p_terms'];
		$quote_detail['delivery'] = $data['delivery'];
		$quote_detail['validity'] = $data['validity'];
		$quote_detail['notes'] = $data['notes'];

		$this->QM->Update_qutation_details($quote_detail, $quotation_id);
		// print_r($products);die;
		foreach ($products as $product) {
			$quotation_product_data['quotation_qty'] = $product['quotation_qty'];
			$quotation_product_data['quotation_product_id'] = $product['quotation_product_id'];
			$quotation_product_data['quotation_cost'] = $product['quotation_cost'];
			$quotation_product_data['quotation_tax'] = $product['quotation_tax'];

			if ($product['quotation_Products_id'] == '' || !isset($product['quotation_Products_id'])) {
				$quotation_product_data['quotation_id'] = $quotation_id;
				$this->QM->Insert_quotation_product($quotation_product_data);
			} else {
				$this->QM->Update_quotation_products($quotation_product_data, $product['quotation_Products_id']);
			}

		}

		$quote_service['quotation_id'] = $quotation_id;
		foreach ($data['service'] as $service) {
			$quote_service['render_service_id'] = $service['render_service_id'];
			$quote_service['cost'] = $service['cost'];
			$quote_service['tax'] = $service['tax'];
			$this->QSM->Update_quotation_service($quote_service, $quotation_id);
		}

		$this->session->set_flashdata('edit', 'edit');
		redirect("Quotation/edit_quotation/$quotation_id");
	}

	public function add_invoice()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(44);
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$data['products'] = $this->PM->Get_all_products();
		$data['product_categories'] = $this->PM->Get_all_product_cat();
		$this->load->view('invoice/add_invoice', $data);
	}

	public function adding_invoice()
	{
		$invoice_data['supplier_id'] = $this->input->post('supplier_id');
		$invoice_data['invoice_date'] = $this->input->post('purchase_order_date');
		$products = $this->input->post('products');

		$id = $this->IM->make_invoice($invoice_data);

		foreach ($products as $product) {
			$invoice_product_data['invoice_id'] = $id;
			$invoice_product_data['product_id'] = $product['product_id'];
			$invoice_product_data['invoice_qty'] = $product['invoice_qty'];
			$invoice_product_data['invoice_cost'] = $product['invoice_cost'];
			$invoice_product_data['invoice_tax'] = $product['invoice_tax'];
			$this->IM->Insert_invoice_product($invoice_product_data);

		}
		$this->session->set_flashdata('add', 'add');
		redirect("Quotation/add_invoice");

	}

	public function invoice()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(38);
		$input_data = $this->input->post('dates');

		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-', $input_data);
			$start_date = date('Y/m/d`', strtotime($temp[0]));
			$end_date = date('Y/m/d', strtotime($temp[1]));
			// echo 'with date';	
		} else {
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d', strtotime($one_week));
			$end_date = date('Y/m/d', strtotime($current_date));
		}

		$data['invoices'] = $this->IM->Get_invoice_w_supplier_date($start_date, $end_date);
		// print_r($data['invoices']);die;
		foreach ($data['invoices'] as $invoice) {
			$id[] = $invoice['invoice_id'];
		}
		if (isset($id)) {
			$data['invoice_sum'] = $this->IM->get_invoice_sum($id);
		} else {
			$data['invoice_sum'] = '';
		}

		// print_r($data['invoice_sum']);die;
		$this->load->view('invoice/invoices', $data);
	}

	public function print_invoice($invoice_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(43);
		$data['invoices'] = $this->IM->Get_invoice_w_supplier($invoice_id);
		$data['iv_products'] = $this->IM->Get_invoice_products_w_names($invoice_id);
		foreach ($data['iv_products'] as $product) {
			$data['unique_identifiers'][] = $this->IM->Get_unique_identifiers($product['product_id']);
		}
		$this->load->view('invoice/invoice', $data);

	}


	public function change_invoice_status($status, $invoice_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(43);
		if ($status == 1) {
			$data['invoice_status'] = 1;
			$this->IM->Change_invoice_status($data, $invoice_id);
			$this->session->set_flashdata('status', 'status');
			redirect("Quotation/print_invoice/$invoice_id");
		}
		if ($status == 2) {
			$data['invoice_status'] = 2;
			$this->IM->Change_invoice_status($data, $invoice_id);
			$this->session->set_flashdata('status', 'status');
			redirect("Quotation/print_invoice/$invoice_id");
		}
		if ($status == 3) {
			$unique_identifier_ids = $this->input->post('unique_identifier');
			if (isset($unique_identifier_ids) && !empty($unique_identifier_ids)) {
				$identifiers = $this->IM->Get_unique_identifier($unique_identifier_ids);
				$check = $this->qty_check_inventory($invoice_id);
				if ($check) {
					foreach ($identifiers as $sr_no) {
						$invoice_unique_identifier_data['invoice_id'] = $invoice_id;
						$invoice_unique_identifier_data['invoice_product_id'] = $sr_no['product_id'];
						$invoice_unique_identifier_data['sr_no'] = $sr_no['sr_no'];
						$invoice_unique_identifier_data['purchase_unique_identifier_id'] = $sr_no['unique_identifier_id'];
						$this->IM->Insert_invoice_unique_identifier($invoice_unique_identifier_data);
						$this->IM->Change_purchase_unique_identifier_sold($sr_no['unique_identifier_id']);
					}
					$this->create_DC($invoice_id);

					$data['invoice_status'] = 3;
					$this->IM->Change_invoice_status($data, $invoice_id);
					$this->session->set_flashdata('status', 'status');
					redirect("Quotation/print_invoice/$invoice_id");
				} else {
					$this->session->set_flashdata('qty_error', 'qty_error');
					redirect("Quotation/print_invoice/$invoice_id");
				}

			} else {
				$check = $this->qty_check_inventory($invoice_id);
				if ($check) {
					$data['invoice_status'] = 3;
					$this->create_DC($invoice_id);
					$this->IM->Change_invoice_status($data, $invoice_id);
					$this->session->set_flashdata('status', 'status');
					redirect("Quotation/print_invoice/$invoice_id");
				} else {
					$this->session->set_flashdata('qty_error', 'qty_error');
					redirect("Quotation/print_invoice/$invoice_id");
				}

			}
		}
	}


	public function minus_inventory($invoice_id)
	{
		$invoice_product_data = $this->IM->Get_invoice_products_w_names($invoice_id);
		foreach ($invoice_product_data as $product) {
			$inventory_data = $this->IM->Get_inventory_w_product_id($product['product_id']);
			foreach ($inventory_data as $inventory) {
				if ($inventory['inventory_product_id'] == $product['product_id']) {
					$this->IM->Update_inventory_qty($inventory['inventory_id'], $product['invoice_qty']);
				}
			}
			$inventory_data_update = $this->IM->Get_inventory_w_product_id($product['product_id']);
			foreach ($inventory_data_update as $inventory) {
				if ($inventory['inventory_product_qty'] == 0) {
					$this->IM->Delete_inventory_product($inventory['inventory_id']);
				}
			}
		}
	}


	public function qty_check_inventory($invoice_id)
	{
		$check = true;
		$invoice_product_data = $this->IM->Get_invoice_products_w_names($invoice_id);
		foreach ($invoice_product_data as $product) {
			$inventory_data = $this->IM->Get_inventory_w_product_id($product['product_id']);
			foreach ($inventory_data as $inventory) {
				if ($inventory['inventory_product_id'] == $product['product_id']) {
					if ($inventory['inventory_product_qty'] < $product['invoice_qty']) {
						$check = false;
						return $check;
					} else {
						$check = true;
						return $check;
					}
				}
			}
		}
	}

	public function qty_check_inventory_by_quote($quotation_id)
	{
		$check = true;
		$check1 = array();
		$invoice_product_data = $this->QM->Get_quotation_products_w_names($quotation_id);

		foreach ($invoice_product_data as $product) {
			$inventory_data = $this->IM->Get_inventory_w_product_id($product['product_id']);
			// print_r($inventory_data);die;
			foreach ($inventory_data as $inventory) {
				if ($inventory['inventory_product_id'] == $product['product_id']) {
					if ($inventory['inventory_product_qty'] < $product['quotation_qty']) {
						// Set $check to false if any product is not available
						$check = false;
					} else {
						$check = true;
						$data = array();
						$data['inventory_product_id'] = $inventory['inventory_product_id'];
						$check1[] = $data;
					}
				}
			}
		}
		// print_r($check1);die;

		if ($check) {
			// Return $check1 if all products are available in sufficient quantity
			return $check1;
		} else {
			// Return an empty array or a specific value to indicate that some products are not available.
			return '0';
		}
	}


	public function create_DC($invoice_id)
	{
		$invoice_product_data = $this->IM->Get_invoice_products_w_names($invoice_id);
		$invoice = $this->IM->Get_invoice_w_supplier($invoice_id);

		foreach ($invoice as $inv) {
			$dc_data['invoice_id'] = $inv['invoice_id'];
			$dc_data['supplier_id'] = $inv['supplier_id'];
			$dc_data['date'] = $inv['invoice_date'];

			$sell_dc_id = $this->IM->Insert_sell_dc($dc_data);
		}
		foreach ($invoice_product_data as $product) {
			$product_data['invoice_product_id'] = $product['invoice_poduct_id'];
			$product_data['product_id'] = $product['product_id'];
			$product_data['invoice_id'] = $product['invoice_id'];
			$product_data['invoice_qty'] = $product['invoice_qty'];
			$product_data['sell_dc_id'] = $sell_dc_id;
			$this->IM->Insert_dc_products($product_data);
		}
		$this->minus_inventory($invoice_id);
	}

	public function delivery_challan()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(48);
		$input_data = $this->input->post('dates');

		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-', $input_data);
			$start_date = date('Y/m/d`', strtotime($temp[0]));
			$end_date = date('Y/m/d', strtotime($temp[1]));
			// echo 'with date';	
		} else {
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d', strtotime($one_week));
			$end_date = date('Y/m/d', strtotime($current_date));
		}
		$data['dcs'] = $this->IM->Get_all_dc($start_date, $end_date);
		$this->load->view('invoice/dcs', $data);
	}

	public function view_dc($dc_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(49);

		$data['dcs'] = $this->IM->Get_dc_w_product_customer($dc_id);
		if (isset($data['dcs']) && !empty($data['dcs'])) {
			$invoice_id = $data['dcs'][0]['invoice_id'];
			$data['unique_identifiers'] = $this->IM->Get_identifier_invoice($invoice_id);
		}

		$this->load->view('invoice/dc', $data);

	}

	public function deliver_items($sell_dc_product_id, $sell_dc_id)
	{
		$this->IM->Change_selling_product_dc_receiving($sell_dc_product_id);
		$count_status_product = $this->IM->Get_count_dc_receiving($sell_dc_id);
		// print_r($count_status_product);die;
		if ($count_status_product[0]['count'] == 0) {
			$this->IM->change_selling_dc_status($sell_dc_id);
		}
		$this->session->set_flashdata('status', 'status');
		redirect("Quotation/view_dc/$sell_dc_id");

	}

	public function gate_pass()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(50);

		$input_data = $this->input->post('dates');

		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-', $input_data);
			$start_date = date('Y/m/d`', strtotime($temp[0]));
			$end_date = date('Y/m/d', strtotime($temp[1]));
			// echo 'with date';	
		} else {
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d', strtotime($one_week));
			$end_date = date('Y/m/d', strtotime($current_date));
		}
		$data['dcs'] = $this->IM->Get_all_dc($start_date, $end_date);
		$this->load->view('invoice/gate_passes', $data);
	}

	public function gate_pass_print($dc_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(49);

		$data['dcs'] = $this->IM->Get_dc_w_product_customer($dc_id);
		if (isset($data['dcs']) && !empty($data['dcs'])) {
			$invoice_id = $data['dcs'][0]['invoice_id'];
			$data['unique_identifiers'] = $this->IM->Get_identifier_invoice($invoice_id);
		}

		$this->load->view('invoice/gate_pass', $data);
	}

	public function change_delivery_address_dc($dc_id)
	{
		$data = $this->input->post();
		$this->IM->Change_delivery_address_dc($dc_id, $data);
		$this->session->set_flashdata('d_address', 'd_address');
		redirect("Quotation/view_dc/$dc_id");
	}

	public function delete_invoice($invoice_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(46);
		$this->IM->Delete_invoice($invoice_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Quotation/invoice");
	}


}
