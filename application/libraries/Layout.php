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
		$this->ci->load->model('extension_model');
	}
	
	public function get_header_data($page = '', $id=0)
	{
		$this->ci->lang->load('header', $this->ci->language->get_name());
		$data['languages']   = $this->ci->db->get('language')->result_array();
		$data['_extensions'] = $this->get_extensions($page, 'head');
		
		$data['text_register'] = $this->ci->lang->line('text_register');
		$data['text_login']  = $this->ci->lang->line('text_login');
		$data['text_logout'] = $this->ci->lang->line('text_logout');
		$data['text_home']   = $this->ci->lang->line('text_home');
		$data['meta_author'] = $this->ci->config->item('c_author');
		$data['tag']         = $this->ci->config->item('c_tag');
		$data['logo_text']   = $this->ci->config->item('c_sitename');
		$data['fb_enabled']  = $this->ci->config->item('c_fb_enabled');
				
		$data['fb_api']     = $this->ci->config->item('fb_api') ? '&appId='. $this->ci->config->item('fb_api') : '';
		$data['ga_code']    = $this->ci->config->item('c_ga_code');
		//$data['return_url'] = (empty($_GET['path'])?'home':$_GET['path']);
		$data['home_link'] = site_url('home');
		$data['register_link'] = site_url('register');
		$data['login_link']    = site_url('login');
		$data['logout_link']   = site_url('logout');
		$data['user_name'] = '';
		if($this->ci->user->get_is_log()){
			$data['user_name'] = $this->ci->user->get_first_name() ." ". $this->ci->user->get_last_name();
		}
		return $data;		
	}
	
	public function get_footer_data($page, $id=0)
	{
		$data['_extensions']   = $this->get_extensions($page, 'footer');
		return $data;
	}
	
	public function get_top_data($page, $id=0)
	{
		$data['_extensions']   = $this->get_extensions($page, 'top');
		return $data;
	}
	
	public function get_left_data($page, $id=0)
	{
		$data['_extensions']  = $this->get_extensions($page, 'left');
		return $data;
	}
	
	public function get_extensions($page, $part)
	{ 	
		$extensions   = $this->ci->extension_model->get_extensions($page, $part);
		$data[$part] = array();
		foreach($extensions as $extension){
			$this->ci->load->library('modules/'.$extension['name']);
			
			$data[$part][]	= $this->ci->load->view('modules/'.$extension['name'], $this->ci->$extension['name']->index(), true);
		}
		return $data;
	}
}
