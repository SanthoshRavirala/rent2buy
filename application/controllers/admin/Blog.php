<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/nation', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('nation');
		$var_header_data['title'] = 'blog Listing';			   
		$data['text_name'] = $this->lang->line('text_name');	           
		$data['text_priority'] = $this->lang->line('text_priority');	       
		$data['text_type'] = $this->lang->line('text_type');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/blog/add');
		$limit = $this->config->item('c_limit');
		
	    $data['nations'] = array();	    
		$nation_number = $this->db->get('blog')->num_rows();				
	    $nations = $this->db->get('blog', $limit, $start)->result_array();
		
		foreach($nations as $nation){
			$data['nations'][] =  array(
				'id'   => $nation['id'],
				'name'        => $nation['name'],
				'linkpage'		=> base_url().$nation['link'],
				'link'        => site_url('admin/blog/add/'.$nation['id'])	,
				'delete_link' => site_url('admin/blog/delete/'.$nation['id'])	,
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
		$data['notice_success'] = '<div class="callout callout-success">Page Added / Updated!</div>';	
		$data['notice_deleted'] = '<div class="callout callout-danger">Page Deleted!</div>';	
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('nation'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('nation'), true);
		
		$this->load->view('admin/blog', $data);
	}
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/nation', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('nation');
		$var_header_data['title'] = 'blog Listing';
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_name'] = $this->lang->line('text_name');
		$data['text_priority'] = $this->lang->line('text_priority');
		$data['text_type'] = $this->lang->line('text_type');
		$data['text_select_type'] = $this->lang->line('text_select_type');
		$data['text_all'] = $this->lang->line('text_all');
		//$data['event_categories'] = $this->db->get('news_category')->result_array();
		if($id){
			$data['text_edit'] = 'Update';
			$data['button_edit'] = 'Update';
		} else {
			$data['text_edit'] = $this->lang->line('text_add');
			$data['button_edit'] = $this->lang->line('button_add');
		}
		
		$data['button_cancel'] = $this->lang->line('button_cancel');
		
		if($id && !$post){
			$post = $this->db->get_where('blog', array('id' => $id))->row_array();
		}
		if($post){
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['name']  = '';
			$data['description'] = '';
			$data['image'] = '';
				
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/blog/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/blog/validate');
		}
		
	    $data['cancel'] = site_url('admin/blog');
		
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('nation'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('nation'), true);
		
		$this->load->view('admin/blog_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/nation_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		$title = $this->input->post('name');
		$slug = strtolower(preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title))));
	 //	$slug = strtolower(preg_replace('blog/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title))));
		$linkCount = $this->db->get_where('blog',array('link'=> $slug))->result_array();
		if(!empty($linkCount))
		{
			if(isset($id) && $id > 0 && count($linkCount) > 1)
			{
				$slug = $slug.'-'.count($linkCount);
			}
			if($id == 0 && count($linkCount) > 0)
			{
				$slug = $slug.'-'.count($linkCount);
			}
			
			 
		}
		$image = $this->input->post('image');
		$image2 = $this->input->post('image2');
					if(isset($_FILES["image"]) && !empty($_FILES["image"]))
					{
						$uploads_dir = 'uploads/blog';
					 	
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

				        $linkAr = array('link'=> $slug);
				        $post = array_merge($post, $linkAr);
				    unset($post['_wysihtml5_mode']);
			if($id){
				$this->db->update('blog', $post, 'id = '.$id);
			} else {
				$this->db->insert('blog', $post);
			}
			redirect('admin/blog');			
		
	}
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('blog', 'id = '.$id);
		redirect('admin/blog');
	}
}