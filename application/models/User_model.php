<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function Get_user_permissions($user_id)
	{
		return $this->db->select('module.*')
			->from('employee')
			->join('user_group', 'employee.user_group_id = user_group.user_group_id')
			->join('permission', 'user_group.user_group_id = permission.user_group_id')
			->join('module', 'permission.module_id = module.module_id')
			->where('employee.employee_id', $user_id)
			->get()
			->result_array();
	}

	public function check_login($employee_email, $employee_password)
	{
		return $this->db->where('employee_email', $employee_email)
			->where('employee_password', $employee_password)
			->where('account_active', '1')
			->get('employee')
			->result_array();
	}

	public function Get_all_users()
	{
		return $this->db->select('*')
			->from('employee')
			->order_by("employee_id", "desc")
			->get()
			->result_array();
	}

	public function Get_department_users($department_id)
	{
		return $this->db->select('*')
			->from('employee')
			->where('department_id', $department_id)
			->order_by("employee_id", "desc")
			->get()
			->result_array();
	}

	public function Insert_user($data)
	{
		$this->db->insert('employee', $data);
	}

	public function Get_user($user_id)
	{
		return $this->db->where('employee_id', $user_id)
			->get('employee')
			->result_array();
	}

	public function Update_user($data, $user_id)
	{
		$this->db->where('employee_id', $user_id)
			->update('employee', $data);
	}


	public function Get_all_usergroups()
	{
		return $this->db->select('*')
			->from('user_group')
			->get()
			->result_array();
	}

	public function Get_all_permissions()
	{
		return $this->db->select('*')
			->from('permission')
			->join('module', 'permission.module_id = module.module_id')
			->get()
			->result_array();
	}

	public function Get_all_modules()
	{
		return $this->db->select('*')
			->from('module')
			->get()
			->result_array();
	}

	public function Insert_user_group($group)
	{
		$this->db->insert('user_group', $group);
		return $this->db->insert_id();
	}

	public function Insert_permission($user_group_id, $mod)
	{
		$data['user_group_id'] = $user_group_id;
		$data['module_id'] = $mod;
		$this->db->insert('permission', $data);
	}

	public function delete_user_group($user_group_id)
	{
		$this->db->where('user_group_id', $user_group_id)
			->delete('user_group');
		$this->db->where('user_group_id', $user_group_id)
			->delete('permission');
	}

	public function Get_usergroup($user_group_id)
	{
		return $this->db->where('user_group_id', $user_group_id)
			->get('user_group')
			->result_array();
	}

	public function Get_permission($user_group_id)
	{
		return $this->db->where('user_group_id', $user_group_id)
			->get('permission')
			->result_array();
	}

	public function Delete_permission($user_group_id)
	{
		$this->db->where('user_group_id', $user_group_id)
			->delete('permission');
	}

	public function update_user_group($group, $user_group_id)
	{
		$this->db->where('user_group_id', $user_group_id)
			->update('user_group', $group);
	}

	public function Delete_user($user_id)
	{
		$this->db->where('employee_id', $user_id)
			->delete('employee');
	}

	public function Get_all_main_modules()
	{
		return $this->db->get('main_module')->result_array();
	}

	public function Get_all_users_office()
	{
		return $this->db->select('*')
			->from('employee')
			->where('employee_company_type', '1')
			->order_by("employee_id", "desc")
			->get()
			->result_array();
	}


}
