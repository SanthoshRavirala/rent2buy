<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/settings', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('settings');
		$var_header_data['title'] = $this->lang->line('text_title');			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_priority'] = $this->lang->line('text_priority');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link'] = site_url('admin/settings/validate');
		$limit = $this->config->item('c_limit');
		
	    $data['menus'] = array();	    
		$data['option'] = $this->db->get('settings')->result_array();				
	   
		 
		 
		
		 
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('menu'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('menu'), true);
		
		$this->load->view('admin/settings_add', $data);
	}
	
	public function validate($id = 0){
		
		$post = $this->input->post();
		
		$data_settings=$this->db->get('settings')->result_array(); 

		  foreach ($data_settings as $data_setting) {
				 
				$this->db->where('option', $data_setting['option']);
				$this->db->update('settings', array('value'=> $post[$data_setting['option']]));

				}	 
		  
		//$this->db->update('settings', $post, 'option = '.$id); 
		 
		redirect('admin/settings');			
		
	}
	
}