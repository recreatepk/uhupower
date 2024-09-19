<?
class Report_model extends CI_Model {

	public function Get_debt_credit($cus_sup_id,$start_date,$end_date){
		return $this->db->where('date >=',$start_date)
						->where('date <=',$end_date)
						->where('sup_cus_id',$cus_sup_id)
						->get('deb_cred_note')
						->result_array();
	}
	public function Get_payment($cus_sup_id,$start_date,$end_date){
		return $this->db->where('payment_date >=',$start_date)
						->where('payment_date <=',$end_date)
						->where('sup_cus_id',$cus_sup_id)
						->get('payment')
						->result_array();
	}

	public function Insert_deb_cred_note($data){
		$this->db->insert('deb_cred_note', $data);
	}

	public function Get_invoice_ids(){
		return $this->db->select('invoice_id,supplier_id')
						->from('invoice')
						->where('invoice_status','3')
						->get()
						->result_array();
	}
	public function Get_purchase_order_ids(){
		return $this->db->select('purchase_order_id,purchase_order_supplier_id')
						->from('purchase_order')
						->where('purchase_order_status','2')
						->get()
						->result_array();
	}
	public function Get_render_service_ids(){
		return $this->db->select('render_service_id,sup_cus_id')
						->from('render_service')
						->where('status','4')
						->get()
						->result_array();
	}
	public function Insert_payments($payment){
		$this->db->insert('payment', $payment);
	}

}