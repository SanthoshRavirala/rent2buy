<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nation extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/nation', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('nation');
		$var_header_data['title'] = $this->lang->line('text_title');			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_priority'] = $this->lang->line('text_priority');	       
		$data['text_type'] = $this->lang->line('text_type');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/nation/add');
		$limit = $this->config->item('c_limit');
		
	    $data['nations'] = array();	    
		$nation_number = $this->db->get('nation')->num_rows();				
	    $nations = $this->db->get('nation', $limit, $start)->result_array();
		
		foreach($nations as $nation){
			$data['nations'][] =  array(
				'nation_id'   => $nation['nation_id'],
				'name'        => $nation['name'],
				'priority'    => $nation['priority'],
				'type'        => $nation['type'],
				'link'        => site_url('admin/nation/add/'.$nation['nation_id'])	,
				'delete_link' => site_url('admin/nation/delete/'.$nation['nation_id'])	,
			);            
		}
		
		if($nation_number < $start + $limit){
			$to = $nation_number;
		} else {
			$to = $start+ $limit;
		}
				
		if($nation_number){
			$data['text_showing'] = sprintf($this->lang->line('text_showing'),$start + 1, $to, $nation_number);
		} else {
			$data['text_showing'] = $this->lang->line('text_no_results');
		}
		
		$this->load->library('pagination');
		$path = $this->uri->segment(1).'/'. $this->uri->segment(2).'/index';
		$p_config['base_url'] = site_url($path);
		$p_config['total_rows'] = $nation_number;		
	    $p_config = array_merge(get_pagination_settings(), $p_config);
		$this->pagination->initialize($p_config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('nation'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('nation'), true);
		
		$this->load->view('admin/nation', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/nation', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('nation');
		$var_header_data['title'] = $this->lang->line('text_title');
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_name'] = $this->lang->line('text_name');
		$data['text_priority'] = $this->lang->line('text_priority');
		$data['text_type'] = $this->lang->line('text_type');
		$data['text_select_type'] = $this->lang->line('text_select_type');
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
			$post = $this->db->get_where('nation', array('nation_id' => $id))->row_array();
		}
		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['name']  = '';
			$data['priority']  = 0;
			$data['type']  = '';
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/nation/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/nation/validate');
		}
		
	    $data['cancel'] = site_url('admin/nation');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('nation'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('nation'), true);
		
		$this->load->view('admin/nation_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/nation_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		if(empty($post['name'])){
		    $error['error_name'] = $this->lang->line('error_name');			
		}
		if($post['type'] == '0'){
		    $error['error_type'] = $this->lang->line('error_type');			
		}
		if($error){
			$this->add($id, $post, $error);
		} else {
			if($id){
				$this->db->update('nation', $post, 'nation_id = '.$id);
			} else {
				$this->db->insert('nation', $post);
			}
			redirect('admin/nation');			
		}
	}
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('nation', 'nation_id = '.$id);
		redirect('admin/nation');
	}
}