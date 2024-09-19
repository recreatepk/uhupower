<?php
require_once(APPPATH.'controllers/User.php');
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property user_utility $user_utility
 * @property input $input
 * @property Purchaseorder_model $PO
 * @property Product_model $PM
 * @property Supplier_model $SM
 * @property session $session
 * @property Deliverychallan_model $DCM
 * @property Inventory_model $IM
 * 
 */

class Delivery_challan extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Product_model','PM');
        $this->load->model('Deliverychallan_model', 'DCM');
        $this->load->model('Supplier_model', 'SM');
        $this->load->model('Purchaseorder_model', 'PO');
        $this->load->model('Inventory_model', 'IM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(33);
		$input_data = $this->input->post('dates');
		if (isset($input_data) && !empty($input_data) && $input_data != '') {
			$data['date'] = $input_data;
			$temp = explode('-',$input_data);
			$start_date = date('Y/m/d`',strtotime($temp[0]));
			$end_date = date('Y/m/d',strtotime($temp[1]));
			// echo 'with date';	
		}else{
			$current_date = date('m/d/Y');
			$one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
			$data['date'] = $one_week . ' - ' . $current_date;
			$start_date = date('Y/m/d',strtotime($one_week));
    		$end_date = date('Y/m/d',strtotime($current_date));
		}
		$data['dcs'] = $this->DCM->Get_dc_w_count_product($start_date,$end_date);
		$this->load->view('delivery_challan/delivery_challans',$data);
	}

	public function view_dc($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(33);
		$data['pos'] = $this->PO->Get_po($id);
		$data['dcs'] = $this->DCM->Get_dc_w_product($id);
		foreach ($data['pos'] as $po) {
			$data['suppliers'] = $this->SM->Get_supplier($po['purchase_order_supplier_id']);
			$data['Products'][] = $this->PO->Get_all_po_product($id);
		}
		$this->load->view('delivery_challan/delivery_chillan',$data);
	}

	public function recieve_dc($id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(34);
		$data['pos'] = $this->PO->Get_po($id);
		$data['dcs'] = $this->DCM->Get_dc_w_product($id);
		foreach ($data['pos'] as $po) {
			$data['suppliers'] = $this->SM->Get_supplier($po['purchase_order_supplier_id']);
		}
		$this->load->view('delivery_challan/recieve_delivery_chillan',$data);
	}

	public function recv_dc_product($purchase_dc_id,$po_id){
		
		if ($_SESSION['id'] == 1) {
			$data['msg'] = 'You are super admin not attached to any warehouse/store, please login with the warehouse/store manager account to receive Goods';
			$data['error_code'] = 'P-403';
			$this->load->view('permission_denied', $data);
		}else{
			$data['purchase_dc_receiving'] = 1;
			$count_received = 0;
			$this->DCM->change_purchase_dc_receiving($purchase_dc_id,$data);
			$check = $this->DCM->Get_dc_by_po_id($po_id);
			
			$count_check = count($check);
			foreach ($check as $item) {
				if ($item['purchase_dc_receiving'] == 1) {
					$count_received++;
				}
			}

			if ($count_received == $count_check) {
				$po_data = $this->PO->Get_all_po_product($po_id);

				foreach ($po_data as $po) {
					$inventory['inventory_location'] 		= $_SESSION['employee_warehousing_access'];
					$inventory['inventory_product_id'] 		= $po['purchase_order_product_id'];
					$inventory['inventory_product_qty'] 	= $po['purchase_order_product_qty'];
					$inventory['inventory_product_cost'] 	= $po['purchase_order_product_cost'];
					$inventory['inventory_loc_id'] 			= $_SESSION['employee_warehousing_id'];
					$this->DCM->Insert_inventory($inventory);
				}
				
			}
			redirect("Delivery_challan/recieve_dc/$po_id");
		}
	}

	public function receive_items($check,$po_id){
		$rcv_qty = $this->input->post('purchase_dc_qty_rcv');
		$dc_id = $this->input->post('purchase_dc_id');
		$product_id = $this->input->post('product_id');
		$Sr_no = $this->input->post('sr_no');
		if ($_SESSION['id'] == 1) {
			$data['msg'] = 'You are super admin not attached to any warehouse/store, please login with the warehouse/store manager account to receive Goods';
			$data['error_code'] = 'P-403';
			$this->load->view('permission_denied', $data);
		}else{
			if ($check == 1) {
				$this->DCM->Insert_dc_rcv_qty($rcv_qty,$dc_id);
				$dc_updated_data = $this->DCM->Get_dc_by_po_id($po_id);
				$purchase_orders = $this->PO->Get_all_po_product($po_id);
				foreach ($dc_updated_data as $dud) {
					if($dud['purchase_dc_product_id'] == $product_id){
						if ($rcv_qty >= 1) {
							$inventory = $this->IM->Check_inventory($dud['purchase_dc_product_id']);
							foreach ($inventory as $product) {
								$product_id_inventory 		= $product['inventory_product_id'];
								$inventory_product_qty		= $rcv_qty;
								$this->DCM->Update_inventory($inventory_product_qty,$product_id_inventory);
							}
							if(empty($inventory)){
								$new_inventory['inventory_location'] 		= $_SESSION['employee_warehousing_access'];
								$new_inventory['inventory_product_id'] 		= $dud['purchase_dc_product_id'];
								foreach ($purchase_orders as $purchase_order) {
									if($dud['purchase_dc_product_id'] == $purchase_order['purchase_order_product_id']){
										$purchasr_cost = $purchase_order['purchase_order_product_cost'];
									}
								}
								$new_inventory['inventory_product_cost'] 	= $purchasr_cost;
								$new_inventory['inventory_product_qty'] 	= $rcv_qty;
								$new_inventory['inventory_loc_id'] 			= $_SESSION['employee_warehousing_id'];
								$this->DCM->Insert_inventory($new_inventory);
							}
						}
					}
				}
			}if ($check == 2) {
				$product_data = $this->DCM->Insert_dc_rcv_qty($rcv_qty,$dc_id);
				$dc_updated_data = $this->DCM->Get_dc_by_po_id($po_id);
				$purchase_orders = $this->PO->Get_all_po_product($po_id);

				foreach ($dc_updated_data as $dud) {
					if($dud['purchase_dc_product_id'] == $product_id){
						if ($rcv_qty >= 1) {
							$inventory = $this->IM->Check_inventory($dud['purchase_dc_product_id']);
							foreach ($inventory as $product) {
								$product_id_inventory 		= $product['inventory_product_id'];
								$inventory_product_qty		= $rcv_qty;
								$this->DCM->Update_inventory($inventory_product_qty,$product_id_inventory);
							}
							if(empty($inventory)){
								$new_inventory['inventory_location'] 		= $_SESSION['employee_warehousing_access'];
								$new_inventory['inventory_product_id'] 		= $dud['purchase_dc_product_id'];
								foreach ($purchase_orders as $purchase_order) {
									if($dud['purchase_dc_product_id'] == $purchase_order['purchase_order_product_id']){
										$purchasr_cost = $purchase_order['purchase_order_product_cost'];
									}
								}
								$new_inventory['inventory_product_cost'] 	= $purchasr_cost;
								$new_inventory['inventory_product_qty'] 	= $rcv_qty;
								$new_inventory['inventory_loc_id'] 			= $_SESSION['employee_warehousing_id'];
								$this->DCM->Insert_inventory($new_inventory);
							}
						}
					}
				}

				if ($Sr_no != '' && !empty($Sr_no) && isset($Sr_no)) {
					foreach ($Sr_no as $unique) {
						if ($unique != '') {
							$unique_identifier['sr_no'] 				= $unique;
							$unique_identifier['product_id'] 			= $product_id;
							$this->DCM->Insert_unique_identifier($unique_identifier);
						}
					}
				}
			}
			redirect("Delivery_challan/recieve_dc/$po_id");
		}

	}

	
	
}