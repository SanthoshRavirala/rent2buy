<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/user', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('user');
		$var_header_data['title'] = $this->lang->line('text_title');			   	           
		$data['text_email'] = $this->lang->line('text_email');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/user/add');
		$limit = $this->config->item('c_limit');
		
	    $data['users'] = array();	    
		$user_number = $this->db->get('user')->num_rows();				
	    $users = $this->db->get('user', $limit, $start)->result_array();
		
		foreach($users as $user){
			$data['users'][] =  array(
				'user_id' => $user['user_id'],
				'email'        => $user['email'],
				'link'        => site_url('admin/user/add/'.$user['user_id'])	,
				'delete_link' => site_url('admin/user/delete/'.$user['user_id'])	,
			);            
		}
		
		if($user_number < $start + $limit){
			$to = $user_number;
		} else {
			$to = $start+ $limit;
		}
				
		if($user_number){
			$data['text_showing'] = sprintf($this->lang->line('text_showing'),$start + 1, $to, $user_number);
		} else {
			$data['text_showing'] = $this->lang->line('text_no_results');
		}
		
		$this->load->library('pagination');
		$path = $this->uri->segment(1).'/'. $this->uri->segment(2).'/index';
		$p_config['base_url'] = site_url($path);
		$p_config['total_rows'] = $user_number;		
	    $p_config = array_merge(get_pagination_settings(), $p_config);
		$this->pagination->initialize($p_config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('user'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('user'), true);
		
		$this->load->view('admin/user', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/user', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('user');
		$var_header_data['title'] = $this->lang->line('text_title');
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_firstname'] = $this->lang->line('text_firstname');	    
		$data['text_lastname'] = $this->lang->line('text_lastname');		
		$data['text_email'] = $this->lang->line('text_email');			
		$data['text_password'] = $this->lang->line('text_password');		
		$data['text_region'] = $this->lang->line('text_region');		
		$data['text_select_region'] = $this->lang->line('text_select_region');	
		$data['text_nation'] = $this->lang->line('text_nation');		
		$data['text_select_nation'] = $this->lang->line('text_select_nation');	
		$data['text_user_group'] = $this->lang->line('text_user_group');		
		$data['text_gender'] = $this->lang->line('text_gender');		
		$data['text_date_birth'] = $this->lang->line('text_date_birth');	
		$data['text_male'] = $this->lang->line('text_male');		    
		$data['text_female'] = $this->lang->line('text_female');	
		//$data['text_all'] = $this->lang->line('text_all');
		$data['regions']  = $this->db->get('region')->result_array();
        $data['nations']  = $this->db->get('nation')->result_array();
        $data['user_groups']  = $this->db->get('user_group')->result_array();
		if($id){
			$data['text_edit'] = $this->lang->line('text_edit');
			$data['button_edit'] = $this->lang->line('button_edit');
		} else {
			$data['text_edit'] = $this->lang->line('text_add');
			$data['button_edit'] = $this->lang->line('button_add');
		}
		
		$data['button_cancel'] = $this->lang->line('button_cancel');
		
		if($id && !$post){
			$post = $this->db->get_where('user', array('user_id' => $id))->row_array();
		}
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
			$data['user_group_id']  = $this->config->item('c_default_group');
			$data['password']  = '';
			$data['email']  = '';
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/user/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/user/validate');
		}
		
	    $data['cancel'] = site_url('admin/user');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('user'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('user'), true);
		
		$this->load->view('admin/user_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/user_error', $this->language->get_name());
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
		
		if(!$id){
			$this->load->model('user_model');
            $user_exists = $this->user_model->check_user_by_email($post['email']);	
			if($user_exists){
				$error['error_exists'] = $this->lang->line('error_exists');
			}
		}
		if($error){
			$this->add($id, $post, $error);
		} else {
			$post['password'] = md5($post['password']);
			if($id){
				$this->db->update('user', $post, 'user_id = '.$id);
			} else {
				$this->db->insert('user', $post);
			}
			redirect('admin/user');			
		}
	}
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('user', 'user_id = '.$id);
		redirect('admin/user');
	}
}