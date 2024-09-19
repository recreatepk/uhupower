<?
class Expense_model extends CI_Model {

	public function Get_expenses($start_date,$end_date){
		return $this->db->where('expense_date >=',$start_date)
						->where('expense_date <=',$end_date)
						->get('expense')->result_array();
	}

	public function Get_expense_categories(){
		return $this->db->get('expense_category')->result_array();
	}

	public function Insert_expense($data){
		$this->db->insert('expense', $data);
	}

	public function Get_expense($expense_id){
		return $this->db->where('expense_id', $expense_id)
						->get('expense')
						->result_array();
	}
	
	public function Update_expense($data,$expense_id){
		$this->db->where('expense_id', $expense_id)
				->update('expense',$data);
	}
	public function Delete_expense($expense_id){
		$this->db->where('expense_id', $expense_id)
				->delete('expense');
	}

	public function Insert_expense_category($data){
		$this->db->insert('expense_category', $data);
	}

	public function Get_expense_category($expense_category_id){
		return $this->db->where('expense_category_id', $expense_category_id)
						->get('expense_category')
						->result_array();
	}
	public function Update_expense_category($data,$expense_category_id){
		$this->db->where('expense_category_id', $expense_category_id)
				->update('expense_category',$data);
	}

	public function delete_expense_category($expense_category_id){
		$this->db->where('expense_category_id', $expense_category_id)
				->delete('expense_category');
	}


	
}