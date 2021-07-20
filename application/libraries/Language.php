<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language {
	
	private $name;
	
	public function __construct()
	{	
		$this->ci = & get_instance();
		$lang = $this->ci->session->userdata("lang");
		if(isset($_COOKIE['lang']) && empty($lang)){
			$this->ci->session->set_userdata("lang", $_COOKIE['lang']);					
		}
		if(!empty($lang)){
			$this->name = $this->ci->session->userdata("lang");
		} else {
			$this->name = 'english';
		}
	}
	
	public function get_name()
	{	
		return $this->name;
	}
	
	public function change($name)
	{	
		$this->name = $name;
		$this->ci->session->set_userdata("lang", $name);
	}	
}