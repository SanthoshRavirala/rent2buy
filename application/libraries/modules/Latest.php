<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Latest Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries/Modules
 * @author		dalibor
 */
class Latest {

	private $ci;

	public function __construct()
	{
		$this->ci = & get_instance();
	}
	
	public function index($page = '', $id=0)
	{
		$this->ci->lang->load('latest', $this->ci->language->get_name());
		$data['text_description'] = $this->ci->lang->line('text_description');
		$this->ci->load->model('latest_model');
		$from_model = $this->ci->latest_model->getDemoData();
		foreach($from_model as $fm){
			$data['demo_data'][] = $fm['name'];
		}				
		return $data;		
	}
}
