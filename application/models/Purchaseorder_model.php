<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model
{


	public function Insert_po($PO_data)
	{
		$this->db->insert('purchase_order', $PO_data);
		return $this->db->insert_id();
	}

	public function Insert_po_products($product_data)
	{
		$this->db->insert('purchase_order_product', $product_data);

	}

	public function Get_all_po_product($id)
	{
		return $this->db->select('purchase_order_product.*, product.product_name, product.product_description')
			->from('purchase_order_product')
			->join('product', 'purchase_order_product.purchase_order_product_id = product.product_id')
			->where('purchase_order_id', $id)
			->get()
			->result_array();
	}


	public function Get_all_po_w_supplier($start_date, $end_date)
	{
		return $this->db->select('*')
			->from('purchase_order')
			->join('sup_cus', 'sup_cus.sup_cus_id=purchase_order.purchase_order_supplier_id')
			->where('purchase_order_date >=', $start_date)
			->where('purchase_order_date <=', $end_date)
			->get()
			->result_array();
	}

	public function Get_po($id)
	{
		return $this->db->where('purchase_order_id', $id)
			->get('purchase_order')->result_array();
	}

	public function Change_purchase_order_status($id, $data)
	{
		$this->db->where('purchase_order_id', $id)
			->update('purchase_order', $data);
	}

	public function Delete_po_products_w_po_id($id)
	{
		$this->db->where('purchase_order_id', $id)
			->delete('purchase_order_product');
	}

	public function Update_Purchaseorder($PO_data, $id)
	{
		$this->db->where('purchase_order_id', $id)
			->update('purchase_order', $PO_data);
	}

	public function Delete_Purchaseorder($id)
	{
		$this->db->where('purchase_order_id', $id)
			->delete('purchase_order');
	}

	public function Create_dc($dc_data)
	{
		$this->db->insert('purchase_dc', $dc_data);
	}

	public function Get_cus_sup_po($cus_sup_id, $start_date, $end_date)
	{
		return $this->db->select('*')
			->from('purchase_order')
			->join('purchase_order_product', 'purchase_order_product.purchase_order_id = purchase_order.purchase_order_id ')
			->join('product', 'product.product_id = purchase_order_product.purchase_order_product_id')
			->where('purchase_order.purchase_order_supplier_id', $cus_sup_id)
			->where('purchase_order.purchase_order_status', '2')
			->where('purchase_order.purchase_order_date >=', $start_date)
			->where('purchase_order.purchase_order_date <=', $end_date)
			->get()
			->result_array();
	}
}
