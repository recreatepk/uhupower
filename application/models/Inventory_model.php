<?

class Inventory_model extends CI_Model
{

	public function Get_all_inventory()
	{
		return $this->db->select('*')
			->from('inventory')
			->join('product', 'product.product_id = inventory.inventory_product_id')
			->join('product_category', 'product_category.product_category_id = product.product_category_id')
			->get()
			->result_array();
	}

	public function Get_all_inventory_w_warehouse_id($id)
	{
		return $this->db->select('*')
			->from('inventory')
			->join('product', 'product.product_id = inventory.inventory_product_id')
			->join('product_category', 'product_category.product_category_id = product.product_category_id')
			->where('inventory.inventory_location', 1)
			->where('inventory.inventory_loc_id', $id)
			->get()
			->result_array();

	}

	public function Get_all_inventory_w_store_id($id)
	{
		return $this->db->select('*')
			->from('inventory')
			->join('product', 'product.product_id = inventory.inventory_product_id')
			->join('product_category', 'product_category.product_category_id = product.product_category_id')
			->where('inventory.inventory_location', 0)
			->where('inventory.inventory_loc_id', $id)
			->get()
			->result_array();

	}

	public function Get_unique_identifiers()
	{
		return $this->db->select('*')
			->from('unique_identifier')
			->where('sold', '0')
			->get()
			->result_array();

	}

	public function Check_inventory($product_id)
	{
		return $this->db->where('inventory_product_id', $product_id)
			->get('inventory')
			->result_array();
	}
}
