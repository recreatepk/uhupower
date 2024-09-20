<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Supplier_model','SM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(21);
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$this->load->view('supplier/supplier', $data);
	}

	public function supplier($type){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(21);
		$data['suppliers'] = $this->SM->Get_all_suppliers($type);
		$data['type'] = $type;
		$this->load->view('supplier/supplier', $data);
	}

	public function add_supplier($type){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(19);
		$data['type'] = $type;
		$this->load->view('supplier/add_supplier',$data);
	}

	public function adding_supplier($type){
		$data = $this->input->post();
		$this->SM->Insert_supplier($data);
		$this->session->set_flashdata('add', 'add');
		redirect("supplier/add_supplier/$type");
	}

	public function edit_supplier($id,$type){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(20);
		$data['type'] = $type;
		$data['supplier'] = $this->SM->Get_supplier($id);
		$this->load->view('supplier/edit_supplier', $data);
	}

	public function editing_supplier($id,$type){
		$data = $this->input->post();
		$this->SM->Update_supplier($id,$data);
		$this->session->set_flashdata('edit', 'edit');
		redirect("supplier/edit_supplier/$id/$type");
	}

	public function delete_supplier($id,$type){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(22);
		$this->SM->Delete_supplier($id);
		$this->session->set_flashdata('del', 'del');
		redirect("Supplier/supplier/$type");
	}




	
}
