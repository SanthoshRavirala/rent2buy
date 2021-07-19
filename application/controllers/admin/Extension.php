<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Extension extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/extension', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('extension');
		$var_header_data['title'] = $this->lang->line('text_title');			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_path'] = $this->lang->line('text_path');
		$data['text_status'] = $this->lang->line('text_status');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/extension/add');
		$limit = $this->config->item('c_limit');
		
	    $data['extensions'] = array();	    
		$extension_number = $this->db->get('extension')->num_rows();				
	    $extensions = $this->db->get('extension', $limit, $start)->result_array();
		
		foreach($extensions as $extension){
			$data['extensions'][] =  array(
				'extension_id' => $extension['extension_id'],
				'name'        => $extension['name'],
				'path'      => $extension['path'],
				'priority'  => $extension['priority'],
				'status'    => $extension['status'],
				'link'        => site_url('admin/extension/add/'.$extension['extension_id'])	,
				'delete_link' => site_url('admin/extension/delete/'.$extension['extension_id'])	,
			);            
		}
		
		if($extension_number < $start + $limit){
			$to = $extension_number;
		} else {
			$to = $start+ $limit;
		}
				
		if($extension_number){
			$data['text_showing'] = sprintf($this->lang->line('text_showing'),$start + 1, $to, $extension_number);
		} else {
			$data['text_showing'] = $this->lang->line('text_no_results');
		}
		
		$this->load->library('pagination');
		$path = $this->uri->segment(1).'/'. $this->uri->segment(2).'/index';
		$p_config['base_url'] = site_url($path);
		$p_config['total_rows'] = $extension_number;		
	    $p_config = array_merge(get_pagination_settings(), $p_config);
		$this->pagination->initialize($p_config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('extension'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('extension'), true);
		
		$this->load->view('admin/extension', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/extension', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('extension');
		$var_header_data['title'] = $this->lang->line('text_title');
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_name'] = $this->lang->line('text_name');
		$data['text_priority'] = $this->lang->line('text_priority');
		$data['text_path'] = $this->lang->line('text_path');
		$data['text_part'] = $this->lang->line('text_part');
		$data['text_select_part'] = $this->lang->line('text_select_part');
		$data['text_status'] = $this->lang->line('text_status');
		$data['text_all'] = $this->lang->line('text_all');
		$data['text_yes'] = $this->lang->line('text_yes');
		$data['text_no'] = $this->lang->line('text_no');
		$data['parts'] = $this->db->get('part')->result_array();
		if($id){
			$data['text_edit'] = $this->lang->line('text_edit');
			$data['button_edit'] = $this->lang->line('button_edit');
		} else {
			$data['text_edit'] = $this->lang->line('text_add');
			$data['button_edit'] = $this->lang->line('button_add');
		}
		
		$data['button_cancel'] = $this->lang->line('button_cancel');
		
		if($id && !$post){
			$post = $this->db->get_where('extension', array('extension_id' => $id))->row_array();
		}
		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['name']     = '';
			$data['path']     = '';
			$data['priority'] = 0;
			$data['status']   = 1;
			$data['part_id']  = '';
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/extension/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/extension/validate');
		}
		
	    $data['cancel'] = site_url('admin/extension');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('extension'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('extension'), true);
		
		$this->load->view('admin/extension_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/extension_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		if(empty($post['name'])){
		    $error['error_name'] = $this->lang->line('error_name');			
		}
		if(empty($post['path'])){
		    $error['error_path'] = $this->lang->line('error_path');			
		}
		if(empty($post['part_id'])){
		    $error['error_part'] = $this->lang->line('error_part');			
		}
		if($error){
			$this->add($id, $post, $error);
		} else {
			if($id){
				$this->db->update('extension', $post, 'extension_id = '.$id);
			} else {
				$this->db->insert('extension', $post);
			}
			redirect('admin/extension');			
		}
	}
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('extension', 'extension_id = '.$id);
		redirect('admin/extension');
	}
}