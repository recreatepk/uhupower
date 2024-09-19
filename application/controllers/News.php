<?php
require_once(APPPATH.'controllers/User.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('News_model','NM');
        $this->load->library('User_Utility');
       
    }
	public function index(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(51);
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
		$data['newses'] = $this->NM->Get_newses($start_date,$end_date);
		$this->load->view('news/newses',$data);
	}

	public function add_news(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(52);
		$this->load->view('news/add_news');
	}

	public function adding_news(){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(52);
		$data = $this->input->post();
		$this->NM->Insert_news($data);
		$this->session->set_flashdata('add', 'add');
		redirect("News/add_news");

	}

	public function edit_news($news_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(53);
		$data['news'] = $this->NM->Get_news($news_id);
		$this->load->view('news/edit_news',$data);
	}

	public function editing_news($news_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(53);
		$data = $this->input->post();
		$this->NM->Update_news($data,$news_id);
		$this->session->set_flashdata('edit', 'edit');
		redirect("News/edit_news/$news_id");
	}

	public function delete_news($news_id){
		$this->user_utility->check_login();
		$this->user_utility->check_permission(54);
		$this->NM->Delete_news($news_id);
		$this->session->set_flashdata('del', 'del');
		redirect("News");
	}

	
	
}
