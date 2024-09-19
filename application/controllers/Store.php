<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('User_model','UM');
        $this->load->model('Store_model','SM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(30);
		$data['stores'] = $this->SM->Get_stores();
		$this->load->view('store/store',$data);
	}

	public function add_store(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(28);
		$this->load->view('store/add_store');
	}

	public function adding_store(){
		$data = $this->input->post();
		$data['store_location'] = 0;
		$this->SM->Insert_store($data);
		$this->session->set_flashdata('add', 'add');
	    redirect('Store/add_store');
	}

	public function edit_store($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(29);
		$data['stores'] = $this->SM->Get_store($id);
		$this->load->view('store/edit_store',$data);

	}
	public function editing_store($id){
		$data = $this->input->post();
		$this->SM->Update_store($data,$id);
		$this->session->set_flashdata('edit', 'edit');
	    redirect("Store/edit_store/$id");
	}
	public function delete_warehouse($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(31);
		$this->SM->Delete_store($id);
		$this->session->set_flashdata('del', 'del');
	    redirect("Store");
	}


	
}
