<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{ 	
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('token');
		setcookie ("user_id", "", time() - 3600, "/");
		redirect('home');
	}
}