<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index($post = array(), $error = array())
	{
		$this->lang->load('register', $this->language->get_name());
		$this->load->library('layout');
		$fixed_header_data = $this->layout->get_header_data('register');
		
		$var_header_data['title'] = $var_header_data['text_title'] = $this->lang->line('text_title');		
		$var_header_data['meta_description'] = $this->config->item('c_description');
		
		$data['text_login'] = $this->lang->line('text_login');			
		$data['text_form'] = $this->lang->line('text_form');			
		$data['text_firstname'] = $this->lang->line('text_firstname');	    
		$data['text_lastname'] = $this->lang->line('text_lastname');		
		$data['text_email'] = $this->lang->line('text_email');			
		$data['text_password'] = $this->lang->line('text_password');		
		$data['text_region'] = $this->lang->line('text_region');		
		$data['text_select_region'] = $this->lang->line('text_select_region');	
		$data['text_nation'] = $this->lang->line('text_nation');		
		$data['text_select_nation'] = $this->lang->line('text_select_nation');	
		$data['text_gender'] = $this->lang->line('text_gender');		
		$data['text_date_birth'] = $this->lang->line('text_date_birth');	
		$data['text_male'] = $this->lang->line('text_male');		    
		$data['text_female'] = $this->lang->line('text_female');		
		$data['text_register'] = $this->lang->line('text_register');		
		$data['text_sign_in'] = $this->lang->line('text_sign_in');		
		$data['text_remember'] = $this->lang->line('text_remember');
        if($post){
			if(!isset($post['gender'])){
				$post['gender'] = 0;
			}
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}						
		} else {
			$data['firstname']  = '';
			$data['lastname']  = '';
			$data['gender']  = 0;
			$data['date_birth']  = '';
			$data['region_id']  = 0;
			$data['nation_id']  = 0;
			$data['password']  = '';
			$data['email']  = '';
		}
		$data['error'] =  $error;
		
        $data['link']  = site_url('register/validate');
		$this->load->model('user_model');
        $data['regions']  = $this->user_model->get_regions();
        $data['nations']  = $this->user_model->get_nations();		
		$data['header'] = $this->load->view('frontend/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('frontend/footer', $this->layout->get_footer_data('register'), true);
		$this->load->view('frontend/register_form', $data);
	}
	
	public function validate()
	{
        $this->lang->load('register_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		if($post['firstname'] == ''){
		    $error['error_firstname'] = $this->lang->line('error_firstname');			
		}		
		if($post['lastname'] == ''){
		    $error['error_lastname'] = $this->lang->line('error_lastname');			
		}
		if($post['email'] == ''){
		    $error['error_email'] = $this->lang->line('error_email');			
		}
		if($post['date_birth'] == ''){
		    $error['error_date_birth'] = $this->lang->line('error_date_birth');			
		}
		if($post['password'] == ''){
		    $error['error_password'] = $this->lang->line('error_password');			
		}
		if(!$post['region_id']){
		    $error['error_region'] = $this->lang->line('error_region');			
		}
		if(!$post['nation_id']){
		    $error['error_nation'] = $this->lang->line('error_nation');			
		}
		if(!isset($post['gender'])){
		    $error['error_gender'] = $this->lang->line('error_gender');			
		}
		$this->load->model('user_model');
        $user_exists = $this->user_model->check_user_by_email($post['email']);	
		if($user_exists){
			$error['error_exists'] = $this->lang->line('error_exists');
		}

		if($error){
			$this->index($post, $error);
		} else {
			$post['email'] = htmlspecialchars($post['email'], ENT_QUOTES, 'UTF-8');
			$post['firstname'] = htmlspecialchars($post['firstname'], ENT_QUOTES, 'UTF-8');
			$post['lastname'] = htmlspecialchars($post['lastname'], ENT_QUOTES, 'UTF-8');
			$post['password'] = md5($post['password']);
			$post['date_added'] = gmdate('Y-m-d');
			$post['user_group_id']  = $this->config->item('c_default_group');
			$user_id = $this->user_model->insert($post);
			$this->session->set_userdata("user_id", $user_id);
			redirect('home');
		}		
	}
}