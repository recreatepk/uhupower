<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department_model extends CI_Model {

	public function Get_departments(){
		return $this->db->get('department')->result_array();
	}

	public function Insert_department($data){
		$this->db->insert('department', $data);
	}

	public function Get_department($id){
		return $this->db->where('department_id',$id)->get('department')->result_array();
	}

	public function Update_department($data,$id){
		$this->db->where('department_id', $id)
				->update('department',$data);
	}

	public function Delete_department($id){
		$this->db->where('department_id', $id)
				->delete('department');
	}

}
