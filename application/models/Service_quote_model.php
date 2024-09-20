<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_quote_model extends CI_Model
{

	public function Get_service_quote($start_date, $end_date)
	{
		return $this->db->select('*')
			->from('service_quote')
			->join('service_quote_details', 'service_quote_details.service_quote_id=service_quote.service_quote_id')
			->where('service_quote.date >=', $start_date)
			->where('service_quote.date <=', $end_date)
			->get()
			->result_array();
	}

	public function Get_service_quote_service($quotes_ids)
	{
		return $this->db->select('*')
			->from('service_quote_service')
			->join('services', 'services.service_id=service_quote_service.render_service_id')
			->where_in('service_quote_id', $quotes_ids)
			->get()->result_array();
	}

	public function Get_quote_service($quotes_id)
	{
		return $this->db->select('*')
			->from('service_quote_service')
			->join('services', 'services.service_id=service_quote_service.render_service_id')
			->where('service_quote_id', $quotes_id)
			->get()
			->result_array();
	}

	public function Get_rendered_service($service_quote_id)
	{
		return $this->db->select('*')
			->from('render_service')
			->where('render_service_id', $service_quote_id)
			->get()
			->result_array();
	}


	public function Get_service_quote_product($quotes_id)
	{
		return $this->db->select('*')
			->from('service_quote_product')
			->join('product', 'product.product_id =service_quote_product.product_id')
			->where_in('service_quote_id', $quotes_id)
			->get()->result_array();
	}

	public function Get_quote($service_quote_id)
	{
		return $this->db->select('*')
			->from('service_quote')
			->join('service_quote_details', 'service_quote_details.service_quote_id=service_quote.service_quote_id')
			->where('service_quote.service_quote_id', $service_quote_id)
			->get()
			->result_array();
	}

	public function Delete_service_quote($service_quote_id)
	{
		$this->db->where('service_quote_id', $service_quote_id)
			->delete('service_quote');
		$this->db->where('service_quote_id', $service_quote_id)
			->delete('service_quote_details');
		$this->db->where('service_quote_id', $service_quote_id)
			->delete('service_quote_product');
		$this->db->where('service_quote_id', $service_quote_id)
			->delete('service_quote_service');
	}

	public function Insert_service_quote($service_quote)
	{
		$this->db->insert('service_quote', $service_quote);
		return $this->db->insert_id();
	}

	public function Update_service_quote($service_quote, $service_quote_id)
	{
		$this->db->where('service_quote_id', $service_quote_id)
			->update('service_quote', $service_quote);
		return $this->db->insert_id();
	}

	public function Insert_service_quote_details($service_quote_details)
	{
		$this->db->insert('service_quote_details', $service_quote_details);
	}

	public function Get_service_quote_details($service_quote_id)
	{
		return $this->db->select('*')
			->from('service_quote_details')
			->where('service_quote_id', $service_quote_id)  // for single id
			->get()
			->result_array();
	}

	public function Update_service_quote_details($service_quote_details, $service_quote_id)
	{
		$this->db->where('service_quote_id', $service_quote_id)
			->update('service_quote_details', $service_quote_details);
	}

	public function Insert_service_quote_products($service_quote_product)
	{
		$this->db->insert('service_quote_product', $service_quote_product);
	}

	public function Update_service_quote_products($service_quote_product, $service_quote_id)
	{
		$this->db->where('service_quote_id', $service_quote_id)
			->update('service_quote_product', $service_quote_product);
	}

	public function Insert_service_quote_service($service_quote_service)
	{
		$this->db->insert('service_quote_service', $service_quote_service);
	}

	public function Update_service_quote_service($service_quote_service, $service_quote_id)
	{
		$this->db->where('service_quote_id', $service_quote_id)
			->update('service_quote_service', $service_quote_service);
	}

	public function Change_status($status, $service_quote_id)
	{
		$new_status = $status + 1;
		$data['status'] = $new_status;
		$this->db->where('service_quote_id', $service_quote_id)->update('service_quote', $data);
	}

	public function Update_employee_id($service_quote_id, $employee_id)
	{
		$data['employee_id'] = $employee_id;
		return $this->db->where('service_quote_id', $service_quote_id)
			->update('service_quote_details', $data);
	}

	public function Get_quotation_w_supplier($service_quote_id)
	{
		return $this->db->select('service_quote.*, sup_cus.sup_cus_company,sup_cus.sup_cus_name,sup_cus.sup_cus_address,sup_cus.sup_cus_phone1,sup_cus.ntn,sup_cus.strn')
			->from('service_quote')
			->join('sup_cus', 'sup_cus.sup_cus_id = service_quote.sup_cus_id')
			->where('service_quote_id', $service_quote_id)
			->get()
			->result_array();
	}

	public function Get_quotation_products_w_names($service_quote_id)
	{
		return $this->db->select('*')
			->from('service_quote_product')
			->join('product', 'product.product_id = service_quote_product.service_quote_product_id')
			->where('service_quote_id', $service_quote_id)
			->get()
			->result_array();
	}
}
