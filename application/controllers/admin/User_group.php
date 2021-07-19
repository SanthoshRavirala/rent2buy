<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_group extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/user_group', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('user_group');
		$var_header_data['title'] = $this->lang->line('text_title');			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_priority'] = $this->lang->line('text_priority');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/user_group/add');
		$limit = $this->config->item('c_limit');
		
	    $data['user_groups'] = array();	    
		$user_group_number = $this->db->get('user_group')->num_rows();				
	    $user_groups = $this->db->get('user_group', $limit, $start)->result_array();
		
		foreach($user_groups as $user_group){
			$data['user_groups'][] =  array(
				'user_group_id' => $user_group['user_group_id'],
				'name'        => $user_group['name'],
				'link'        => site_url('admin/user_group/add/'.$user_group['user_group_id'])	,
				'delete_link' => site_url('admin/user_group/delete/'.$user_group['user_group_id'])	,
			);            
		}
		
		if($user_group_number < $start + $limit){
			$to = $user_group_number;
		} else {
			$to = $start+ $limit;
		}
				
		if($user_group_number){
			$data['text_showing'] = sprintf($this->lang->line('text_showing'),$start + 1, $to, $user_group_number);
		} else {
			$data['text_showing'] = $this->lang->line('text_no_results');
		}
		
		$this->load->library('pagination');
		$path = $this->uri->segment(1).'/'. $this->uri->segment(2).'/index';
		$p_config['base_url'] = site_url($path);
		$p_config['total_rows'] = $user_group_number;		
	    $p_config = array_merge(get_pagination_settings(), $p_config);
		$this->pagination->initialize($p_config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('user_group'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('user_group'), true);
		
		$this->load->view('admin/user_group', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/user_group', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('user_group');
		$var_header_data['title'] = $this->lang->line('text_title');
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_name'] = $this->lang->line('text_name');
		$data['text_priority'] = $this->lang->line('text_priority');
		$data['text_all'] = $this->lang->line('text_all');
		
		if($id){
			$data['text_edit'] = $this->lang->line('text_edit');
			$data['button_edit'] = $this->lang->line('button_edit');
		} else {
			$data['text_edit'] = $this->lang->line('text_add');
			$data['button_edit'] = $this->lang->line('button_add');
		}
		
		$data['button_cancel'] = $this->lang->line('button_cancel');
		
		if($id && !$post){
			$post = $this->db->get_where('user_group', array('user_group_id' => $id))->row_array();
		}
		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['name']  = '';
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/user_group/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/user_group/validate');
		}
		
	    $data['cancel'] = site_url('admin/user_group');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('user_group'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('user_group'), true);
		
		$this->load->view('admin/user_group_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/user_group_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		if(empty($post['name'])){
		    $error['error_name'] = $this->lang->line('error_name');			
		}
		if($error){
			$this->add($id, $post, $error);
		} else {
			if($id){
				$this->db->update('user_group', $post, 'user_group_id = '.$id);
			} else {
				$this->db->insert('user_group', $post);
			}
			redirect('admin/user_group');			
		}
	}
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('user_group', 'user_group_id = '.$id);
		redirect('admin/user_group');
	}
}