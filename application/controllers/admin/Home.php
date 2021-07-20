<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->lang->load('admin/home', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());
		$this->load->library('admin/layout');
		$fixed_header_data = $this->layout->get_header_data('home');
		$var_header_data['title'] = $this->lang->line('text_title');
		$data['text_dashboard'] = $this->lang->line('text_dashboard');   
		$data['text_title'] = $this->lang->line('text_title'); 	  
		$data['text_users'] = $this->lang->line('text_users'); 	  
		$data['text_languages'] = $this->lang->line('text_languages');       
		$data['text_nations'] = $this->lang->line('text_nations');       
		$data['text_regions'] = $this->lang->line('text_regions'); 	  

		$data['text_more'] = $this->lang->line('text_more');
		$data['total_users'] = $this->db->get('user')->num_rows();
		$data['total_nations'] = $this->db->get('nation')->num_rows();
		$data['total_languages'] = $this->db->get('language')->num_rows();
		$data['total_regions'] = $this->db->get('region')->num_rows();
		$data['category'] = site_url('admin/category');		
        $data['user'] = site_url('admin/user');		      
        $data['poll'] = site_url('admin/poll');		
        $data['region'] = site_url('admin/region');		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('home'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('home'), true);
		$this->load->view('admin/home', $data);
	}
}

