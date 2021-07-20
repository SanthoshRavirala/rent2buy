<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	public function index($id = 0)
	{
		$this->lang->load('category', $this->language->get_name());
		$this->load->library('layout');
		
		$fixed_header_data = $this->layout->get_header_data('category');
		$data['text_vote'] = $this->lang->line('text_vote');		
		$data['text_view_results'] = $this->lang->line('text_view_results');	
		$data['text_first'] = $this->lang->line('text_first');
		$data['text_description'] = $this->lang->line('text_description');
		$data['category'] = $this->db->get_where('category', array('category_id' => $id))->row_array();
		if(!$data['category']){
			$data['message'] = 'Category doesn\'t exists';
			$data['heading'] = 'Category doesn\'t exists';
			$var_header_data['title'] = $data['heading'];
		    $var_header_data['meta_description'] = $this->config->item('c_description');
			$data['header'] = $this->load->view('frontend/header', array_merge($fixed_header_data, $var_header_data), true);
			$this->load->view('errors/html/error_404', $data);
			return;
		}

		$var_header_data['title'] = $data['category']['name'];
		$var_header_data['meta_description'] = $this->config->item('c_description');

		$data['header'] = $this->load->view('frontend/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('frontend/footer', $this->layout->get_footer_data('category'), true);
		$data['content_top'] = $this->load->view('frontend/content_top', $this->layout->get_top_data('category'), true);
		$data['content_left'] = $this->load->view('frontend/content_left', $this->layout->get_left_data('category'), true);
		$this->load->view('frontend/category', $data);
	}
}

