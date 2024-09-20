<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation_model extends CI_Model
{

	public function Insert_quotation($quote_data)
	{
		$this->db->insert('quotation', $quote_data);
		return $this->db->insert_id();
	}

	public function Insert_quotation_product($quote_product_data)
	{
		$this->db->insert('quotation_products', $quote_product_data);
	}

	public function Get_quotations_w_supplier()
	{
		return $this->db->select('quotation.*, sup_cus.sup_cus_company,sup_cus.sup_cus_name,sup_cus.sup_cus_address,sup_cus.sup_cus_phone1')
			->from('quotation')
			->join('sup_cus', 'sup_cus.sup_cus_id = quotation.quotation_supplier_id')
			->get()
			->result_array();
	}

	public function Get_quotation_w_supplier($quotation_id)
	{
		return $this->db->select('quotation.*, sup_cus.sup_cus_company,sup_cus.sup_cus_name,sup_cus.sup_cus_address,sup_cus.sup_cus_phone1,sup_cus.ntn,sup_cus.strn')
			->from('quotation')
			->join('sup_cus', 'sup_cus.sup_cus_id = quotation.quotation_supplier_id')
			->where('quotation_id', $quotation_id)
			->get()
			->result_array();
	}

	public function Get_quotations_w_supplier_date($start_date, $end_date)
	{
		return $this->db->select('quotation.*, sup_cus.sup_cus_company,sup_cus.sup_cus_name,sup_cus.sup_cus_address,sup_cus.sup_cus_phone1')
			->from('quotation')
			->join('sup_cus', 'sup_cus.sup_cus_id = quotation.quotation_supplier_id')
			->where('quotation_order_date >=', $start_date)
			->where('quotation_order_date <=', $end_date)
			->get()
			->result_array();
	}

	public function Delete_quotation($quotation_id)
	{
		$this->db->where('quotation_id', $quotation_id)->delete('quotation');
		$this->db->where('quotation_id', $quotation_id)->delete('quotation_products');
		$this->db->where('quotation_id', $quotation_id)->delete('quotation_services');
	}

	public function Get_quotation($quotation_id)
	{
		return $this->db->where('quotation_id', $quotation_id)->get('quotation')->result_array();
	}

	public function Get_quotation_products_w_names($quotation_id)
	{
		return $this->db->select('*')
			->from('quotation_products')
			->join('product', 'product.product_id = quotation_products.quotation_product_id')
			->where('quotation_id', $quotation_id)
			->get()
			->result_array();
	}

	public function Change_status($status, $quotation_id)
	{
		$data['quotation_order_status'] = $status;
		$this->db->where('quotation_id', $quotation_id)->update('quotation', $data);
	}

	public function Update_quotation($quote_data, $quotation_id)
	{
		$this->db->where('quotation_id', $quotation_id)->update('quotation', $quote_data);
	}

	public function Update_quotation_products($quotation_product_data, $quotation_Products_id)
	{
		$this->db->where('quotation_Products_id', $quotation_Products_id)
			->update('quotation_products', $quotation_product_data);
	}

	public function Insert_qutation_details($quote_detail)
	{
		$this->db->insert('quote_detail', $quote_detail);
	}

	public function Get_quotation_details($quotation_id)
	{
		return $this->db->where('quotation_id', $quotation_id)
			->get('quote_detail')
			->result_array();
	}

	public function Update_qutation_details($quote_detail, $quotation_id)
	{
		return $this->db->where('quotation_id', $quotation_id)
			->update('quote_detail', $quote_detail);
	}

	public function Update_employee_id($quotation_id, $employee_id)
	{
		$data['employee_id'] = $employee_id;
		return $this->db->where('quotation_id', $quotation_id)
			->update('quote_detail', $data);
	}
}
