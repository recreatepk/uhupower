<?php
require_once(APPPATH.'controllers/User.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Complaint_model','CM');
        $this->load->model('Supplier_model','SM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(91);
		$input_data = $this->input->post('dates');
		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-',$input_data);
			$start_date = date('Y/m/d`',strtotime($temp[0]));
			$end_date = date('Y/m/d',strtotime($temp[1]));
			// echo 'with date';	
		}else{
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d',strtotime($one_week));
    		$end_date = date('Y/m/d',strtotime($current_date));
		}
		$data['complaints'] = $this->CM->Get_complaints($start_date,$end_date);
		$this->load->view('complaint/complaints',$data);
	}

	public function add_complaint(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(90);
		$data['suppliers'] = $this->SM->Get_all_supplier();
		$this->load->view('complaint/add_complaint',$data);
	}

	public function adding_complaint(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(90);
		$data = $this->input->post();
		$this->CM->Insert_complaint($data);
		$this->session->set_flashdata('add', 'add');
		redirect("Complaint/add_complaint");

	}

	public function edit_complaint($complaint_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(92);
		$data['complaint'] = $this->CM->Get_complaint($complaint_id);
		$this->load->view('complaint/edit_complaint',$data);
	}

	public function editing_complaint($complaint_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(92);
		$data = $this->input->post();
		$this->CM->Update_complaint($data,$complaint_id);
		$this->session->set_flashdata('edit', 'edit');
		redirect("Complaint/edit_complaint/$complaint_id");
	}

	public function delete_complaint($complaint_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(93);
		$this->CM->Delete_complaint($complaint_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Complaint");
	}

	public function change_status($complaint_id,$status){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(92);
		$this->CM->Change_status($complaint_id,$status);
		$this->session->set_flashdata('status', 'status');
		redirect("Complaint");
	}

	
	
}
