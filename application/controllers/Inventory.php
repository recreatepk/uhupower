<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Inventory_model', 'IM');
		$this->load->model('Warehouse_model', 'WM');
		$this->load->model('Store_model', 'SM');
		$this->load->library('User_Utility');
	}

	public function index()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['warehouses'] = $this->WM->Get_warehouses();
		$data['stores'] = $this->SM->Get_stores();
		$data['inventory'] = $this->IM->Get_all_inventory();
		$data['unique_identifiers'] = $this->IM->Get_unique_identifiers();
		$data['check'] = 3;

		$filtered_identifiers = [];
		$seen = [];

		foreach ($data['unique_identifiers'] as $identifier) {
			$key = $identifier['product_id'] . '-' . $identifier['sr_no'];

			if (!isset($seen[$key])) {
				$filtered_identifiers[] = $identifier;
				$seen[$key] = true;
			}
		}

		$data['unique_identifiers'] = $filtered_identifiers;


		$this->load->view('inventory/inventory', $data);
	}

	public function check_warehouse_inventory($id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['warehouses'] = $this->WM->Get_warehouse($id);
		$data['inventory'] = $this->IM->Get_all_inventory_w_warehouse_id($id);
		$data['unique_identifiers'] = $this->IM->Get_unique_identifiers();
		$data['check'] = 1;

		$filtered_identifiers = [];
		$seen = [];

		foreach ($data['unique_identifiers'] as $identifier) {
			$key = $identifier['product_id'] . '-' . $identifier['sr_no'];

			if (!isset($seen[$key])) {
				$filtered_identifiers[] = $identifier;
				$seen[$key] = true;
			}
		}

		$data['unique_identifiers'] = $filtered_identifiers;

		$this->load->view('inventory/inventory', $data);
	}

	public function check_store_inventory($id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(32);
		$data['stores'] = $this->SM->Get_store($id);
		$data['inventory'] = $this->IM->Get_all_inventory_w_store_id($id);
		$data['unique_identifiers'] = $this->IM->Get_unique_identifiers();
		$data['check'] = 0;
		$this->load->view('inventory/inventory', $data);
	}

}
