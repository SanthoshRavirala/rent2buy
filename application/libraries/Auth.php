<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
	
	public function __construct()
	{	
		$this->ci = & get_instance();
		if($this->ci->uri->segment(1) === 'admin'){
			$this->ci->load->library('admin/admin');
		} else {
			$this->ci->load->library('user');
		}
	}
}