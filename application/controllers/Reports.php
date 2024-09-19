<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Supplier_model','SM');
        $this->load->model('Invoice_model','IM');
        $this->load->model('Purchaseorder_model','POM');
        $this->load->model('Service_model','SerM');
        $this->load->model('Report_model','RM');
        $this->load->library('User_Utility');
       
    }

    public function ledger($temp){
        $this->user_utility->check_login();
        $this->user_utility->check_permission(81);
    	$data['suppliers'] = $this->SM->Get_all_supplier();
        $data['check'] = $temp;
        $this->load->view('reports/ledger',$data);
    }

    public function cus_sup_ledger(){
        $this->user_utility->check_login();
        $this->user_utility->check_permission(81);

        $cus_sup_id = $this->input->post('supplier_id');
        $date = $this->input->post('dates');
        // print_r($date);die;
        if (isset($date) && !empty($date) && $date != '') {
            $data['date'] = $date;
            $temp = explode('-',$date);
            $start_date = date('Y/m/d',strtotime($temp[0]));
            $end_date = date('Y/m/d',strtotime($temp[1]));
            // echo 'with date';    
        }else{
            $current_date = date('m/d/Y');
            $one_week = date('m/d/Y', strtotime('-1 week', strtotime($current_date)));
            $data['date'] = $one_week . ' - ' . $current_date;
            $start_date = date('Y/m/d',strtotime($one_week));
            $end_date = date('Y/m/d',strtotime($current_date));
        }
        $data['sup']        = $this->SM->Get_supplier($cus_sup_id);
        $data['suppliers']  = $this->SM->Get_all_supplier();
        $data['invoices']   = $this->IM->Get_cus_sup_invoices($cus_sup_id,$start_date,$end_date);
        $data['pos']        = $this->POM->Get_cus_sup_po($cus_sup_id,$start_date,$end_date);
        $data['services']   = $this->SerM->Get_cus_sup_services($cus_sup_id,$start_date,$end_date);
        $data['deb_cre']    =  $this->RM->Get_debt_credit($cus_sup_id,$start_date,$end_date);
        $data['payment']    =  $this->RM->Get_payment($cus_sup_id,$start_date,$end_date);

        // print_r($data);die;
        $combinedArray = array_merge($data['pos'], $data['invoices'], $data['services'], $data['deb_cre'],$data['payment']);
        
        function customSort($a, $b) {
            $aDate = strtotime(
                isset($a['invoice_date']) ? $a['invoice_date'] :
                (isset($a['purchase_order_date']) ? $a['purchase_order_date'] :
                (isset($a['date']) ? $a['date'] : (isset($a['payment_date']) ? $a['payment_date']: '')))
            );

            $bDate = strtotime(
                isset($b['invoice_date']) ? $b['invoice_date'] :
                (isset($b['purchase_order_date']) ? $b['purchase_order_date'] :
                (isset($b['date']) ? $b['date'] : (isset($b['payment_date']) ? $b['payment_date']: '')))
            );

            return $aDate - $bDate;
        }

        // Sort the combined array using the custom sorting function
        usort($combinedArray, 'customSort');

        $data['combinedArray'] = $combinedArray;
        // print_r($data);die;
        $data['check'] = $this->input->post('check');
        $this->load->view('reports/cus_ledger',$data);

    }

    public function deb_cred_note($check){
        $this->user_utility->check_login();
        $this->user_utility->check_permission(82);
        $data['suppliers']  = $this->SM->Get_all_supplier();
        $data['check'] = $check;
        $this->load->view('deb_cred_note/deb_cred_note',$data);
    }

    public function adding_deb_cred_note(){
        $data = $this->input->post();
        $check = $data['check'];
        unset($data['check']);
        $this->RM->Insert_deb_cred_note($data);
        $this->session->set_flashdata('add', 'add');
        redirect("Reports/deb_cred_note/$check");
    }


    public function payments($check){
        $this->user_utility->check_login();
        $this->user_utility->check_permission(82);
        $data['invoices']   = $this->RM->Get_invoice_ids();
        $data['purchase_orders']   = $this->RM->Get_purchase_order_ids();
        $data['render_services']   = $this->RM->Get_render_service_ids();
        $data['suppliers']  = $this->SM->Get_all_supplier();
        $data['check'] = $check;
        // print_r($data);die;
        $this->load->view('deb_cred_note/payment',$data);
    }
    public function adding_payments(){
        $data = $this->input->post();
        $check = $data['check'];

        $temp                       =   explode('-', $data['ref']);

        $payment_ref                 =   $temp[0];
        $type                        =   $temp[1];

        $payment['sup_cus_id']       =   $data['sup_cus_id'];
        $payment['payment_ref']      =   $payment_ref;
        $payment['type']             =   $type;
        $payment['particular']       =   $data['particular'];
        $payment['payment_amount']   =   $data['amount'];
        $payment['payment_date']     =   $data['date'];

        $this->RM->Insert_payments($payment);
        $this->session->set_flashdata('add', 'add');
        redirect("Reports/payments/$check");
    }
}
