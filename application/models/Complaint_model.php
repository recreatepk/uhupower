<?
class Complaint_model extends CI_Model {

	public function Get_complaints($start_date,$end_date){
		return $this->db->select('complaint.*,sup_cus.sup_cus_company,sup_cus.sup_cus_id')
						->join('sup_cus','sup_cus.sup_cus_id = complaint.customer_id')
						->where('date >=',$start_date)
						->where('date <=',$end_date)
						->get('complaint')->result_array();
	}

	public function Insert_complaint($data){
		$this->db->insert('complaint', $data);
	}

	public function Get_complaint($id){
		return $this->db->where('complaint_id',$id)->get('complaint')->result_array();
	}

	public function Update_complaint($data,$id){
		$this->db->where('complaint_id', $id)
				->update('complaint',$data);
	}

	public function Delete_complaint($id){
		$this->db->where('complaint_id', $id)
				->delete('complaint');
	}

	public function Change_status($complaint_id,$status){
		$data['status'] = $status;
		$this->db->where('complaint_id', $complaint_id)
				->update('complaint',$data);
	}

	public function Get_unassigned_complaints(){
		return $this->db->where('status', '0')
						->get('complaint')
						->result_array();
	}

	public function Update_complaint_status($cm_data,$service_id){

		$this->db->where('complaint_ref', $service_id)
				->update('complaint',$cm_data);
	}



}