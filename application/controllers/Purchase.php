<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Purchase_model','PM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(21);
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$this->load->view('supplier/supplier', $data);
	}

	public function add_supplier(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(19);
		$this->load->view('supplier/add_supplier');
	}

	public function adding_supplier(){
		$data = $this->input->post();
		$this->SM->Insert_supplier($data);
		$this->session->set_flashdata('add', 'add');
		redirect('supplier/add_supplier');
	}

	public function edit_supplier($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(20);
		$data['supplier'] = $this->SM->Get_supplier($id);
		$this->load->view('supplier/edit_supplier', $data);
	}

	public function editing_supplier($id){
		$data = $this->input->post();
		$this->SM->Update_supplier($id,$data);
		$this->session->set_flashdata('edit', 'edit');
		redirect("supplier/edit_supplier/$id");
	}

	public function delete_supplier($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(22);
		$this->SM->Delete_supplier($id);
		$this->session->set_flashdata('del', 'del');
		redirect('supplier');
	}




	
}
