<?
class Store_model extends CI_Model {

	public function Get_stores(){
		return $this->db->get('store')->result_array();
	}

	public function Insert_store($data){
		$this->db->insert('store', $data);
	}

	public function Get_store($id){
		return $this->db->where('store_id',$id)->get('store')->result_array();
	}

	public function Update_store($data,$id){
		$this->db->where('store_id', $id)
				->update('store',$data);
	}

	public function Delete_store($id){
		$this->db->where('store_id', $id)
				->delete('store');
	}

}