<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model {

	public function Get_company(){
		return $this->db->get('office')->result_array();
	}
	public function Update_company_settings($data,$id){
		$this->db->where('company_id',$id)
				->update('office', $data);
	}

}
