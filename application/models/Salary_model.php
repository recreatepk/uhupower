<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salary_model extends CI_Model {
	

	public function Make_salary($result){
		$this->db->insert('salary', $result);
	}
	public function Get_monthly_salary($date){
		return $this->db->select('*')
						->from('salary')
						->where('MONTH(salary_date)', date('m', strtotime($date)))
            			->where('YEAR(salary_date)', date('Y', strtotime($date)))
						->get()
						->result_array();
	}

	public function Delete_salary($salary_id){
		$this->db->where('salary_id',$salary_id)
				->delete('salary');
	}
	public function Get_months($year){
		return $this->db->select('DISTINCT(MONTH(salary_date)) as months')
						->from('salary')
						->where('YEAR(salary_date)', $year)
						->order_by('MONTH(salary_date)')
						->get()
						->result_array();
	}
	public function Get_yearly_salary($year){
		return $this->db->select('*')
						->from('salary')
						->where('YEAR(salary_date)', $year)
						->get()
						->result_array();
	}
}
