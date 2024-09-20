<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Utility
{
	protected $CI;

	public function __construct()
	{

	}

	public function check_login()
	{
		if (!isset($_SESSION['id'])) {
			redirect('User/login');
		}
	}

	public function check_permission($module)
	{
		if (isset($_SESSION['module_id']) && $_SESSION['module_id'] != '' && !empty($_SESSION['module_id'])) {
			if (in_array($module, $_SESSION['module_id'])) {
			} else {
				redirect('User/permission_denied');
			}

		} else {
			return $check = 3; // not logged in
		}
	}
}
