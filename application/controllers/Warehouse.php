<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('User_model','UM');
        $this->load->model('Warehouse_model','WM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(30);
		$data['warehouses'] = $this->WM->Get_warehouses();
		$this->load->view('warehouse/warehouse',$data);
	}

	public function add_warehouse(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(28);
		$this->load->view('warehouse/add_warehouse');
	}

	public function adding_warehouse(){
		$data = $this->input->post();
		$data['warehouse_location'] = 0;
		$this->WM->Insert_warehouse($data);
		$this->session->set_flashdata('add', 'add');
	    redirect('Warehouse/add_warehouse');
	}

	public function edit_warehouse($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(29);
		$data['warehouses'] = $this->WM->Get_warehouse($id);
		$this->load->view('warehouse/edit_warehouse',$data);

	}
	public function editing_warehouse($id){
		$data = $this->input->post();
		$this->WM->Update_warehouse($data,$id);
		$this->session->set_flashdata('edit', 'edit');
	    redirect("Warehouse/edit_warehouse/$id");
	}
	public function delete_warehouse($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(31);
		$this->WM->Delete_warehouse($id);
		$this->session->set_flashdata('del', 'del');
	    redirect("Warehouse");
	}


	
}
