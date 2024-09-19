<?php

require_once(APPPATH . 'controllers/User.php');
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model', 'UM');
		$this->load->model('Setting_model', 'SM');
		$this->load->library('User_Utility');
	}

	public function index()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(4);
	}

	public function settings()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(13);
		$data['data'] = $this->SM->Get_company();
		$data['settings'] = $data['data'][0];

		$this->load->view('settings/settings', $data);
	}

	public function editing_company($id)
	{
		$data = $this->input->post();
		$upload_folder = './uploads/company/';
		$cache = APPPATH . '/cache/office_data';

		if (!file_exists($upload_folder)) {
			mkdir($upload_folder, 0777, true);
		}

		// Validate and upload CV
		if ($_FILES['company_logo_name']['name']) {
			$company_logo_name = $_FILES['company_logo_name']['name'];
			$company_logo_ext = pathinfo($company_logo_name, PATHINFO_EXTENSION);
			$valid_formats = array('jpg', 'jpeg', 'png');

			if (in_array($company_logo_ext, $valid_formats)) {
				$new_company_logo_name = "company_logo." . $company_logo_ext; // Change the file name as desired
				$company_logo_path = $upload_folder . $new_company_logo_name; // Set the destination folder path

				if (file_exists($company_logo_path)) {
					unlink($company_logo_path); // Delete the existing file
				}

				move_uploaded_file($_FILES['company_logo_name']['tmp_name'], $company_logo_path);
				$data['company_logo_name'] = $new_company_logo_name;
			} else {
				$this->session->set_flashdata('error', 'error');
				redirect('settings/settings');
			}
		}

		if ($_FILES['company_logo_name2']['name']) {
			$company_logo_name2 = $_FILES['company_logo_name2']['name'];
			$company_logo_ext2 = pathinfo($company_logo_name2, PATHINFO_EXTENSION);
			$valid_formats = array('jpg', 'jpeg', 'png');

			if (in_array($company_logo_ext2, $valid_formats)) {
				$new_company_logo_name2 = "company_logo2." . $company_logo_ext2; // Change the file name as desired
				$company_logo_path2 = $upload_folder . $new_company_logo_name2; // Set the destination folder path

				if (file_exists($company_logo_path2)) {
					unlink($company_logo_path2); // Delete the existing file
				}

				move_uploaded_file($_FILES['company_logo_name2']['tmp_name'], $company_logo_path2);
				$data['company_logo_name2'] = $new_company_logo_name2;
			} else {
				$this->session->set_flashdata('error', 'error');

				redirect('settings/settings');
			}
		}

		if ($_FILES['company_favicon']['name']) {
			$company_favicon_name = $_FILES['company_favicon']['name'];
			$company_favicon_ext = pathinfo($company_favicon_name2, PATHINFO_EXTENSION);
			$valid_formats = array('jpg', 'jpeg', 'png');
			if (in_array($company_favicon_ext, $valid_formats)) {
				$new_company_favicon_name = "favicon." . $company_favicon_ext; // Change the file name as desired
				$company_favicon_path = $upload_folder . $new_company_favicon_name; // Set the destination folder path
				if (file_exists($company_favicon_path)) {
					unlink($company_favicon_path); // Delete the existing file
				}
				move_uploaded_file($_FILES['company_favicon_name']['tmp_name'], $company_favicon_path);
				$data['company_favicon'] = $new_company_favicon_name;
			} else {
				$this->session->set_flashdata('error', 'error');
				redirect('settings/settings');
			}
		}
		if ($_FILES['company_loginpic_name']['name']) {
			$company_loginpic_name = $_FILES['company_loginpic_name']['name'];
			$company_loginpic_ext = pathinfo($company_loginpic_name, PATHINFO_EXTENSION);
			$valid_formats = array('jpg', 'jpeg', 'png');
			if (in_array($company_loginpic_ext, $valid_formats)) {
				$new_company_loginpic_name = "company_loginpic." . $company_loginpic_ext; // Change the file name as desired
				$company_loginpic_path = $upload_folder . $new_company_loginpic_name; // Set the destination folder path
				if (file_exists($company_loginpic_path)) {
					unlink($company_loginpic_path); // Delete the existing file
				}
				move_uploaded_file($_FILES['company_loginpic_name']['tmp_name'], $company_loginpic_path);
				$data['company_loginpic_name'] = $new_company_loginpic_name;
			} else {
				$this->session->set_flashdata('error', 'error');
				redirect('settings/settings');
			}
		}

		$this->SM->Update_company_settings($data, $id);
		if (file_exists($cache)) {
			unlink($cache); // Delete the existing file
		}
		$this->session->set_flashdata('update', 'update');
		redirect('settings/settings');
	}

}
