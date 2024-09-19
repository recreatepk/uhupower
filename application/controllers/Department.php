<?php
require_once(APPPATH.'controllers/User.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Department_model','DM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(51);
		$data['departments'] = $this->DM->Get_departments();
		$this->load->view('department/departments',$data);
	}

	public function add_department(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(52);
		$this->load->view('department/add_department');
	}

	public function adding_department(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(52);
		$data = $this->input->post();
		$this->DM->Insert_department($data);
		$this->session->set_flashdata('add', 'add');
		redirect("department/add_department");

	}

	public function edit_department($department_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(53);
		$data['department'] = $this->DM->Get_department($department_id);
		$this->load->view('department/edit_department',$data);
	}

	public function editing_department($department_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(53);
		$data = $this->input->post();
		$this->DM->Update_department($data,$department_id);
		$this->session->set_flashdata('edit', 'edit');
		redirect("department/edit_department/$department_id");
	}

	public function delete_department($department_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(54);
		$this->DM->Delete_department($department_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Department");
	}

	
	
}
