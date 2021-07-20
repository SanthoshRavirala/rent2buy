<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Header Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		dalibor
 */
class Layout {

	private $ci;

	public function __construct()
	{
		$this->ci = & get_instance();
	}
	
	public function get_header_data($page, $id=0)
	{
		$this->ci->lang->load('admin/header', $this->ci->language->get_name());
		$this->ci->load->config('admin');
		$data['languages']   = $this->ci->db->get('language')->result_array();
		
		$data['text_logout']   = $this->ci->lang->line('text_logout');
		$data['text_home']   = $this->ci->lang->line('text_home');
		//$data['meta_author'] = $this->ci->config->item('c_author');
		//$data['tag']         = $this->ci->config->item('c_author');
		//$data['logo_text']   = $this->ci->config->item('c_sitename');
		$data['short_logo'] = $this->ci->config->item('admin_short_name');
		$data['logo'] = $this->ci->config->item('admin_name');

		$data['logout']   = site_url('admin/logout');
		$this->ci->load->library('admin');
		if($this->ci->admin->get_is_log()){
			//$data['admin_name'] = $this->ci->admin->get_first_name() ." ". $this->ci->admin->get_last_name();
			$data['firstname']	= $this->ci->admin->get_first_name();
			$data['lastname']	=  $this->ci->admin->get_last_name();
			$data['image']	    = $this->ci->admin->get_image();
		} else {
			redirect('admin/login');
		}
		return $data;		
	}
	
	
	public function get_left_data($page, $id=0)
	{
		$this->ci->lang->load('admin/sidebar', $this->ci->language->get_name());
		$data['text_dashboard'] = $this->ci->lang->line('text_dashboard');  
		$data['text_navigation'] = $this->ci->lang->line('text_navigation'); 
		$data['text_poll'] = $this->ci->lang->line('text_poll');       
		$data['text_category'] = $this->ci->lang->line('text_category');   
		$data['text_user'] = $this->ci->lang->line('text_user');       
		$data['text_user_group'] = $this->ci->lang->line('text_user_group');       
		$data['text_region'] = $this->ci->lang->line('text_region');     
		$data['text_nation'] = $this->ci->lang->line('text_nation');     
		$data['text_language'] = $this->ci->lang->line('text_language');   
		$data['text_part'] = $this->ci->lang->line('text_part');       
		$data['text_extension'] = $this->ci->lang->line('text_extension');
        // get menu links
     	$data['dashboard'] = site_url('admin/home');		
        $data['poll'] = site_url('admin/poll');		
        $data['category'] = site_url('admin/category');		
        $data['user'] = site_url('admin/user');		
        $data['user_group'] = site_url('admin/user_group');		
        $data['region'] = site_url('admin/region');		
        $data['nation'] = site_url('admin/nation');		
        $data['language'] = site_url('admin/lang');
		$data['extension'] = site_url('admin/extension');		
		$data['part'] = site_url('admin/part');
		//get admin info 
		$data['firstname']	= $this->ci->admin->get_first_name();
		$data['lastname']	=  $this->ci->admin->get_last_name();
		$data['profile_image']	    = $this->ci->admin->get_image();
		
		return $data;
	}
	
	public function get_footer_data($page, $id=0)
	{
		$this->ci->lang->load('admin/modal', $this->ci->language->get_name());
		$modal_data['text_title'] = $this->ci->lang->line('text_title'); 	   
		$modal_data['text_close'] = $this->ci->lang->line('text_close'); 	   
		$modal_data['text_delete'] = $this->ci->lang->line('text_delete'); 	   
		$modal_data['text_body'] = $this->ci->lang->line('text_body');
		
		$data['modal'] =  $this->ci->load->view('admin/modal', $modal_data, true);
		return $data;
		
		
	}

}
