<?
class Service_model extends CI_Model {

	public function Get_services(){
		return $this->db->get('services')->result_array();
	}

	public function Insert_service($data){
		$this->db->insert('services', $data);
	}

	public function Get_service($service_id){
		return $this->db->where('service_id',$service_id)->get('services')->result_array();
	}

	public function Update_service($service_id,$data){
		$this->db->where('service_id', $service_id)
				->update('services',$data);
	}

	public function Delete_service($service_id){
		$this->db->where('service_id', $service_id)
				->delete('services');
	}





	public function Insert_render_service($service_data){
		$this->db->insert('render_service', $service_data);
		return $this->db->insert_id();
	}
	public function Insert_rendered_services($rendered_services){
		$this->db->insert('rendered_services', $rendered_services);
	}
	public function Insert_render_service_product($render_service_product){
		$this->db->insert('render_service_product', $render_service_product);
	}


	public function Get_rendered_services($render_service_id){
		return $this->db->select('*')
						->from('render_service')
						->join('rendered_services', 'rendered_services.render_service_id = render_service.render_service_id', 'left')
						->join('services', 'services.service_id = rendered_services.service_id', 'left')
						->where('render_service.render_service_id', $render_service_id)
						->get()
						->result_array();
    
	}
	public function Get_rendered_service($start_date,$end_date){
		return $this->db->select('*')
						->from('render_service')
						->where('date >=',$start_date)
						->where('date <=',$end_date)
						->get()
						->result_array();
    
	}
	public function Get_rendered_services_all(){
		return $this->db->select('*')
						->from('render_service')
						->join('rendered_services', 'rendered_services.render_service_id = render_service.render_service_id', 'left')
						->join('services', 'services.service_id = rendered_services.service_id', 'left')
						->get()
						->result_array();
    
	}
	public function Get_rendered_services_product($render_service_id){
		return $this->db->select('*')
						->from('render_service')
						->join('render_service_product', 'render_service_product.render_service_id = render_service.render_service_id', 'left')
						->join('product', 'product.product_id = render_service_product.product_id', 'left')
						->where('render_service.render_service_id', $render_service_id)
						->get()
						->result_array();
	}

	public function Get_service_assignments(){
		return $this->db->get('service_assignment')
						->result_array();
	}
	public function Get_service_assignment($render_service_id){
		return $this->db->select('*')
						->from('service_assignment')
						->where('render_service_id',$render_service_id)
						->get()
						->result_array();
	}
	public function Get_service_assignment_workers($render_service_id){
		return $this->db->select('*')
						->from('service_assignment')
						->join('employee','employee.employee_id = service_assignment.employee_id')
						->where('render_service_id',$render_service_id)
						->get()
						->result_array();
	}

	public function Get_all_users(){
		return $this->db->select('employee_id,employee_code,employee_name,employee_phone1,employee_designation')
						->from('employee')
						->where('account_active','1')
						->order_by('employee_id','DESC')
						->get()
						->result_array();
	}

	public function Delete_service_assignment($render_service_id){
		$this->db->where('render_service_id',$render_service_id)->delete('service_assignment');
	}

	public function Insert_service_assignment($data){
		$this->db->insert('service_assignment', $data);
	}

	public function change_status($render_service_id,$data){
		$this->db->where('render_service_id',$render_service_id)->update('render_service', $data);
	}

	public function Get_rendered_services_products(){
		return $this->db->select('render_service_product.*, product.product_name, product.product_description')
						->from('render_service_product')
						->join('product', 'product.product_id = render_service_product.product_id')
						->get()
						->result_array();
	}

	public function Delete_render_service($render_service_id){
		$this->db->where('render_service_id',$render_service_id)->delete('render_service');
		$this->db->where('render_service_id',$render_service_id)->delete('rendered_services');
		$this->db->where('render_service_id',$render_service_id)->delete('render_service_product');
		$this->db->where('render_service_id',$render_service_id)->delete('service_assignment');
		
	}
	public function Delete_rendered_service($service_id){
		$this->db->where('render_service_id',$service_id)->delete('rendered_services');
	}
	public function Delete_service_product($service_id){
		$this->db->where('render_service_id',$service_id)->delete('render_service_product');
	}

	public function Get_rendered_services_customer($render_service_id){
		return $this->db->select('sup_cus.*')
						->from('render_service')
						->join('sup_cus', 'sup_cus.sup_cus_id = render_service.sup_cus_id')
						->where('render_service_id',$render_service_id)
						->get()
						->result_array();
	}

	public function Update_delivery_address_service($service_id,$data){
		$this->db->where('render_service_id',$service_id)
				->update('render_service',$data);
	}

	public function Update_render_service_product_invoice_id($service_id,$invoice_id){
		$data['invoice_id'] = $invoice_id;
		$this->db->where('render_service_id',$service_id)
				->update('render_service_product',$data);
	}

	public function Check_invoice_status($invoice_id){
		$data =	$this->db->where('invoice_id',$invoice_id)
						->get('invoice')->result_array();

		if ($data[0]['invoice_status'] == 3) {
			return true;
		}else{
			return false;
		}
	}

	public function Check_dc_status($invoice_id){
		$data =	$this->db->where('invoice_id',$invoice_id)
						->get('sell_dc')->result_array();

		if ($data[0]['status'] == 2) {
			return true;
		}else{
			return false;
		}
	}

	public function Update_render_service($service_id,$data){
		$this->db->where('render_service_id', $service_id)
				->update('render_service',$data);
	}

	public function Get_cus_sup_services($cus_sup_id,$start_date,$end_date){
		return $this->db->select('*')
						->from('render_service')
						->join('rendered_services','rendered_services.render_service_id = render_service.render_service_id')
						->join('services','rendered_services.service_id = services.service_id')
						->where('render_service.date >=',$start_date)
						->where('render_service.date <=',$end_date)
						->where('render_service.sup_cus_id',$cus_sup_id)
						->where('render_service.status','4')
						->get()
						->result_array();
	}

	public function Get_all_workers(){
		return $this->db->select('employee_id,employee_code,employee_name,employee_phone1,employee_designation')
						->from('employee')
						->where('user_group_id','2')
						->where('resignation_type',0)
						->order_by('employee_id','DESC')
						->get()
						->result_array();
	}


}