<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/category', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('category');
		$var_header_data['title'] = 'Brands';			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_priority'] = $this->lang->line('text_priority');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/category/add');
		$limit = $this->config->item('c_limit');
		
	    $data['categories'] = array();	    
		$category_number = $this->db->get('category')->num_rows();				
	    $categories = $this->db->get('category', $limit, $start)->result_array();
		
		foreach($categories as $category){
			$data['categories'][] =  array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'link'        => site_url('admin/category/add/'.$category['category_id'])	,
				'delete_link' => site_url('admin/category/delete/'.$category['category_id'])	,
			);            
		}
		
		if($category_number < $start + $limit){
			$to = $category_number;
		} else {
			$to = $start+ $limit;
		}
				
		if($category_number){
			$data['text_showing'] = sprintf($this->lang->line('text_showing'),$start + 1, $to, $category_number);
		} else {
			$data['text_showing'] = $this->lang->line('text_no_results');
		}
		
		$this->load->library('pagination');
		$path = $this->uri->segment(1).'/'. $this->uri->segment(2).'/index';
		$p_config['base_url'] = site_url($path);
		$p_config['total_rows'] = $category_number;		
	    $p_config = array_merge(get_pagination_settings(), $p_config);
		$this->pagination->initialize($p_config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('category'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('category'), true);
		
		$this->load->view('admin/category', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/category', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('category');
		$var_header_data['title'] = 'Brands';
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
			$post = $this->db->get_where('category', array('category_id' => $id))->row_array();
		}
		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['name']  = '';
			$data['image']  = '';
			$data['priority']  = 0;
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/category/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/category/validate');
		}
		
	    $data['cancel'] = site_url('admin/category');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('category'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('category'), true);
		
		$this->load->view('admin/category_add', $data);
	}
	
	public function validate($id = 0){
		$this->lang->load('admin/category_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		
		$image = $this->input->post('image');
		$image2 = $this->input->post('image2');
					if(isset($_FILES["image"]) && !empty($_FILES["image"]))
					{
						$uploads_dir = 'uploads/brand';
					 	
				 		$tmp_name = $_FILES["image"]["tmp_name"];
				        $name = $_FILES["image"]["name"];
				        $name = rand().$name;
				        move_uploaded_file($tmp_name, "$uploads_dir/$name");
				        $replacements = array('image' => $uploads_dir.'/'.$name);
				        $post = array_replace($post, $replacements);
				        unset($post['image2']);
				    }
				    if(empty($tmp_name)) 
				    {
				    	$image2 = $this->input->post('image2');
				    	$replacements = array('image' => $image2);
				        $post = array_replace($post, $replacements);
				        unset($post['image2']);
				         
				    }
		if(empty($post['name'])){
		    $error['error_name'] = $this->lang->line('error_name');			
		}
		if($error){
			$this->add($id, $post, $error);
		} else {
			if($id){
				$this->db->update('category', $post, 'category_id = '.$id);
			} else {
				$this->db->insert('category', $post);
			}
			redirect('admin/category');			
		}
	}
	public function delete($id = 0, $token)
	{
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('category', 'category_id = '.$id);
		redirect('admin/category');
	}
}