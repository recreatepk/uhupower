<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model {


	public function Insert_product_cat($data){
		$this->db->insert('product_category', $data);
	}
	public function Get_all_product_cat(){
		return $this->db->get('product_category')->result_array();
	}
	public function Get_product_cat($id){
		return $this->db->where('product_category_id',$id)
						->get('product_category')->result_array();
	}
	public function Update_product_cat($id,$data){
		$this->db->where('product_category_id', $id)
				->update('product_category',$data);
	}
	public function Delete_product_cat($id){
		$this->db->where('product_category_id', $id)
					->delete('product_category');
	}



	public function Get_all_products_w_cat(){
		return $this->db->select('product.product_name,product.product_id,product.product_description,product_category.product_category_name,product_category.product_category_desc')
						->from('product')
						->join('product_category','product_category.product_category_id  = product.product_category_id')
						->get()
						->result_array();
	}

	public function Insert_product($data){
		$this->db->insert('product', $data);
	}
	public function Get_all_products(){
		return $this->db->get('product')->result_array();
	}
	public function Get_product($id){
		return $this->db->where('product_id',$id)
						->get('product')
						->result_array();
	}
	public function Update_product($id,$data){
		$this->db->where('product_id', $id)
				->update('product',$data);
	}
	public function Delete_product($id){
		$this->db->where('product_id', $id)
					->delete('product');
	}

	public function Get_product_inventory(){
		return $this->db->select('product.product_name, product.product_category_id, product.product_id, product_category.product_category_name, inventory.inventory_product_qty, inventory.inventory_product_cost')
						->from('product')
						->join('product_category', 'product_category.product_category_id = product.product_category_id')
						->join('inventory', 'inventory.inventory_product_id = product.product_id')
						->get()
						->result_array();
	}

	
	
	

}
