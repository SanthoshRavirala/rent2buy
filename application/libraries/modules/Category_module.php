<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Category_module Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries/Modules
 * @author		dalibor
 */
class Category_module {

	private $ci;

	public function __construct()
	{
		$this->ci = & get_instance();
	}
	
	public function index($page = '', $id=0)
	{
		$categories = $this->ci->db->get('category')->result_array();
		$data['categories'] = array();
		foreach($categories as $category){
			$data['categories'][] = array(
				'name' => $category['name'],
				'link' => site_url('category/index/'.$category['category_id']),
			);
		}
		
		return $data;		
	}
}
