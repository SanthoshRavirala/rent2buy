<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin {
	
	private $admin_id = 0;
	private $lastname;
	private $firstname;
	private $image;
	private $loged = false;
	
	public function __construct()
	{	
		$this->ci = & get_instance();
		$pages = array('login');
		$admin_id = $this->ci->session->userdata("admin_id");
		if(isset($_COOKIE['admin_id']) && empty($admin_id)) {
			$this->ci->session->set_userdata("admin_id", $_COOKIE['admin_id']);	
		}
		if(!empty($admin_id))	{
			$this->generate($this->ci->session->userdata("admin_id"));
		} elseif(!in_array($this->ci->uri->segment(2), $pages)) {
			redirect('admin/login');
		}
	}
	
	public function login($admin)
	{	
		$this->admin_id = $admin['admin_id'];	
		$this->loged = true;	
		$this->ci->session->set_userdata("admin_id",$admin['admin_id']);
        $this->ci->session->set_userdata("token",random_token(25));		
		$this->firstname = $admin['firstname'];			
		$this->lastname = $admin['lastname'];	
		$this->image = $admin['image'];	
	}
	
	public function generate($admin_id)
	{
		$this->ci->load->model('admin/admin_model');
        $admin = $this->ci->admin_model->get_admin($admin_id);	
		if(!$admin){
			$this->session->unset_userdata('admin_id');
			redirect('home');
		}
		$this->admin_id = $admin_id;
		$this->loged = true;			
		$this->firstname = $admin['firstname'];			
		$this->lastname = $admin['lastname'];	
		$this->image = $admin['image'];		
	}
	
	public function get_first_name()
	{
		return $this->firstname;	
	}
	
	public function get_last_name()
	{
		return $this->lastname;		
	}
	
	public function get_image()
	{
		return $this->image;	
	}
	
	public function get_admin_id()
	{
		return $this->admin_id;	
	}
	
	public function get_is_log()
	{
		return $this->loged;	
	}
}