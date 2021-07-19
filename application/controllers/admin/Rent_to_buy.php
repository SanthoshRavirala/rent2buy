<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rent_to_buy extends CI_Controller {

	public function index($start=0)
	{ 	
		$this->lang->load('admin/user', $this->language->get_name());					
		$this->load->library('admin/layout');
				
		$fixed_header_data = $this->layout->get_header_data('user');
		$var_header_data['title'] = 'Rent to buy';			   	           
		$data['text_email'] = $this->lang->line('text_email');	       
		$data['text_id'] = $this->lang->line('text_id');			   
		$data['text_edit_delete'] = $this->lang->line('text_edit_delete');	   
		$data['text_add'] = $this->lang->line('text_add');	    		
		$data['text_edit'] = $this->lang->line('text_edit');	    		
		$data['text_showing'] = $this->lang->line('text_showing');
		$data['link_add'] = site_url('admin/rent_to_buy/add');
		$limit = $this->config->item('c_limit');
		
	    $data['users'] = array();	    
		$user_number = $this->db->get('rent_to_buy')->num_rows();				
	    $users = $this->db->get('rent_to_buy', $limit, $start)->result_array();
		
		foreach($users as $user){
			$data['users'][] =  array(
				'id'   => $user['id'],
				'title'   => $user['title'],
				'link'    => site_url('admin/rent_to_buy/add/'.$user['id']),
			    'link_clone'        => site_url('admin/rent_to_buy/rent_to_buy_clone/'.$user['id']),
			    'delete_link' => site_url('admin/rent_to_buy/delete/'.$user['id'])  ,
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
		
		$this->load->view('admin/rent_to_buy', $data);
	}
	
	
	
	
	public function add($id = 0, $post = array(), $error = array())
	{
	
		$this->lang->load('admin/user', $this->language->get_name());
		$this->lang->load('admin/_global', $this->language->get_name());		
		$this->load->library('admin/layout');
		
		$fixed_header_data = $this->layout->get_header_data('user');
		$var_header_data['title'] = 'Rent to buy';
		$data['text_cancel'] = $this->lang->line('text_cancel');
		$data['text_firstname'] = $this->lang->line('text_firstname');	    
		$data['text_lastname'] = $this->lang->line('text_lastname');		
		$data['text_email'] = $this->lang->line('text_email');			
		$data['text_password'] = $this->lang->line('text_password');		
		$data['text_region'] = $this->lang->line('text_region');		
		$data['text_select_region'] = $this->lang->line('text_select_region');	
		$data['text_nation'] = $this->lang->line('text_nation');		
		$data['text_select_nation'] = $this->lang->line('text_select_nation');	
		$data['text_user_group'] = $this->lang->line('text_user_group');		
		$data['text_gender'] = $this->lang->line('text_gender');		
		$data['text_date_birth'] = $this->lang->line('text_date_birth');	
		$data['text_male'] = $this->lang->line('text_male');		    
		$data['text_female'] = $this->lang->line('text_female');	
		//$data['text_all'] = $this->lang->line('text_all');
		$data['regions']  = $this->db->get('region')->result_array();
        $data['nations']  = $this->db->get('nation')->result_array();
        $data['user_groups']  = $this->db->get('user_group')->result_array();
		if($id){
			$data['text_edit'] = $this->lang->line('text_edit');
			$data['button_edit'] = $this->lang->line('button_edit');
		} else {
			$data['text_edit'] = $this->lang->line('text_add');
			$data['button_edit'] = $this->lang->line('button_add');
		}
		
		$data['button_cancel'] = $this->lang->line('button_cancel');
		
		if($id && !$post){
			$post = $this->db->get_where('rent_to_buy', array('id' => $id))->row_array();
		}
		if($post){
			
			foreach($post as $key=>$value){
				$data[$key] = $value;
			}
		} else {
			$data['title']  = '';
			$data['description']  = '';
			$data['price']  = 0;
			$data['image']  = '';
			$data['category_id']  = '';
			$data['car_type']  = '';
			//$data['image']  = '';
			
		}
		$data['error'] = $error;	
	    if($id){
			$data['link'] = site_url('admin/rent_to_buy/validate/'.$id);
		} else {
			$data['link'] = site_url('admin/rent_to_buy/validate');
		}
		
	    $data['cancel'] = site_url('admin/rent_to_buy');
		$data['id'] = $id;
		$data['header'] = $this->load->view('admin/header', array_merge($fixed_header_data, $var_header_data), true);
        $data['footer'] = $this->load->view('admin/footer', $this->layout->get_footer_data('user'), true);
		$data['sidebar'] = $this->load->view('admin/sidebar', $this->layout->get_left_data('user'), true);
		
		$this->load->view('admin/rent_to_buy_add', $data);
	}
	public function validate($id = 0){
		$this->lang->load('admin/user_error', $this->language->get_name());
		$error = array();
		$post = $this->input->post();
		if($post['title'] == ''){
		    $error['error_title'] = 'Enter title';			
		}
		if($post['description'] == ''){
		    $error['error_description'] = 'Enter Description';			
		}
		
					//	unset($post['list_1']);
					//	unset($post['list_2']);
						unset($post['_wysihtml5_mode']);
						
		$title = $this->input->post('title');
		$slug = strtolower(preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title))));
		$linkCount = $this->db->get_where('rent_to_buy',array('link'=> $slug))->result_array();
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
						$uploads_dir = 'uploads/rent_to_buy';
					 	
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
                        unset($post['files']);
				        $linkAr = array('link'=> $slug);
				        $post = array_merge($post, $linkAr);				
		
	
		if($error){
			$this->add($id, $post, $error);
		} else {
			//$post['password'] = md5($post['password']);
			if($id){
				
				
				
				$post['list_1']=json_encode($post['list_1']);
				$post['list_2']=json_encode($post['list_2']);
				$this->db->update('rent_to_buy', $post, 'id = '.$id);
				
				$files = $this->input->post('files');
				if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
					$filesCount = count($_FILES['files']['name']); 
                for($i = 0; $i < $filesCount; $i++){ 
						  $filename = $_FILES['files']['name'][$i];
                          $ramod_numvv = rand();
						
						  // Upload file
						  move_uploaded_file($_FILES['files']['tmp_name'][$i],'./uploads/gallery/'.$ramod_numvv.'-'.$filename);
						$data_file = array('image' => 'uploads/gallery/' .$ramod_numvv.'-'. $filename,'gallery_id'=>$id,'tb_name'=>'rent_to_buy');
						 $this->db->insert('gallery', $data_file);
					}
				} 
				
			} else {
				$post['list_1']=json_encode($post['list_1']);
				$post['list_2']=json_encode($post['list_2']);
				$this->db->insert('rent_to_buy', $post);
				$insert_id=$this->db->insert_id();
				
				$files = $this->input->post('files');
				if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
					$filesCount = count($_FILES['files']['name']); 
                for($i = 0; $i < $filesCount; $i++){ 
						  $file_name = $_FILES['files']['name'][$i];
                          $ramod_numvv = rand();
						  // Upload file
						  move_uploaded_file($_FILES['files']['tmp_name'][$i],'./uploads/gallery/'.$ramod_numvv.'-'.$filename);
						$data_file = array('image' => 'uploads/gallery/' . $ramod_numvv.'-'.$filename,'gallery_id'=>$insert_id,'tb_name'=>'rent_to_buy');
						 $this->db->insert('gallery', $data_file);
					}
				} 
				
				
			}
			redirect('admin/rent_to_buy');			
		}
	}
	
	public function rent_to_buy_clone($id = null)
	{	
		
		if($id){
			$rent_to_buy = $this->db->get_where('rent_to_buy', array('id' => $id))->row_array();
		
			 
		}
		if(!empty($rent_to_buy)){
			foreach($rent_to_buy as $key=>$value){
				$data[$key] = $value;
		}			
		$rent_to_buy_data = array(
			'title'     =>    $data['title'].'(copy)',
			'description'    =>    $data['description'],
            'link'    =>    $data['link'],
			'image'    =>    $data['image'],			
			'list_1'          => $data['list_1'],
			'list_2'          => $data['list_2']
		);
		
		$this->db->insert('rent_to_buy',$rent_to_buy_data);
			$insert_id=$this->db->insert_id();
		//insert page element table	
	}
	redirect('admin/rent_to_buy');			
}	

	
	public function delete($id = 0, $token)
	{	
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->where('gallery_id',$id);
		$this->db->where('tb_name','rent_to_buy');
		$this->db->delete('gallery');
		$this->db->delete('rent_to_buy', 'id = '.$id);
		redirect('admin/rent_to_buy');
	}
	
	
	public function delete_image($id = 0,$gallery_id=0, $token)
	{
		If($token !== $this->security->get_csrf_hash()){
			exit('Security error 1');
		}
		$this->db->delete('gallery', 'id = '.$id);
		redirect('admin/rent_to_buy/add/'.$gallery_id);
	}
	
}