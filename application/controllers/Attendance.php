<?php
require_once(APPPATH.'controllers/User.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Attendance_model','AM');
        $this->load->model('User_model','UM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(63);
		$data['Today_attendance'] = $this->AM->Today_attendance();
		$data['employees'] = $this->UM->Get_all_users();
		$data['date'] = date('Y-m-d');
		$this->load->view('attendance/attendance',$data);
	}

	public function attendance_department(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(87);
		$department_id = $_SESSION['department_id'];
		$data['Today_attendance'] = $this->AM->Today_attendance();
		$data['employees'] = $this->UM->Get_department_users($department_id);
		$data['date'] = date('Y-m-d');
		$data['check'] = '1';
		$this->load->view('attendance/attendance',$data);
	}


	public function mark_todays_attendance($date,$check=''){
		$this->user_utility->check_login();
		if ($check == 1) {
			$this->user_utility->check_permission(87);
			$data['check'] = 1;
		}else{
			$this->user_utility->check_permission(63);
		}
		$presents 	= $this->input->post('present');
		$absents 	= $this->input->post('absent');
		$lates 		= $this->input->post('late');
		$leaves 	= $this->input->post('leave');
		$reasons 	= $this->input->post('reason');

		if (isset($presents) && !empty($presents) && $presents != '') {
			foreach ($presents as $present) {
				$check = 1;
				$this->AM->Insert_attendance($check,$present,$date);
			}
		}
		if (isset($absents) && !empty($absents) && $absents != '') {
			foreach ($absents as $absent) {
				$check = 2;
				$this->AM->Insert_attendance($check,$absent,$date);
			}
		}
		if (isset($lates) && !empty($lates) && $lates != '') {
			foreach ($lates as $late) {
				$check = 3;
				$this->AM->Insert_attendance($check,$late,$date);
			}
		}
		if (isset($leaves) && !empty($leaves) && $leaves != '') {
			foreach ($leaves as $leave) {
				$check = 4;
				foreach ($reasons as $employeeId => $reason) {
					if ($employeeId == $leave) {
						$late_reason = $reason;
						$this->AM->Insert_attendance($check,$leave,$date,$reason);
					}
				}	
			}
		}
		$this->session->set_flashdata('mark', 'mark');
		if ($check == 1) {
			redirect("Attendance/check_attendance_department/$date");
		}else{
			redirect("Attendance/check_attendance/$date");
		}
		
	}

	public function change_attendance($date,$dept_check=''){
		$this->user_utility->check_login();
		if ($dept_check == 1) {
			$this->user_utility->check_permission(87);
		}else{
			$this->user_utility->check_permission(64);
		}
		
		$presents 	= $this->input->post('present');
		$absents 	= $this->input->post('absent');
		$lates 		= $this->input->post('late');
		$leaves 	= $this->input->post('leave');
		$reasons 	= $this->input->post('reason');
		foreach ($presents as $present) {
			$check = 1;
			$this->AM->Delete_attendence($date,$present);
			$this->AM->Insert_attendance($check,$present,$date);
		}
		foreach ($absents as $absent) {
			$check = 2;
			$this->AM->Delete_attendence($date,$absent);
			$this->AM->Insert_attendance($check,$absent,$date);
		}
		foreach ($lates as $late) {
			$check = 3;
			$this->AM->Delete_attendence($date,$late);
			$this->AM->Insert_attendance($check,$late,$date);
		}
		foreach ($leaves as $leave) {
			$check = 4;
			$this->AM->Delete_attendence($date,$leave);
			foreach ($reasons as $employeeId => $reason) {
				if ($employeeId == $leave) {
					$late_reason = $reason;
					$this->AM->Insert_attendance($check,$leave,$date,$reason);
				}
			}	
		}
		$this->session->set_flashdata('change', 'change');
		if ($dept_check == 1) {
			redirect("Attendance/check_attendance_department/$date");
		}else{
			redirect("Attendance/check_attendance/$date");
		}
		
	}

	public function check_attendance($date=''){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(63);
		if ($date == '') {
			$data['date'] = $this->input->post('date');
		}else{
			$data['date'] = $date;
		}
		
		$data['Today_attendance'] = $this->AM->Check_attendance($data['date']);
		$data['employees'] = $this->UM->Get_all_users();
		$this->load->view('attendance/attendance',$data);

	}

	public function check_attendance_department($date=''){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(87);
		$department_id = $_SESSION['department_id'];
		if ($date == '') {
			$data['date'] = $this->input->post('date');
		}else{
			$data['date'] = $date;
		}
		$data['check'] = 1;
		
		$data['Today_attendance'] = $this->AM->Check_attendance($data['date']);
		$data['employees'] = $this->UM->Get_department_users($department_id);
		$this->load->view('attendance/attendance',$data);

	}

	public function attendance_overview(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(63);

		$data['date'] = $this->input->post('date');
		if ($data['date'] == '' || empty($data['date'])) {
			$date = date('Y-m-1');
			$data['date'] = date('Y-m');
		}else{
			$date = date('Y-m-1',strtotime($data['date']));
		}
		$data['attendance'] = $this->AM->count_attendence($date);
		$data['employees'] = $this->UM->Get_all_users();
		$this->load->view('attendance/attendance_overview',$data);
	}

	public function attendance_overview_department(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(87);
		$department_id = $_SESSION['department_id'];

		$data['date'] = $this->input->post('date');
		if ($data['date'] == '' || empty($data['date'])) {
			$date = date('Y-m-1');
			$data['date'] = date('Y-m');
		}else{
			$date = date('Y-m-1',strtotime($data['date']));
		}
		$data['attendance'] = $this->AM->count_attendence($date);
		$data['employees'] = $this->UM->Get_department_users($department_id);
		$data['check'] = '1';
		$this->load->view('attendance/attendance_overview',$data);
	}

	public function view_summary($employee_id,$check=''){
		$this->user_utility->check_login();
		if ($check == 1) {
			$this->user_utility->check_permission(87);
			$data['check'] = 1;
		}else{
			$this->user_utility->check_permission(63);
		}
		
		$date = $this->input->post('date');
		$data['employee'] = $this->UM->Get_user($employee_id);
		if ($date == '' || empty($date)) {
			$data['date'] = date('Y-m');
			$date = date('Y-m-1');
		}else{
			$data['date'] = $date;
		}
		$data['attendance'] = $this->AM->Get_user_attendance($employee_id,$date);
		$this->load->view('attendance/view_summary',$data);
	}

	



	

	
	
	
}
