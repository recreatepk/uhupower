<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property User_Utility user_utility
 * @property CI input
 * @property Service_quote_model SQM
 * @property Service_model Ser_M
 * @property Supplier_model SM
 * @property Product_model PM
 * @property Complaint_model CM
 * @property User_model UM
 * @property Invoice_model IM
 * @property Session session
 **/
class Service_quote extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Service_quote_model', 'SQM');
		$this->load->model('Service_model', 'Ser_M');
		$this->load->model('Supplier_model', 'SM');
		$this->load->model('Product_model', 'PM');
		$this->load->model('Complaint_model', 'CM');
		$this->load->model('User_model', 'UM');
		$this->load->model('Invoice_model', 'IM');
		$this->load->library('User_Utility');

	}

	public function index()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(94);
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

		$data['suppliers'] = $this->SM->Get_all_supplier();
		$data['quotes'] = $this->SQM->Get_service_quote($start_date, $end_date);
		foreach ($data['quotes'] as $quotes) {
			$quotes_ids[] = $quotes['service_quote_id'];
		}

		if (!isset($quotes_ids)) {
		} else {
			$data['quotes_service'] = $this->SQM->Get_service_quote_service($quotes_ids);
			$data['quotes_product'] = $this->SQM->Get_service_quote_product($quotes_ids);
		}

		$this->load->view('service_quote/service_quotes', $data);
	}

	public function delete_quote($service_quote_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(97);
		$this->SQM->Delete_service_quote($service_quote_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Service_quote/service_quotes");
	}

	public function add_service_quote()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(95);

		$data['suppliers'] = $this->SM->Get_all_supplier();
		$data['services'] = $this->Ser_M->Get_services();
		$data['products'] = $this->PM->Get_all_products();
		$data['complaints'] = $this->CM->Get_unassigned_complaints();
		$data['product_cats'] = $this->PM->Get_all_product_cat();

		$this->load->view('service_quote/add_service_quote', $data);
	}

	public function adding_service_quote()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(95);

		$data = $this->input->post();

		$service_quote['sup_cus_id'] = $data['supplier_id'];
		$service_quote['date'] = $data['date'];

		$service_quote_details['service_quote_id'] = $this->SQM->Insert_service_quote($service_quote);
		$service_quote_details['complaint_id'] = $data['complaint_id'];
		$service_quote_details['company_id'] = $data['company_id'];
		$service_quote_details['subject'] = $data['subject'];
		$service_quote_details['tnc'] = $data['tnc'];

		$this->SQM->Insert_service_quote_details($service_quote_details);

		$service_quote_product['service_quote_id'] = $service_quote_details['service_quote_id'];
		foreach ($data['products'] as $product) {
			$service_quote_product['product_id'] = $product['product_id'];
			$service_quote_product['qty'] = $product['product_qty'];
			$service_quote_product['cost'] = $product['product_cost'];
			$service_quote_product['tax'] = $product['product_tax'];
			$this->SQM->Insert_service_quote_products($service_quote_product);
		}


		$service_quote_service['service_quote_id'] = $service_quote_details['service_quote_id'];
		foreach ($data['service'] as $service) {
			$service_quote_service['render_service_id'] = $service['service_id'];
			$service_quote_service['cost'] = $service['service_cost'];
			$service_quote_service['tax'] = $service['service_tax'];
			$this->SQM->Insert_service_quote_service($service_quote_service);
		}


		$this->session->set_flashdata('add', 'add');
		redirect('service_quote/add_service_quote');

	}

	public function edit_quote($service_quote_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(96);
		$data['service_quotes'] = $this->SQM->Get_quote($service_quote_id);
		$data['service_quote_products'] = $this->SQM->Get_service_quote_product($service_quote_id);
		$data['quote_services'] = $this->SQM->Get_service_quote_service($service_quote_id);
		$data['services'] = $this->Ser_M->Get_services();
		$data['products'] = $this->PM->Get_all_products();
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$data['complaints'] = $this->CM->Get_unassigned_complaints();
		$data['product_categories'] = $this->PM->Get_all_product_cat();
		// print_r($data);die;
		$this->load->view('service_quote/edit_quote', $data);

	}

	public function editing_quote($service_quote_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(96);

		$data = $this->input->post();

		$service_quote['sup_cus_id'] = $data['sup_cus_id'];
		$service_quote['date'] = $data['date'];
		$this->SQM->Update_service_quote($service_quote, $service_quote_id);

		$service_quote_details['complaint_id'] = $data['complaint_id'];
		$service_quote_details['company_id'] = $data['company_id'];
		$service_quote_details['subject'] = $data['subject'];
		$service_quote_details['tnc'] = $data['tnc'];

		$this->SQM->Update_service_quote_details($service_quote_details, $service_quote_id);

		$service_quote_product['service_quote_id'] = $service_quote_id;
		foreach ($data['products'] as $product) {
			$service_quote_product['product_id'] = $product['id'];
			$service_quote_product['qty'] = $product['qty'];
			$service_quote_product['cost'] = $product['cost'];
			$service_quote_product['tax'] = $product['tax'];
			$this->SQM->Update_service_quote_products($service_quote_product, $service_quote_id);
		}


		$service_quote_service['service_quote_id'] = $service_quote_id;
		foreach ($data['service'] as $service) {
			$service_quote_service['render_service_id'] = $service['render_service_id'];
			$service_quote_service['cost'] = $service['cost'];
			$service_quote_service['tax'] = $service['tax'];
			$this->SQM->Update_service_quote_service($service_quote_service, $service_quote_id);
		}


		$this->session->set_flashdata('edit', 'edit');
		redirect("Service_quote/edit_quote/$service_quote_id");
	}

	public function change_service_quote_status($service_quote_id = null)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(38);
		$quotes = $this->SQM->Get_quotation_w_supplier($service_quote_id);
		$service_quote_details = $this->SQM->Get_service_quote_details($service_quote_id);
		$quote_service = $this->SQM->Get_quote_service($service_quote_id);
		$rendered_services = $this->SQM->Get_rendered_service($quote_service[0]['render_service_id']);
		$employee_detail = $this->UM->Get_user($service_quote_details[0]['employee_id']);

		$combined_data = [
			isset($quotes[0]) ? $quotes[0] : [],
			isset($service_quote_details[0]) ? $service_quote_details[0] : [],
			isset($quote_service[0]) ? $quote_service[0] : [],
			isset($rendered_services[0]) ? $rendered_services[0] : [],
			isset($employee_detail[0]) ? $employee_detail[0] : [],
		];

		$data['rendered_services'] = [$combined_data][0];
		$data['rendered_services_product'] = $this->SQM->Get_service_quote_product($service_quote_id);

		$this->load->view('service_quote/print_service', $data);
	}

	public function change_status($status, $service_quote_id)
	{
		if ($status == 1) {
			$this->SQM->Change_status($status, $service_quote_id);
			$this->session->set_flashdata('status', 'status');

			redirect("Service_quote/change_service_quote_status/$service_quote_id");
		}

		if ($status == 2) {
			$this->SQM->Change_status($status, $service_quote_id);
			$this->session->set_flashdata('status', 'status');

			redirect("Service_quote/change_service_quote_status/$service_quote_id");
		}

		if ($status == 3) {
			$this->user_utility->check_permission(42);
			$this->SQM->Change_status($status, $service_quote_id);
			$this->SQM->Update_employee_id($service_quote_id, $_SESSION['id']);
			$this->session->set_flashdata('status', 'status');

			redirect("Service_quote/change_service_quote_status/$service_quote_id");
		}

		if ($status == 4) {
			$this->user_utility->check_permission(42);
			$this->make_invoice_by_quotation($service_quote_id);
			$this->SQM->Change_status($status, $service_quote_id);
			$this->session->set_flashdata('status', 'status');

			redirect("Service_quote/change_service_quote_status/$service_quote_id");
		}
	}

	public function make_invoice_by_quotation($service_quote_id = '')
	{
		if ($service_quote_id != '') {
			$service_quote = $this->SQM->Get_quote($service_quote_id);
			$invoice_data['quotation_id'] = $service_quote[0]['service_quote_id'];
			$invoice_data['supplier_id'] = $service_quote[0]['sup_cus_id'];
			$invoice_data['invoice_date'] = $service_quote[0]['date'];
			$check1 = $this->qty_check_inventory_by_quote($service_quote_id);

			if ($check1 != 0) {
				$id = $this->IM->make_invoice($invoice_data);
			} else {
				$this->session->set_flashdata('qty_error', 'qty_error');
				redirect("service_quote");
			}
			$products = $this->SQM->Get_quotation_products_w_names($service_quote_id);

			foreach ($products as $product) {
				$check2 = $this->qty_check_inventory_by_quote($service_quote_id);

				if ($check2 == 0) {
					$this->session->set_flashdata('qty_error', 'qty_error');
					redirect("service_quote");
				} else {
					foreach ($check2 as $product_inventory) {
						if ($product_inventory['inventory_product_id'] == $product['service_quote_product_id']) {
							$invoice_product_data['invoice_id'] = $id;
							$invoice_product_data['product_id'] = $product['service_quote_product_id'];
							$invoice_product_data['invoice_qty'] = $product['qty'];
							$invoice_product_data['invoice_cost'] = $product['cost'];
							$invoice_product_data['invoice_tax'] = $product['tax'];
							$this->IM->Insert_invoice_product($invoice_product_data);
						}
					}
				}
			}
		}
	}

	public function qty_check_inventory_by_quote($service_quote_id)
	{
		$check = true;
		$check1 = array();
		$invoice_product_data = $this->SQM->Get_quotation_products_w_names($service_quote_id);

		foreach ($invoice_product_data as $product) {
			$inventory_data = $this->IM->Get_inventory_w_product_id($product['product_id']);

			foreach ($inventory_data as $inventory) {
				if ($inventory['inventory_product_id'] == $product['product_id']) {
					if ($inventory['inventory_product_qty'] < $product['qty']) {
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

		if ($check) {
			return $check1;
		} else {
			return '0';
		}
	}
}
