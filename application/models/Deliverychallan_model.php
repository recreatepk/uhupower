<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliverychallan_model extends CI_Model {

	public function Get_dc_w_count_product($start_date,$end_date){
		return $this->db->query("SELECT
							    purchase_dc_purchase_order_id,
							    SUM(DISTINCT purchase_dc_qty) AS purchase_dc_qty,
							    COUNT(DISTINCT purchase_dc_product_id) AS purchase_dc_product_id,
							    CASE
							        WHEN SUM(purchase_dc_receiving) = 0 THEN '0'
							        WHEN SUM(purchase_dc_receiving) = COUNT(purchase_dc_receiving) THEN '1'
							        ELSE '2'
							    END AS receiving_status
								FROM
								    purchase_dc
								WHERE
									purchase_dc_date >= '$start_date'
									AND
									purchase_dc_date <= '$end_date'
								GROUP BY
								    purchase_dc_purchase_order_id
								ORDER BY 
									purchase_dc_id;")->result_array();
	}

	public function Get_dc_w_product($id){
		return $this->db->select('*')
						->from('purchase_dc')
						->join('product','product.product_id = purchase_dc.purchase_dc_product_id')
						->where('purchase_dc_purchase_order_id',$id)
						->order_by('purchase_dc_id')
						->get()
						->result_array();
	}

	public function change_purchase_dc_receiving($purchase_dc_id,$data){
		$this->db->where('purchase_dc_id', $purchase_dc_id)
				->update('purchase_dc',$data);
	}

	public function Get_dc_by_po_id($po_id){
		return $this->db->where('purchase_dc_purchase_order_id', $po_id)
						->get('purchase_dc')
						->result_array();
	}

	public function Insert_inventory($inventory_data){
		$this->db->insert('inventory', $inventory_data);
	}

	public function Insert_dc_rcv_qty($rcv_qty,$dc_id){
		$data['purchase_dc_qty_rcv'] = $rcv_qty;
		$this->db->set('purchase_dc_qty_rcv', "purchase_dc_qty_rcv + $rcv_qty", FALSE)
				->where('purchase_dc_id',$dc_id)
				->update('purchase_dc');

		$this->db->where('purchase_dc_id', $dc_id)
	             ->where('purchase_dc_qty', 'purchase_dc_qty_rcv', FALSE)
	             ->update('purchase_dc', ['purchase_dc_receiving' => 1]);
	}

	public function Insert_unique_identifier($product_data){
		// print_r($product_data);
		$this->db->insert('unique_identifier',$product_data);
	}

	public function Update_inventory($inventory_product_qty,$product_id){
		$this->db->set('inventory_product_qty', "inventory_product_qty + $inventory_product_qty", FALSE)
				->where('inventory_product_id ',$product_id)
				->update('inventory');
	}

}
