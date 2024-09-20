<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model {

	public function Get_newses($start_date,$end_date){
		return $this->db->where('add_date >=',$start_date)
						->where('add_date <=',$end_date)
						->get('news')->result_array();
	}

	public function Insert_news($data){
		$this->db->insert('news', $data);
	}

	public function Get_news($id){
		return $this->db->where('news_id',$id)->get('news')->result_array();
	}

	public function Update_news($data,$id){
		$this->db->where('news_id', $id)
				->update('news',$data);
	}

	public function Delete_news($id){
		$this->db->where('news_id', $id)
				->delete('news');
	}

}
