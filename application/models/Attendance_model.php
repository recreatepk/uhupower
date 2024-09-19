<?
class Attendance_model extends CI_Model {

	public function Today_attendance(){
		$today = date('Y-m-d');
		return $this->db->select('attendance.*,employee.employee_id,employee.employee_code,employee.employee_name')
						->from('attendance')
						->join('employee', 'employee.employee_id = attendance.attendance_employee_id')
						->where('attendance.date', $today)
						->get()
						->result_array();
	}

	public function Check_attendance($date){
		return $this->db->select('attendance.*,employee.employee_id,employee.employee_code,employee.employee_name')
						->from('attendance')
						->join('employee', 'employee.employee_id = attendance.attendance_employee_id')
						->where('attendance.date', $date)
						->get()
						->result_array();
	}

	public function count_attendence($date){
		return $this->db->query("SELECT 
								    attendance_employee_id,
								    SUM(CASE WHEN attendance_present = '1' THEN 1 ELSE 0 END) AS 'Present',
								    SUM(CASE WHEN attendance_present = '2' THEN 1 ELSE 0 END) AS 'Absent',
								    SUM(CASE WHEN attendance_present = '3' THEN 1 ELSE 0 END) AS 'Late',
								    SUM(CASE WHEN attendance_present = '4' THEN 1 ELSE 0 END) AS 'Leave'
								FROM 
								    attendance
								WHERE 
								    attendance_employee_id IS NOT NULL
								    AND MONTH('$date') = MONTH(date)  -- Assuming there's an attendance_date column
								    AND YEAR('$date') = YEAR(date)    -- Assuming there's an attendance_date column
								GROUP BY 
								    attendance_employee_id;")->result_array();
	}

	public function Get_user_attendance($employee_id,$date){
			return $this->db->select('*')
							->from('attendance')
							->where('attendance_employee_id',$employee_id)
							->where('MONTH(date)', date('m', strtotime($date)))
                			->where('YEAR(date)', date('Y', strtotime($date)))
                			->order_by('date')
							->get()
							->result_array();
	}

	public function Insert_attendance($check,$employee_id,$date,$reason=''){
		if ($check == 4) {
			$data['notes'] = $reason;
		}
		$data['date'] = $date;
		$data['attendance_employee_id'] = $employee_id;
		$data['attendance_present'] = $check;
		$this->db->insert('attendance', $data);
	}

	public function Delete_attendence($date,$id){
		$this->db->where('date',$date)->where('attendance_employee_id',$id)->delete('attendance');
	}

	public function Get_monthly_attendance($date){
		return $this->db->select('attendance.*,employee.employee_id,employee.employee_code,employee.employee_name')
						->from('attendance')
						->join('employee', 'employee.employee_id = attendance.attendance_employee_id')
						->where('MONTH(attendance.date)', date('m', strtotime($date)))
                		->where('YEAR(attendance.date)', date('Y', strtotime($date)))
						->get()
						->result_array();
	}
	public function Get_yearly_leave($date){
		return $this->db->select('attendance.*,employee.employee_id,employee.employee_code,employee.employee_name')
						->from('attendance')
						->join('employee', 'employee.employee_id = attendance.attendance_employee_id')
                		->where('YEAR(attendance.date)', date('Y', strtotime($date)))
                		->where('attendance_present', 4)
						->get()
						->result_array();
	}


}