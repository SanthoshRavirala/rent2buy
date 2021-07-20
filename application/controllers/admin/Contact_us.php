<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/user', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('user');
		$var_header_data['title'] = 'Contact us';			   	           
		$data['text_email'] = $this->lang->line('text_email');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/rent_a_car/add');
		$limit = $this->config->item('c_limit');
		
	    $data['users'] = array();	    
		               
		$user_number = $this->db->get('contact_us')->num_rows();	
		              
	    $users = $this->db->get('contact_us', $limit, $start)->result_array();
		
		foreach($users as $user){
			$data['users'][] =  array(
				'id'   => $user['id'],
				'name'   => $user['name'],
				'email'   => $user['email'],
				'subject'   => $user['subject'],
				'form_type'   => $user['form_type'],
				'message'   => $user['message'],
				'published'   => $user['published'],
			    'delete_link' => site_url('admin/contact_us/delete/'.$user['id'])  ,
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
		
		$this->load->view('admin/contact_us', $data);
	}
	
	
	
	
	

	
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->where('id',$id);
		$this->db->delete('contact_us');
		redirect('admin/contact_us');
	}
}