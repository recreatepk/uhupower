<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * @property user_utility $user_utility
 * @property input $input
 * @property Purchaseorder_model $PO
 * @property Product_model $PM
 * @property Supplier_model $SM
 * @property session $session
 * 
 */
class Purchase_order extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Purchaseorder_model','PO');
        $this->load->model('Product_model','PM');
        $this->load->model('Supplier_model','SM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$data = $this->input->post();
		$this->user_utility->check_login();
		$this->user_utility->check_permission(25);
		if (isset($data) && !empty($data)) {
			$tmp = explode('-', $data['dates']);
			$start_date = date('y-m-d',strtotime($tmp[0]));
			$end_date 	= date('y-m-d',strtotime($tmp[1]));
			$data['date'] = $data['dates'];
		}else{
			$start_date = date('y-m-d');
			$end_date 	= date('y-m-d');
			$data['date'] = date('d/m/Y'). '-' .date('d/m/Y');
		}
		$data['pos'] = $this->PO->Get_all_po_w_supplier($start_date,$end_date);
		
		$this->load->view('purchase_order/purchase_orders', $data);
	}

	public function add_purchase_order(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(23);
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$data['products'] = $this->PM->Get_all_products();
		$data['product_categories'] = $this->PM->Get_all_product_cat();
		$this->load->view('purchase_order/add_purchase_order',$data);
	}

	public function adding_purchase_order(){
		$data = $this->input->post();
		$PO_data['purchase_order_supplier_id'] = $data['purchase_order_supplier_id'];
		$PO_data['purchase_order_date'] = $data['purchase_order_date'];
		$PO_id = $this->PO->Insert_po($PO_data);
		foreach ($data['products'] as $product) {
			$product_data['purchase_order_product_id'] 	= $product['purchase_order_product_id'];
			$product_data['purchase_order_product_qty'] = $product['purchase_order_product_qty'];
			$product_data['purchase_order_product_cost']= $product['purchase_order_product_cost'];
			$product_data['purchase_order_product_tax'] = $product['purchase_order_product_tax'];
			$product_data['purchase_order_id'] = $PO_id;
			$this->PO->Insert_po_products($product_data);
		}
		$this->session->set_flashdata('add', 'add');
		redirect('Purchase_order/add_purchase_order');
	}
	public function change_purchase_order_status($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(27);
		$data['pos'] = $this->PO->Get_po($id);
		foreach ($data['pos'] as $po) {
			$data['suppliers'] = $this->SM->Get_supplier($po['purchase_order_supplier_id']);
			$data['Products'][] = $this->PO->Get_all_po_product($id);
		}
		$this->load->view('purchase_order/purchase_order', $data);

		
		
	}

	public function change_status($id,$status){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(27);
		
		if ($status == 2) {
			
			$products = $this->PO->Get_all_po_product($id);
			$dc_data['purchase_dc_purchase_order_id'] = $id;
			$data['purchase_order_status'] = 2;
			$this->PO->Change_purchase_order_status($id,$data);

			foreach ($products as $product) {
				$dc_data['purchase_dc_product_id'] = $product['purchase_order_product_id'];
				$dc_data['purchase_dc_qty'] = $product['purchase_order_product_qty'];
				$this->PO->Create_dc($dc_data);
				$this->session->set_flashdata('status_approve', 'status_approve');
			}
			
		}
		if ($status == 1) {
			$data['purchase_order_status'] = 1;
			$this->PO->Change_purchase_order_status($id,$data);
			$this->session->set_flashdata('status_lock', 'status_lock');
		}
		
		redirect('Purchase_order');
	}

// Yaha pe edit of delete ka kaam karna he
	public function edit_purchase_order($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(24);
		$data['pos'] 					= $this->PO->Get_po($id);
		$data['products'] 				= $this->PO->Get_all_po_product($id);
		$data['all_suppliers'] 			= $this->SM->Get_all_supplier();
		$data['all_products'] 			= $this->PM->Get_all_products();
		$data['all_product_categories'] = $this->PM->Get_all_product_cat();
		$this->load->view('purchase_order/edit_purchase_order', $data);
	}

	public function editing_purchase_order($id){
		$data = $this->input->post();
		$this->PO->Delete_po_products_w_po_id($id);
		$PO_data['purchase_order_supplier_id'] = $data['purchase_order_supplier_id'];
		$PO_data['purchase_order_date'] = $data['purchase_order_date'];
		$this->PO->Update_purchaseorder($PO_data,$id);
		foreach ($data['products'] as $product) {
			$product_data['purchase_order_product_id'] 	= $product['purchase_order_product_id'];
			$product_data['purchase_order_product_qty'] = $product['purchase_order_product_qty'];
			$product_data['purchase_order_product_cost']= $product['purchase_order_product_cost'];
			$product_data['purchase_order_product_tax'] = $product['purchase_order_product_tax'];
			$product_data['purchase_order_id'] = $id;
			$this->PO->Insert_po_products($product_data);
		}
		$this->session->set_flashdata('edit', 'edit');
		redirect("Purchase_order/edit_purchase_order/$id");
	}

	public function delete_purchase_order($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(26);
		$this->PO->Delete_Purchaseorder($id);
		$this->PO->Delete_po_products_w_po_id($id);
		$this->session->set_flashdata('del', 'del');
		redirect('Purchase_order');
	}


	public function print_purchase_order($id){
		$this->user_utility->check_login();
		$data['pos'] = $this->PO->Get_po($id);
		foreach ($data['pos'] as $po) {
			$data['suppliers'] = $this->SM->Get_supplier($po['purchase_order_supplier_id']);
			$data['Products'][] = $this->PO->Get_all_po_product($id);
		}
		$this->load->view('purchase_order/purchase_order_print', $data);
	}




	
}
