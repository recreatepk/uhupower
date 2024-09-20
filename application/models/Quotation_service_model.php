<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation_service_model extends CI_Model {

	public function Get_quotation_service($quotes_ids)
	{
		if (empty($quotes_ids)) {
			return [];
		}

		return $this->db->select('*')
			->from('quotation_services')
			->join('services', 'services.service_id = quotation_services.render_service_id')
			->where_in('quotation_id', $quotes_ids)
			->get()->result_array();
	}

	public function Get_quotation($start_date, $end_date)
	{
		return $this->db->select('*')
			->from('quotation')
			->where('quotation.quotation_order_date >=', $start_date)
			->where('quotation.quotation_order_date <=', $end_date)
			->get()
			->result_array();
	}

	public function Insert_quotation_service($quote_service)
	{
		$this->db->insert('quotation_services', $quote_service);
	}

	public function Update_quotation_service($quote_service, $quotation_id)
	{
		$this->db->where('quotation_id', $quotation_id)
			->update('quotation_services', $quote_service);
	}
}
