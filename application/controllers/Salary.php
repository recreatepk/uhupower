<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Salary_model','SM');
        $this->load->model('User_model','UM');
        $this->load->model('Attendance_model','AM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(51);
		$year = $this->input->post('date');

		if ($year == '' || empty($year)) {
			$year = date('Y');
		}
		$data['salary_months'] 	= $this->SM->Get_months($year);
		$data['users']			= $this->UM->Get_all_users();
		$data['salary']			= $this->SM->Get_yearly_salary($year);
		$data['date'] = $year;
		// print_r($data);die;
		$this->load->view('salary/yearly_salary',$data);
	}

	public function get_salary_all(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(51);
		$date = $this->input->post('date');
		if ($date == '' || empty($date)) {
			$date = date('y-m-d');
			$month = date('m');
			$year = date('y');
			$data['date'] = $date;
		}
		else{
			$data['date'] = $date;
			$month = date('m',strtotime($date));
			$year = date('y',strtotime($date));
		}
		$data['users']			= $this->UM->Get_all_users();
		$data['monthly_atts'] 	= $this->AM->Get_monthly_attendance($date);
		$data['yearly_leave']	= $this->AM->Get_yearly_leave($date);
		$data['monthly_salary']	= $this->SM->Get_monthly_salary($date);
		$data['total_sun']		= $this->total_sun($month,$year);
		// print_r($data);die;
		$this->load->view('salary/make_salary',$data);
	}

	function total_sun($month,$year){
	    $sundays=0;
	    $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
	    for($i=1;$i<=$total_days;$i++)
	    if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)
	    $sundays++;
	    return $sundays;
	}

	public function make_salary(){
		$data['employee_id'] 	= $this->input->post('employee_id');
		$data['fuelprice'] 		= $this->input->post('fuelprice');
		$data['milage'] 		= $this->input->post('milage');
		$data['salary'] 		= $this->input->post('salary');
		$data['salary_date'] 	= $this->input->post('salary_date');
		$data['salary_id'] 		= $this->input->post('salary_id');
		// print_r($data['salary_date']);die;

		if ($data['salary_id'] != '' && !empty($data['salary_id'])) {
			foreach ($data['salary_id'] as $salary_id) {
				$this->SM->Delete_salary($salary_id);
			}
		}
		foreach ($data['salary_date'] as $date) {
			$new_date = date('Y-m-1',strtotime($date));
			$data_arrays[] = $new_date;
		}

		for ($i = 0; $i < count($data['employee_id']); $i++) {
            $results[] = array(
                'salary_employee_id' => $data['employee_id'][$i],
                'salary_fuelprice' => $data['fuelprice'][$i],
                'salary_milage' => $data['milage'][$i],
                'salary_salary' => $data['salary'][$i],
                'salary_date' => $data_arrays[$i]
            );
        }
        foreach ($results as $result) {
        	$this->SM->Make_salary($result);
        }
        

        $this->session->set_flashdata('add', 'add');
	    redirect('Salary');

	}

	
	
}
