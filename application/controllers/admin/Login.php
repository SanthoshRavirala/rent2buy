<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index($post = array(), $error = array())
	{
		$this->lang->load('register', $this->language->get_name());
		$this->load->config('admin');
		$data['title'] =  $this->lang->line('text_login');		
		$data['meta_description'] = $this->config->item('c_description');
		
		$data['text_login'] = $this->lang->line('text_login');			
		$data['text_form'] = $this->lang->line('text_form');			
		
		$data['text_email'] = $this->lang->line('text_email');			
		$data['text_password'] = $this->lang->line('text_password');		
		
		$data['text_sign_in'] = $this->lang->line('text_sign_in');		
		$data['text_remember'] = $this->lang->line('text_remember');

		$data['logo'] = $this->config->item('admin_name');
		$data['text_admin'] = $this->config->item('text_admin');

		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['password']  = '';
			$data['email']  = '';
		}
		if($error){
		   $this->lang->load('register_error', $this->language->get_name());
		   $data['error'] =  array(
		       'text_alert' => $this->lang->line('text_alert'),
		       'global_error' => $this->lang->line('global_error')
		   );
		} else {
		   $data['error'] = array();
		}
        $data['link']  = site_url('admin/login/validate');
		$this->load->view('admin/login_form',$data);
	}
	
	public function validate()
	{
		$post = $this->input->post();
		
		$this->load->model('admin/admin_model');
		$this->load->library('admin/admin');
        $admin = $this->admin_model->get_admin_by_email($post);	
	
		if($admin){
			$this->admin->login($admin);
			if(isset($post['remember'])){
				setcookie('admin_id', $admin['admin_id'], time() + (86400 * 30), "/");
			}
			redirect('admin/home');
		} else {
			$error = array('error'=>true);
			$this->index($post, $error);
		}
	}
}