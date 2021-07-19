<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lang extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/language', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('language');
		$var_header_data['title'] = $this->lang->line('text_title');			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_code'] = $this->lang->line('text_code');	           
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/lang/add');
		$limit = $this->config->item('c_limit');
		
	    $data['languages'] = array();	    
		$language_number = $this->db->get('language')->num_rows();				
	    $languages = $this->db->get('language', $limit, $start)->result_array();
		
		foreach($languages as $language){
			$data['languages'][] =  array(
				'language_id' => $language['language_id'],
				'name'        => $language['name'],
				'code'        => $language['code'],
				'link'        => site_url('admin/lang/add/'.$language['language_id'])	,
				'delete_link' => site_url('admin/lang/delete/'.$language['language_id'])	,
			);            
		}
		
		if($language_number < $start + $limit){
			$to = $language_number;
		} else {
			$to = $start+ $limit;
		}
				
		if($language_number){
			$data['text_showing'] = sprintf($this->lang->line('text_showing'),$start + 1, $to, $language_number);
		} else {
			$data['text_showing'] = $this->lang->line('text_no_results');
		}
		
		$this->load->library('pagination');
		$path = $this->uri->segment(1).'/'. $this->uri->segment(2).'/index';
		$p_config['base_url'] = site_url($path);
		$p_config['total_rows'] = $language_number;		
	    $p_config = array_merge(get_pagination_settings(), $p_config);
		$this->pagination->initialize($p_config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('language'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('language'), true);
		
		$this->load->view('admin/language', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/language', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('language');
		$var_header_data['title'] = $this->lang->line('text_title');
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_name'] = $this->lang->line('text_name');
		$data['text_code'] = $this->lang->line('text_code');
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
			$post = $this->db->get_where('language', array('language_id' => $id))->row_array();
		}
		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['name']  = '';
			$data['code']  = '';
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/lang/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/lang/validate');
		}
		
	    $data['cancel'] = site_url('admin/lang');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('language'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('language'), true);
		
		$this->load->view('admin/language_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/language_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		if(empty($post['name'])){
		    $error['error_name'] = $this->lang->line('error_name');			
		}
		if(empty($post['code'])){
		    $error['error_code'] = $this->lang->line('error_code');			
		}
		if($error){
			$this->add($id, $post, $error);
		} else {
			if($id){
				$this->db->update('language', $post, 'language_id = '.$id);
			} else {
				$this->db->insert('language', $post);
			}
			redirect('admin/lang');			
		}
	}
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('language', 'language_id = '.$id);
		redirect('admin/lang');
	}
	
	public function change ($name = 'english')
	{	
		$this->language->change($name);
		redirect('admin/home');
	}
}