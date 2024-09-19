<?php
require_once(APPPATH.'controllers/User.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Dashboard_model','DM');
        $this->load->model('User_model','UM');
        $this->load->model('Attendance_model','AM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$data['news'] = $this->DM->Get_newses();
		$data['purchase_sum'] = $this->DM->Get_monthly_purchase_sum();
		$data['purchase_sum_Lmonth'] = $this->DM->Get_last_month_purchase_sum();

		$data['sale_sum'] = $this->DM->Get_monthly_sale_sum();
		$data['sale_sum_Lmonth'] = $this->DM->Get_last_month_sale_sum();

		$data['invoice_count'] = $this->DM->Get_current_month_invoice_count();
		$data['invoice_count_Lmonth'] = $this->DM->Get_last_month_invoice_count();
		
		$data['yearly_sales'] = $this->DM->Get_yearly_sales_sums();
		$data['yearly_expense'] = $this->DM->Get_yearly_expense_sums();
		$data['yearly_purchases'] = $this->DM->Get_yearly_purchase_sums();

		$data['employees'] = $this->UM->Get_all_users();
		$data['today_attendances'] = $this->AM->Today_attendance();
		$date = date('Y-m-d');
		$data['monthly_attendances'] = $this->AM->count_attendence($date);


		// print_r($data['monthly_attendances']);die;
		// print_r($data['yearly_expense']);
		// print_r($data['yearly_purchase']);die;

		$this->load->view('dashboard/dashboard',$data);
	}

	
	
}
 