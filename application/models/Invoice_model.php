<?
class Invoice_model extends CI_Model {
	
	public function make_invoice($invoice_data){
		$this->db->insert('invoice',$invoice_data);
		return $this->db->insert_id();
	}

	public function Insert_invoice_product($invoice_product_data){
		$this->db->insert('invoice_product',$invoice_product_data);
	}

	public function Get_invoice_w_supplier_date($start_date,$end_date){
		return $this->db->select('invoice.*, sup_cus.sup_cus_company,sup_cus.sup_cus_name,sup_cus.sup_cus_address,sup_cus.sup_cus_phone1')
						->from('invoice')
						->join('sup_cus','sup_cus.sup_cus_id = invoice.supplier_id')
						->where('invoice_date >=',$start_date)
						->where('invoice_date <=',$end_date)
						->get()
						->result_array();
	}
	public function get_invoice_sum($ids) {
	    return $this->db->select('invoice_id, SUM(invoice_cost * invoice_qty) as total_cost')
					    ->from('invoice_product')
					    ->where_in('invoice_id', $ids)
					    ->group_by('invoice_id')
					    ->get()
					    ->result_array();
	}
	public function Get_invoice_w_supplier($invoice_id){
		return $this->db->select('*')
						->from('invoice')
						->join('sup_cus','sup_cus.sup_cus_id=invoice.supplier_id')
						->where('invoice_id',$invoice_id)
						->get()
						->result_array();
	}

	public function Get_invoice_products_w_names($invoice_id){
		return $this->db->select('invoice_product.*,product.product_name')
						->from('invoice_product')
						->join('product','product.product_id=invoice_product.product_id')
						->where('invoice_id',$invoice_id)
						->get()
						->result_array();
	}

	public function Get_unique_identifiers($product_id){
		return $this->db->where('product_id', $product_id)
						->where('sold','0')
						->get('unique_identifier')
						->result_array();
	}

	public function Change_invoice_status($data,$invoice_id){
		return $this->db->where('invoice_id',$invoice_id)
						->update('invoice',$data);
	}

	public function Get_unique_identifier($unique_identifier_id){
		return $this->db->select('*')
						->from('unique_identifier')
						->where_in('unique_identifier_id',$unique_identifier_id)
						->get()
						->result_array();

	}

	public function Change_purchase_unique_identifier_sold($unique_identifier_id){
		$data['sold'] = 1;
		$this->db->where('unique_identifier_id',$unique_identifier_id)
				->update('unique_identifier',$data);
	}

	public function Insert_invoice_unique_identifier($invoice_unique_identifier_data){
		$this->db->insert('invoice_unique_identifier',$invoice_unique_identifier_data);
	}

	public function Get_inventory_w_POid($po_id){
		return $this->db->where('purchase_order_id',$po_id)
						->get('inventory')
						->result_array();
	}
	public function Get_inventory_w_product_id($p_id){
		return $this->db->where('inventory_product_id',$p_id)
						->get('inventory')
						->result_array();
	}
	

	public function Update_inventory_qty($inventory_id,$invoice_qty){
		
		$this->db->set('inventory_product_qty', 'inventory_product_qty - ' . $invoice_qty, false)
				->where('inventory_id',$inventory_id)
				->update('inventory');
	}

	public function Insert_sell_dc($dc_data){
		$this->db->insert('sell_dc',$dc_data);
		return $this->db->insert_id();
	}

	public function Insert_dc_products($product_data){
		$this->db->insert('sell_dc_product',$product_data);
	}

	public function Delete_inventory_product($inventory_id){
		$this->db->where('inventory_id',$inventory_id)->delete('inventory');
	}

	public function Get_all_dc($start_date,$end_date){
		return $this->db->select('*')
						->from('sell_dc')
						->join('sup_cus','sup_cus.sup_cus_id = sell_dc.supplier_id')
						->where('date >=',$start_date)
						->where('date <=',$end_date)
						->get()
						->result_array();
	}

	public function Get_dc_w_product_customer($dc_id){
		return $this->db->select('*')
						->from('sell_dc')
						->join('sell_dc_product','sell_dc_product.sell_dc_id = sell_dc.sell_dc_id')
						->join('sup_cus','sup_cus.sup_cus_id=sell_dc.supplier_id')
						->join('product','product.product_id=sell_dc_product.product_id')
						->where('sell_dc.sell_dc_id',$dc_id)
						->get()
						->result_array();
	}
	public function Get_identifier_invoice($invoice_id){
		return $this->db->where('invoice_id',$invoice_id)
						->get('invoice_unique_identifier')
						->result_array();
	}

	public function Get_dc($sell_dc_id){
		return $this->db->where('sell_dc_id', $sell_dc_id)
						->get('sell_dc')
						->result_array();
	}

	public function Get_count_dc_receiving($sell_dc_id){
		return $this->db->select('COUNT(receiving) as count')
						->from('sell_dc_product')
						->where('sell_dc_id',$sell_dc_id)
						->where('receiving',0)
						->get()
						->result_array();
	}

	public function Change_selling_product_dc_receiving($sell_dc_product_id){
		$data['receiving'] = 1;
		return $this->db->where('sell_dc_product_id',$sell_dc_product_id)
						->update('sell_dc_product', $data);
	}
	public function change_selling_dc_status($sell_dc_id){
		$data['status'] = 2;
		return $this->db->where('sell_dc_id',$sell_dc_id)
						->update('sell_dc', $data);
	}
	public function Change_delivery_address_dc($dc_id,$data){
		$this->db->where('sell_dc_id',$dc_id)
				->update('sell_dc', $data);
	}

	public function Delete_invoice($invoice_id){
		$this->db->where('invoice_id',$invoice_id)
				->delete('invoice');
		$this->db->where('invoice_id',$invoice_id)
				->delete('invoice_product');
	}

	public function Get_invoice($invoice_id){
		return $this->db->where('invoice_id', $invoice_id)
						->get('invoice')
						->result_array();
	}

	public function Update_invoice($invoice_data,$invoice_id){
		$this->db->where('invoice_id', $invoice_id)
				->update('invoice',$invoice_data);
	}

	public function Update_invoice_products($invoice_product_data,$invoice_product_id){
		$this->db->where('invoice_poduct_id', $invoice_product_id)
				->update('invoice_product',$invoice_product_data);
	}

	public function Get_cus_sup_invoices($cus_sup_id,$start_date,$end_date){
		return $this->db->select('*')
						->from('invoice')
						->join('invoice_product','invoice_product.invoice_id = invoice.invoice_id')
						->join('product','product.product_id = invoice_product.product_id')
						->where('invoice.supplier_id',$cus_sup_id)
						->where('invoice.invoice_status', '3')
						->where('invoice.invoice_date >=',$start_date)
						->where('invoice.invoice_date <=',$end_date)
						->get()
						->result_array();
	}
	
}