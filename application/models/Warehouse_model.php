<?
class Warehouse_model extends CI_Model {

	public function Get_warehouses(){
		return $this->db->get('warehouse')->result_array();
	}

	public function Insert_warehouse($data){
		$this->db->insert('warehouse', $data);
	}

	public function Get_warehouse($id){
		return $this->db->where('warehouse_id',$id)->get('warehouse')->result_array();
	}

	public function Update_warehouse($data,$id){
		$this->db->where('warehouse_id', $id)
				->update('warehouse',$data);
	}

	public function Delete_warehouse($id){
		$this->db->where('warehouse_id', $id)
				->delete('warehouse');
	}

}