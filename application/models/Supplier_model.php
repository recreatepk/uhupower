<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model {


	public function Insert_supplier($data){
		$this->db->insert('sup_cus', $data);
	}
	public function Get_all_supplier(){
		return $this->db->get('sup_cus')->result_array();
	}
	public function Get_supplier($id){
		return $this->db->where('sup_cus_id',$id)
						->get('sup_cus')->result_array();
	}
	public function Update_supplier($id,$data){
		$this->db->where('sup_cus_id', $id)
				->update('sup_cus',$data);
	}
	public function Delete_supplier($id){
		$this->db->where('sup_cus_id', $id)
					->delete('sup_cus');
	}


	public function Get_all_suppliers($type){
		return $this->db->where('cat',$type)->get('sup_cus')->result_array();
	}


}
