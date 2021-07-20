<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fb Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries/Modules
 * @author		dalibor
 */
class Fb {

	private $ci;

	public function __construct()
	{
		$this->ci = & get_instance();
	}
	
	public function index ()
	{
		$data['fb_url'] = $this->ci->config->item('fb_url');
		$data['fb_type'] = $this->ci->config->item('fb_type');
		$data['fb_title'] = $this->ci->config->item('fb_title');
		$data['fb_description'] = $this->ci->config->item('fb_description');
		$data['fb_image'] =  base_url() . $this->ci->config->item('fb_image');
		$data['fb_api'] =  $this->ci->config->item('fb_api');
		if($this->ci->uri->segment(1) === 'poll'){
			$poll = $this->ci->db->get_where('poll', 'poll_id = '. $this->ci->uri->segment(3))->row_array();
			if(!$poll){
				return $data;
			}
			if($this->ci->uri->segment(2) === 'results'){
				$data['fb_url'] = site_url('poll/results/'. $this->ci->uri->segment(3));
				$data['fb_type'] = 'article';
				$data['fb_title'] = $poll['name'];						
			} else {
				$data['fb_title'] = 'Vote for poll - '. $poll['name'];
				$data['fb_type'] = 'article';
				$data['fb_url'] = site_url('poll/index/'. $this->ci->uri->segment(3));			    
			}
			
		}
		
		return $data;
	}
}
