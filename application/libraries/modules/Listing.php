<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Listing Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries/Modules
 * @author		dalibor
 */
class Listing {

	private $ci;

	public function __construct()
	{
		$this->ci = & get_instance();
	}
	
	public function index($page = '', $id=0)
	{
		$this->ci->lang->load('poll', $this->ci->language->get_name());
		$data['text_vote'] = $this->ci->lang->line('text_vote');		
		$data['text_view_results'] = $this->ci->lang->line('text_view_results');	
		$data['text_first'] = $this->ci->lang->line('text_first');	
		$this->ci->load->model('poll_model');
		$polls = $this->ci->poll_model->get_latest_polls();
		$data['polls'] = array();
		foreach($polls as $poll){
			$data['polls'][] =  array(
				'poll_id'     => $poll['poll_id'],
				'name'        => $poll['name'],
				'link'        => site_url('poll/results/'.$poll['poll_id']),	
				'link_vote'   => site_url('poll/index/' .$poll['poll_id']),	
				'votes'       => $this->ci->poll_model->get_poll_votes($poll['poll_id'])
			);            
		}	
		return $data;		
	}
}
