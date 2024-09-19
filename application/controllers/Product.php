<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Product_model','PM');
        $this->load->model('User_model','UM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(1);
		$data['products'] = $this->PM->Get_all_products_w_cat();
		$this->load->view('product/product', $data);
	}

	public function product_cat(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(15);
		$data['product_cats'] = $this->PM->Get_all_product_cat();
		$this->load->view('product/product_cat', $data);
		
	}

	public function add_product_cat(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(18);
		$this->load->view('product/add_product_cat');
	}

	public function adding_product_cat(){
		$data = $this->input->post();
		$this->PM->Insert_product_cat($data);
		$this->session->set_flashdata('add', 'add');
		redirect('product/add_product_cat');
	}

	public function edit_product_cat($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(16);
		$data['product'] = $this->PM->Get_product_cat($id);
		$this->load->view('product/edit_product_cat', $data);
	}

	public function editing_product_cat($id){
		$data = $this->input->post();
		$this->PM->Update_product_cat($id,$data);
		$this->session->set_flashdata('edit', 'edit');
		redirect("product/edit_product_cat/$id");
	}

	public function delete_product_cat($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(17);
		$this->PM->Delete_product_cat($id);
		$this->session->set_flashdata('del', 'del');
		redirect('product/product_cat');
	}







	public function add_product(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(7);
		$data['product_cats'] = $this->PM->Get_all_product_cat();
		$this->load->view('product/add_product', $data);
	}

	public function adding_product(){
		$data = $this->input->post();
		$this->PM->Insert_product($data);
		$this->session->set_flashdata('add', 'add');
		redirect('product/add_product');
	}

	public function edit_product($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(2);
		$data['product'] = $this->PM->Get_product($id);
		$data['product_cats'] = $this->PM->Get_all_product_cat();
		$this->load->view('product/edit_product', $data);
	}

	public function editing_product($id){
		$data = $this->input->post();
		$this->PM->Update_product($id,$data);
		$this->session->set_flashdata('edit', 'edit');
		redirect("product/edit_product/$id");
	}

	public function delete_product($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(3);
		$this->PM->Delete_product($id);
		$this->session->set_flashdata('del', 'del');
		redirect('product');
	}

	
}
