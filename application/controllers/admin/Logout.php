<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{ 	
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('token');
		setcookie ("admin_id", "", time() - 3600, "/");
		redirect('admin/home');
	}
}