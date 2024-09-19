<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model', 'UM');
		$this->load->model('Store_model', 'SM');
		$this->load->model('Warehouse_model', 'WM');
		$this->load->model('Department_model', 'DM');
		$this->load->library('User_Utility');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login_submit()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$data = $this->UM->check_login($email, $password);

		if ($data != '' && !empty($data)) {
			$sess_data = array('id' => $data[0]['employee_id'],
				'username' => $data[0]['employee_name'],
				'department_id' => $data[0]['department_id'],
				'employee_warehousing_access' => $data[0]['employee_warehousing_access'],
				'employee_warehousing_id' => $data[0]['employee_warehousing_id'],
				'employee_company_id' => $data[0]['employee_company_id']);
			$this->session->set_userdata($sess_data);
			$this->get_permission($data[0]['employee_id']);
			$this->session->set_flashdata('good', 'good');

			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', 'error');

			redirect('user/login');
		}
	}

	public function Login()
	{
		$this->load->view('login');
	}


	public function get_permission($user_id)
	{
		$data = $this->UM->Get_user_permissions($user_id);
		$module_id = array();

		foreach ($data as $dat) {
			$module_id[] = $dat['module_id'];
		}

		$session_data = array('module_id' => $module_id);
		$this->session->set_userdata($session_data);
	}


	public function permission_denied()
	{
		$this->load->view('permission_denied');
	}

	//session history
	public function ses_dis($emp_id)
	{
		$this->session->sess_destroy();

		redirect('User/login');
	}

	public function user()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(4);
		$data['users'] = $this->UM->Get_all_users();
		$data['user_groups'] = $this->UM->Get_all_usergroups();
		$this->load->view('user/user', $data);
	}

	public function add_user()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(8);
		$data['departments'] = $this->DM->Get_departments();
		$data['stores'] = $this->SM->Get_stores();
		$data['warehouses'] = $this->WM->Get_warehouses();
		$data['user_groups'] = $this->UM->Get_all_usergroups();
		$this->load->view('user/add_user', $data);
	}

	public function adding_user()
	{
		$data = $this->input->post();
		$upload_folder = './uploads/' . $data['employee_code'] . '/';

		if (!file_exists($upload_folder)) {
			mkdir($upload_folder, 0777, true);
		}

		// Validate and upload signature
		if (isset($data['signFile']) && !empty($data['signFile'])) {
			if ($_FILES['signFile']['name']) {
				$sign_name = $_FILES['signFile']['name'];
				$sign_ext = pathinfo($sign_name, PATHINFO_EXTENSION);
				$valid_formats = array('png');
				if (in_array($sign_ext, $valid_formats)) {
					$new_sign_name = "sign." . $sign_ext; // Change the file name as desired
					$sign_path = $upload_folder . $new_sign_name; // Set the destination folder path
					if (file_exists($sign_path)) {
						unlink($sign_path); // Delete the existing file
					}
					$data['employee_sign_file'] = $new_cv_name;

					move_uploaded_file($_FILES['signFile']['tmp_name'], $sign_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}

		// Validate and upload CV
		if (isset($data['cv']) && !empty($data['cv'])) {
			if ($_FILES['cv']['name']) {
				$cv_name = $_FILES['cv']['name'];
				$cv_ext = pathinfo($cv_name, PATHINFO_EXTENSION);
				$valid_formats = array('jpg', 'jpeg', 'png', 'pdf');
				if (in_array($cv_ext, $valid_formats)) {
					$new_cv_name = "CV." . $cv_ext; // Change the file name as desired
					$cv_path = $upload_folder . $new_cv_name; // Set the destination folder path
					if (file_exists($cv_path)) {
						unlink($cv_path); // Delete the existing file
					}
					$data['employee_cv_file'] = $new_cv_name;

					move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}

		if (isset($data['cd']) && !empty($data['cd'])) {
			if ($_FILES['cd']['name']) {
				$cd_name = $_FILES['cd']['name'];
				$cd_ext = pathinfo($cd_name, PATHINFO_EXTENSION);
				$valid_formats = array('jpg', 'jpeg', 'png', 'pdf');
				if (in_array($cv_ext, $valid_formats)) {
					$new_cd_name = "CD." . $cd_ext; // Change the file name as desired
					$cd_path = $upload_folder . $new_cd_name; // Set the destination folder path
					if (file_exists($cd_path)) {
						unlink($cd_path); // Delete the existing file
					}
					$data['employee_cd_file'] = $new_cd_name;

					move_uploaded_file($_FILES['cd']['tmp_name'], $cd_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}

		if (isset($data['cnic']) && !empty($data['cnic'])) {
			if ($_FILES['cnic']['name']) {
				$cnic_name = $_FILES['cnic']['name'];
				$cnic_ext = pathinfo($cnic_name, PATHINFO_EXTENSION);
				$valid_formats = array('jpg', 'jpeg', 'png', 'pdf');
				if (in_array($cnic_ext, $valid_formats)) {
					$new_cnic_name = "CNIC." . $cnic_ext; // Change the file name as desired
					$cnic_path = $upload_folder . $new_cnic_name; // Set the destination folder path
					if (file_exists($cnic_path)) {
						unlink($cnic_path); // Delete the existing file
					}
					$data['employee_cnic_file'] = $new_cnic_name;

					move_uploaded_file($_FILES['cnic']['tmp_name'], $cnic_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}
		unset($data['signFile']);
		unset($data['cv']);
		unset($data['cd']);
		unset($data['cnic']);
		if ($data['account_active'] == 'on') {
			$data['account_active'] = 1;
		}
		if (!isset($data['account_active'])) {
			$data['account_active'] = 0;
		}

		$this->UM->Insert_user($data);
		$this->session->set_flashdata('add', 'add');
		redirect('User/add_user');
	}

	public function edit_user($user_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(5);
		$data['departments'] = $this->DM->Get_departments();
		$data['users'] = $this->UM->Get_user($user_id);
		$data['stores'] = $this->SM->Get_stores();
		$data['warehouses'] = $this->WM->Get_warehouses();
		$data['user_groups'] = $this->UM->Get_all_usergroups();
		$this->load->view('user/edit_user', $data);
	}

	public function editing_user($user_id)
	{
		$data = $this->input->post();
		// Validate and upload signature
		if (isset($data['signFile']) && !empty($data['signFile'])) {
			if ($_FILES['signFile']['name']) {
				$sign_name = $_FILES['signFile']['name'];
				$sign_ext = pathinfo($sign_name, PATHINFO_EXTENSION);
				$valid_formats = array('png');
				if (in_array($sign_ext, $valid_formats)) {
					$new_sign_name = "sign." . $sign_ext; // Change the file name as desired
					$sign_path = $upload_folder . $new_sign_name; // Set the destination folder path
					if (file_exists($sign_path)) {
						unlink($sign_path); // Delete the existing file
					}
					$data['employee_sign_file'] = $new_cv_name;

					move_uploaded_file($_FILES['signFile']['tmp_name'], $sign_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}
		if (isset($data['cv']) && !empty($data['cv'])) {
			if ($_FILES['cv']['name']) {
				$cv_name = $_FILES['cv']['name'];
				$cv_ext = pathinfo($cv_name, PATHINFO_EXTENSION);
				$valid_formats = array('jpg', 'jpeg', 'png', 'pdf');
				if (in_array($cv_ext, $valid_formats)) {
					$new_cv_name = "CV." . $cv_ext; // Change the file name as desired
					$cv_path = $upload_folder . $new_cv_name; // Set the destination folder path
					if (file_exists($cv_path)) {
						unlink($cv_path); // Delete the existing file
					}
					$data['employee_cv_file'] = $new_cv_name;

					move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}
		if (isset($data['cd']) && !empty($data['cd'])) {
			if ($_FILES['cd']['name']) {
				$cd_name = $_FILES['cd']['name'];
				$cd_ext = pathinfo($cd_name, PATHINFO_EXTENSION);
				$valid_formats = array('jpg', 'jpeg', 'png', 'pdf');
				if (in_array($cv_ext, $valid_formats)) {
					$new_cd_name = "CD." . $cd_ext; // Change the file name as desired
					$cd_path = $upload_folder . $new_cd_name; // Set the destination folder path
					if (file_exists($cd_path)) {
						unlink($cd_path); // Delete the existing file
					}
					$data['employee_cd_file'] = $new_cd_name;

					move_uploaded_file($_FILES['cd']['tmp_name'], $cd_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}
		if (isset($data['cnic']) && !empty($data['cnic'])) {
			if ($_FILES['cnic']['name']) {
				$cnic_name = $_FILES['cnic']['name'];
				$cnic_ext = pathinfo($cnic_name, PATHINFO_EXTENSION);
				$valid_formats = array('jpg', 'jpeg', 'png', 'pdf');
				if (in_array($cnic_ext, $valid_formats)) {
					$new_cnic_name = "CNIC." . $cnic_ext; // Change the file name as desired
					$cnic_path = $upload_folder . $new_cnic_name; // Set the destination folder path
					if (file_exists($cnic_path)) {
						unlink($cnic_path); // Delete the existing file
					}
					$data['employee_cnic_file'] = $new_cnic_name;

					move_uploaded_file($_FILES['cnic']['tmp_name'], $cnic_path);
				} else {
					echo "Wrong file format, Please try again";
				}
			}
		}
		unset($data['signFile']);
		unset($data['cv']);
		unset($data['cd']);
		unset($data['cnic']);
		if ($data['account_active'] == 'on') {
			$data['account_active'] = 1;
		}
		if (!isset($data['account_active'])) {
			$data['account_active'] = 0;
		}

		$this->UM->Update_user($data, $user_id);
		$this->session->set_flashdata('edit', 'edit');
		redirect("User/edit_user/$user_id");
	}

	public function delete_user($user_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(6);
		$this->UM->Delete_user($user_id);
		$this->session->set_flashdata('del', 'del');
		redirect('User/user');
	}

	public function user_group()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(11);
		$data['user_groups'] = $this->UM->Get_all_usergroups();
		$this->load->view('user/user_group', $data);
	}

	public function add_user_group()
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(9);
		$data['permissions'] = $this->UM->Get_all_modules();
		$data['main_modules'] = $this->UM->Get_all_main_modules();
		$this->load->view('user/add_user_group', $data);
	}

	public function adding_user_group()
	{
		$name = $this->input->post('user_group_name');
		$module = $this->input->post('permission');
		$group['user_group_name'] = $name;
		$user_group_id = $this->UM->Insert_user_group($group);
		foreach ($module as $mod) {
			$this->UM->Insert_permission($user_group_id, $mod);
		}
		$this->session->set_flashdata('add', 'add');
		redirect('user/add_user_group');

	}

	public function delete_user_group($user_group_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(12);
		$this->UM->Delete_user_group($user_group_id);
		$this->session->set_flashdata('del', 'del');
		redirect('user/user_group');
	}

	public function edit_user_group($user_group_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(10);
		$data['user_group'] = $this->UM->Get_usergroup($user_group_id);
		$data['modules'] = $this->UM->Get_all_modules();
		$data['main_modules'] = $this->UM->Get_all_main_modules();
		$data['permissions_given'] = $this->UM->Get_permission($user_group_id);
		// print_r($data);die;
		$this->load->view('user/edit_user_group', $data);

	}

	public function editing_user_group($user_group_id)
	{
		$name = $this->input->post('user_group_name');
		$module = $this->input->post('permission');
		$group['user_group_name'] = $name;
		$this->UM->update_user_group($group, $user_group_id);
		$this->UM->Delete_permission($user_group_id);
		foreach ($module as $mod) {
			$this->UM->Insert_permission($user_group_id, $mod);
		}
		$this->session->set_flashdata('edit', 'edit');
		redirect("user/edit_user_group/$user_group_id");
	}

	public function profile($user_id)
	{
		$this->user_utility->check_login();
		$this->user_utility->check_permission(14);
		$data['data'] = $this->UM->Get_user($user_id);
		$data['users'] = $data['data'][0];

		$this->load->view('user/profile', $data);
	}

	public function editing_profile($user_id)
	{
		$data = $this->input->post();
		$this->UM->Update_user($data, $user_id);
		$this->session->set_flashdata('edit', 'edit');

		redirect("User/profile/$user_id");
	}
}
