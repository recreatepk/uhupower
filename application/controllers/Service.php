<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property User_Utility user_utility
 * @property CI input
 * @property Service_quote_model SQM
 * @property Service_model SM
 * @property Supplier_model Sup_M
 * @property Product_model PM
 * @property Invoice_model IM
 * @property Complaint_model CM
 * @property Session session
 **/
class Service extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'UM');
		$this->load->model('Service_model', 'SM');
		$this->load->model('Product_model', 'PM');
		$this->load->model('Supplier_model', 'Sup_M');
		$this->load->model('Invoice_model', 'IM');
		$this->load->model('Complaint_model', 'CM');
		$this->load->library('User_Utility');

	}

	public function index()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(67);
		$data['services'] = $this->SM->Get_services();
		$this->load->view('service/service', $data);
	}


	public function add_service()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(65);
		$this->load->view('service/add_service');

	}

	public function adding_service()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(65);

		$data = $this->input->post();

		$this->SM->Insert_service($data);
		$this->session->set_flashdata('add', 'add');
		redirect('Service/add_service');
	}

	public function edit_service($service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(66);
		$data['service'] = $this->SM->Get_service($service_id);
		$this->load->view('service/edit_service', $data);
	}

	public function editing_service($service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(66);
		$data = $this->input->post();
		$this->SM->Update_service($service_id, $data);
		$this->session->set_flashdata('edit', 'edit');
		redirect("Service/edit_service/$service_id");
	}

	public function delete_service($service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(68);
		$this->SM->Delete_service($service_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Service");

	}

	public function render_service()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(68);
		$data['services'] = $this->SM->Get_services();
		$data['customers'] = $this->Sup_M->Get_all_supplier();
		$data['products'] = $this->PM->Get_all_products();
		$data['complaints'] = $this->CM->Get_unassigned_complaints();
		$data['product_categories'] = $this->PM->Get_all_product_cat();
		$this->load->view('service/render_service', $data);

	}

	public function adding_render_service()
	{

		$service_data['sup_cus_id'] = $this->input->post('supplier_id');
		$service_data['date'] = $this->input->post('date');
		$services = $this->input->post('service');
		$products = $this->input->post('products');
		$service_data['complaint_id'] = $this->input->post('complaint_id');

		$render_service_id = $this->SM->Insert_render_service($service_data);
		$cm_data['status'] = 1;
		$cm_data['complaint_ref'] = $render_service_id;
		$this->CM->Update_complaint($cm_data, $service_data['complaint_id']);

		foreach ($services as $service) {
			$rendered_services['service_id'] = $service['service_id'];
			$rendered_services['render_service_id'] = $render_service_id;
			$rendered_services['service_cost'] = $service['service_cost'];
			$rendered_services['service_tax'] = $service['service_tax'];
			$this->SM->Insert_rendered_services($rendered_services);
		}

		if ($products != '' || !empty($products) || isset($products)) {
			foreach ($products as $product) {
				$render_service_product['product_id'] = $product['product_id'];
				$render_service_product['render_service_id'] = $render_service_id;
				$render_service_product['product_qty'] = $product['product_qty'];
				$render_service_product['product_cost'] = $product['product_cost'];
				$render_service_product['product_tax'] = $product['product_tax'];
				$this->SM->Insert_render_service_product($render_service_product);
			}
		}

		$this->session->set_flashdata('add', 'add');
		redirect("Service/assign_personel/$render_service_id");
	}

	public function assign_personel($render_service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(73);
		$data['rendered_services'] = $this->SM->Get_rendered_services($render_service_id);
		$data['rendered_services_product'] = $this->SM->Get_rendered_services_product($render_service_id);
		$data['service_assignments'] = $this->SM->Get_service_assignment($render_service_id);


		$data['employees'] = $this->SM->Get_all_workers();
		$this->load->view('service/assign_personel', $data);
	}

	public function view_rendering_services()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(71);
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

		$data['main_services'] = $this->SM->Get_rendered_service($start_date, $end_date);
		$data['rendered_services'] = $this->SM->Get_rendered_services_all(); //no date
		$data['service_assignments'] = $this->SM->Get_service_assignments(); //no date
		$data['customers'] = $this->Sup_M->Get_all_supplier(); //no date
		$data['employees'] = $this->SM->Get_all_users(); //no date
		$data['rendered_services_products'] = $this->SM->Get_rendered_services_products(); //no date
		// print_r($data['main_services']);die;
		$this->load->view('service/view_rendering_services', $data);
	}

	public function assigning_personel($render_service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(73);
		$employee_ids = $this->input->post();
		$this->SM->Delete_service_assignment($render_service_id);
		foreach ($employee_ids as $employee_id) {
			$data['render_service_id'] = $render_service_id;
			foreach ($employee_id as $id) {
				$data['employee_id'] = $id;
				$this->SM->Insert_service_assignment($data);
			}
		}
		$this->session->set_flashdata('assign', 'assign');
		redirect("Service/view_rendering_services");

	}

	public function change_status($render_service_id, $status)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(73);
		if ($status == 1) {
			$data['status'] = 2;
			$this->SM->change_status($render_service_id, $data);
			$this->session->set_flashdata('status', 'status');
			redirect("Service/view_rendering_services");
		}
		if ($status == 2) {

			$this->print_service($render_service_id);
		}
		if ($status == 3) {
			$data['status'] = 4;
			$cm_data['status'] = 2;
			$this->CM->Update_complaint_status($cm_data, $render_service_id);
			$product_data = $this->SM->Get_rendered_services_product($render_service_id);
			if (isset($product_data) && !empty($product_data) && $product_data != '' && $product_data[0]['product_id'] != '') {
				$invoice_id = $product_data[0]['invoice_id'];

				$check = $this->SM->Check_invoice_status($invoice_id);

				if ($check) {
					$check2 = $this->SM->Check_dc_status($invoice_id);
					if ($check2) {
						$this->SM->change_status($render_service_id, $data);
						$this->session->set_flashdata('completed', 'completed');
						redirect("Service/view_rendering_services");
					} else {
						$this->session->set_flashdata('dc', 'dc');
						redirect("Service/view_rendering_services");
					}
				} else {
					$this->session->set_flashdata('invoice', 'invoice');
					redirect("Service/view_rendering_services");
				}
			} else {
				$this->SM->change_status($render_service_id, $data);
				$this->session->set_flashdata('completed', 'completed');
				redirect("Service/view_rendering_services");
			}
		}
	}

	public function change_delivery_address_service($service_id, $status)
	{
		$data = $this->input->post();
		if ($status == 2) {
			$data['status'] = 3;
		}

		$cm_data['status'] = 2;
		$this->CM->Update_complaint_status($cm_data, $service_id);

		$this->SM->Update_delivery_address_service($service_id, $data);


		$products = $this->SM->Get_rendered_services_product($service_id);
		// print_r($products);die;
		if (!empty($products) && isset($products) && $products != '' && $products[0]['product_id'] != '') {
			$invoice_data['supplier_id'] = $products[0]['sup_cus_id'];
			$invoice_data['invoice_date'] = $products[0]['date'];

			$id = $this->IM->make_invoice($invoice_data);
			$this->SM->Update_render_service_product_invoice_id($service_id, $id);
			foreach ($products as $product) {
				$invoice_product_data['invoice_id'] = $id;
				$invoice_product_data['product_id'] = $product['product_id'];
				$invoice_product_data['invoice_qty'] = $product['product_qty'];
				$invoice_product_data['invoice_cost'] = $product['product_cost'];
				$invoice_product_data['invoice_tax'] = $product['product_tax'];
				$this->IM->Insert_invoice_product($invoice_product_data);
			}
			$this->session->set_flashdata('status', 'status');
			redirect("Service/view_rendering_services");
		} else {
			$this->session->set_flashdata('status', 'status');
			redirect("Service/view_rendering_services");
		}
	}


	public function delete_render_service($render_service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(73);
		$this->SM->Delete_render_service($render_service_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Service/view_rendering_services");
	}

	public function print_service($render_service_id)
	{
		$data['rendered_services'] = $this->SM->Get_rendered_services($render_service_id);
		$data['rendered_services_product'] = $this->SM->Get_rendered_services_product($render_service_id);
		$data['service_assignments'] = $this->SM->Get_service_assignment($render_service_id);
		$data['service_workers'] = $this->SM->Get_service_assignment_workers($render_service_id);
		$data['service_customer'] = $this->SM->Get_rendered_services_customer($render_service_id);
		// print_r($data);die;
		$this->load->view('service/print_service', $data);
	}

	public function edit_render_service($render_service_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(70);
		$data['rendered_services'] = $this->SM->Get_rendered_services($render_service_id);
		$data['rendered_services_product'] = $this->SM->Get_rendered_services_product($render_service_id);
		$data['service_assignments'] = $this->SM->Get_service_assignment($render_service_id);
		$data['service_workers'] = $this->SM->Get_service_assignment_workers($render_service_id);
		$data['service_customer'] = $this->SM->Get_rendered_services_customer($render_service_id);
		$data['services'] = $this->SM->Get_services();
		$data['customers'] = $this->Sup_M->Get_all_supplier();
		$data['products'] = $this->PM->Get_product_inventory();
		$data['product_categories'] = $this->PM->Get_all_product_cat();
		// print_r($data);die;
		$this->load->view('service/edit_rendering_services', $data);
	}


	public function editing_render_service($render_service_id)
	{

		$data['sup_cus_id'] = $this->input->post('supplier_id');
		$data['date'] = $this->input->post('date');
		$services = $this->input->post('service');
		$products = $this->input->post('products');
		$this->SM->Update_render_service($render_service_id, $data);

		$this->SM->Delete_rendered_service($render_service_id);
		$this->SM->Delete_service_product($render_service_id);
		// print_r($render_service_id);die;

		foreach ($services as $service) {
			$rendered_services['service_id'] = $service['service_id'];
			$rendered_services['render_service_id'] = $render_service_id;
			$rendered_services['service_cost'] = $service['service_cost'];
			$rendered_services['service_tax'] = $service['service_tax'];
			$this->SM->Insert_rendered_services($rendered_services);
		}
		if ($products != '' || !empty($products) || isset($products)) {
			foreach ($products as $product) {
				$render_service_product['product_id'] = $product['product_id'];
				$render_service_product['purchase_order_id'] = $product['purchase_order_id'];;
				$render_service_product['render_service_id'] = $render_service_id;
				$render_service_product['product_qty'] = $product['product_qty'];
				$render_service_product['product_cost'] = $product['product_cost'];
				$render_service_product['product_tax'] = $product['product_tax'];
				$this->SM->Insert_render_service_product($render_service_product);
			}
		}
		// print_r($this->input->post());die;
		$this->session->set_flashdata('edit', 'edit');
		redirect("Service/edit_render_service/$render_service_id");

	}


}
