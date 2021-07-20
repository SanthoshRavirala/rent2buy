<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User {
	
	private $user_id = 0;
	private $lastname;
	private $firstname;
	private $image;
	private $loged = false;
	
	public function __construct()
	{	
		$this->ci = & get_instance();
		$user_id = $this->ci->session->userdata("user_id");
		if(isset($_COOKIE['user_id']) && empty($user_id)){
			$this->ci->session->set_userdata("user_id", $_COOKIE['user_id']);	
		}
		if(!empty($user_id))	{
			$this->generate($this->ci->session->userdata("user_id"));
		}
	}
	
	public function login($user)
	{	
		$this->user_id = $user['user_id'];	
		$this->loged = true;	
		$this->ci->session->set_userdata("user_id",$user['user_id']);
        $this->ci->session->set_userdata("token",random_token(25));		
		$this->firstname = $user['firstname'];			
		$this->lastname = $user['lastname'];	
		$this->image = $user['image'];	
	}
	
	public function generate($user_id)
	{
		$this->ci->load->model('user_model');
        $user = $this->ci->user_model->get_user($user_id);	
		if(!$user){
			$this->ci->session->unset_userdata('user_id');
			redirect('home');
		}
		$this->user_id = $user_id;
		$this->loged = true;			
		$this->firstname = $user['firstname'];			
		$this->lastname = $user['lastname'];	
		$this->image = $user['image'];	
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
	
	public function get_user_id()
	{
		return $this->user_id;	
	}
	
	public function get_is_log()
	{
		return $this->loged;	
	}
}