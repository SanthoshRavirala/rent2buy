<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		
		//$this->lang->load('home', $this->language->get_name());
		//$this->load->library('layout');
		//$fixed_header_data = $this->layout->get_header_data('home');
		$data['title'] = 'Home';
		$data['meta_description'] = '';
		
	//	$data['title'] = $this->db->get_where('settings', array('option'=>'meta_title'))->row()->value;
	//	$data['description'] = $this->db->get_where('settings', array('option'=>'meta_description'))->row()->value;
		$data['settings'] = $this->db->get('settings')->result_array();
				
		
		$data['header'] = '';

        $data['footer'] ='';
	
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/home', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function brand($id=null)
	{
		
		$data['header'] = '';
        $data['footer'] ='';
		
		$data['category'] = $this->db->get_where('category',array('category_id'=>$id))->result_array();
		$data['brand_name']=$data['category'][0]['name'];
		if(!empty($data['brand_name'])){
			$data['title'] = $data['category'][0]['name'];
		} else{
			$data['title'] = 'Brand';
		}
	    $data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/brand', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function rent_a_car_list()
	{
		$data['title'] = 'Rent a car';
		$data['header'] = '';
        $data['footer'] ='';
		
		$data['rent_a_car'] = $this->db->get_where('rent_a_car')->result_array();
	    $data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/rent_a_car', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function rent_a_car_detail($link=null)
	{
		$data['title'] = $link;
		$data['header'] = '';
        $data['footer'] ='';
		
		$data['rent_detail'] = $this->db->get_where('rent_a_car',array('link'=>$link))->result_array();
	    $data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/rent_a_car_detail', $data);
		$this->load->view('frontend/footer');
	}
	
	
	
	public function sell_a_car_list()
	{
		$data['title'] = 'sell a car';
		$data['header'] = '';
        $data['footer'] ='';
		
		$data['rent_a_car'] = $this->db->get_where('sell_a_car')->result_array();
	    $data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/sell_a_car', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function sell_a_car_detail($link=null)
	{
		$data['title'] = $link;
		$data['header'] = '';
        $data['footer'] ='';
		
		$data['rent_detail'] = $this->db->get_where('sell_a_car',array('link'=>$link))->result_array();
	    $data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/sell_a_car_detail', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function rent_to_buy_list()
	{
		$data['title'] = 'Rent to buy';
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		  
		$data['rent_a_car'] = $this->db->get_where('rent_to_buy')->result_array();
	
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/rent_to_buy', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function rent_to_buy_detail($link=null)
	{
		$data['title'] = $link;
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		
		$data['rent_detail'] = $this->db->get_where('rent_to_buy',array('link'=>$link))->result_array();
	
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/rent_to_buy_detail', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function about_us()
	{
		$data['title'] = 'About us';
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/about_us', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function contact_us()
	{
		$data['title'] = 'Contact us';
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/contact_us', $data);
		$this->load->view('frontend/footer');
	}
	
	public function our_services()
	{
		$data['title'] = 'Our services';
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/our_services', $data);
		$this->load->view('frontend/footer');
	}
	
	public function faqs()
	{
		$data['title'] = 'Faqs';
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/faqs', $data);
		$this->load->view('frontend/footer');
	}
	
	
	public function thanks()
	{
		$data['title'] = 'Thanks';
		$data['header'] = '';
        $data['footer'] ='';
		$data['settings'] = $this->db->get('settings')->result_array();
		
		$this->load->view('frontend/header',$data);
		$this->load->view('frontend/thanks', $data);
		$this->load->view('frontend/footer');
	}
	
	
	
	public function booking()
	{
		
		$post=$this->input->post();
		
		$save=$this->db->insert('booking',$post);
		
		if(!empty($save)){
		 	redirect('thanks'); 
			
		}
		
	}
	
		public function contact_submit()
	{
		
		$post=$this->input->post();
		  
		//  unset($post['title']);
		  
		
		$save=$this->db->insert('contact_us',$post);
		
		
		
		
		if(!empty($save)){
		
		 /* $this->load->model('extension_model');
			   $email_admin = $this->db->get_where('settings', array('option'=>'email'))->row()->value;
			 	$to      = $email_admin;
				$subject = 'Contact Us';
				$from    = $post['email'];
				
				$message  = "<p style='color:black;'><strong>Book a car:  </strong>".$post['title']."</p>";
				$message .= "<br>";
                $message .= "<strong style='color:black;'>Name:  </strong>" .$post['name'];
				$message .= "<br>";
				$message .= "<strong style='color:black;'>Email:  </strong>" .$post['email'];
				$message .= "<br>";
			    $message .= "<strong style='color:black;'>Phone:  </strong>" .$post['phone'];
			    $send_mail = $this->extension_model->email_queue($to, $subject,$message, $from);
			    if($send_mail == true){
    					redirect('thanks');
				}
			    redirect('thanks'); 
				*/
		}		
		
		
		
		 	
			
		
		
	}
	
	
}

