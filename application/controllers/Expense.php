<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Expense_model','EM');
        $this->load->library('User_Utility');
       
    }

	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$input_data = $this->input->post('dates');
		// print_r($data);
		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-',$input_data);
			$start_date = date('Y/m/d`',strtotime($temp[0]));
			$end_date = date('Y/m/d',strtotime($temp[1]));
				
		}else{
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d',strtotime($one_week));
    		$end_date = date('Y/m/d',strtotime($current_date));
		}
		$data['expenses']				=	$this->EM->Get_expenses($start_date,$end_date);
		$data['expenses_categories']	=	$this->EM->Get_expense_categories();
		$this->load->view('expense/expenses', $data);
	}

	public function add_expense(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['expense_categories'] = $this->EM->Get_expense_categories();
		$this->load->view('expense/add_expense', $data);

	}

	public function adding_expense(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data = $this->input->post();
		$this->EM->Insert_expense($data);
		$this->session->set_flashdata('add', 'add');
		redirect('Expense/add_expense');
	}

	public function edit_expense($expense_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['expense'] 			= $this->EM->Get_expense($expense_id);
		$data['expense_categories'] = $this->EM->Get_expense_categories();
		$this->load->view('expense/edit_expense', $data);
	}

	public function editing_expense($expense_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data = $this->input->post();
		$this->session->set_flashdata('edit', 'edit');
		$this->EM->Update_expense($data,$expense_id);
		redirect("Expense/edit_expense/$expense_id");
	}

	public function delete_expense($expense_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$this->EM->Delete_expense($expense_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Expense");
	}









	public function expense_category(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['expense_categories']	=	$this->EM->Get_expense_categories();
		$this->load->view('expense/categories', $data);
	}

	public function add_expense_category(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$this->load->view('expense/add_category');
	}

	public function adding_expense_category(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data = $this->input->post();
		$this->EM->Insert_expense_category($data);
		$this->session->set_flashdata('add', 'add');
		redirect('Expense/add_expense_category');
	}

	public function edit_expense_category($expense_category_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['expense_categories'] = $this->EM->Get_expense_category($expense_category_id);
		$this->load->view('expense/edit_expense_category', $data);
	}

	public function editing_expense_category($expense_category_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data = $this->input->post();
		$this->session->set_flashdata('edit', 'edit');
		$this->EM->Update_expense_category($data,$expense_category_id);
		redirect("Expense/edit_expense_category/$expense_category_id");
	}

	public function delete_expense_category($expense_category_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$this->EM->Delete_expense_category($expense_category_id);
		$this->session->set_flashdata('del', 'del');
		redirect("Expense/expense_category");
	}

}
