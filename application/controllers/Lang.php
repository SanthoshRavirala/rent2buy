<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lang extends CI_Controller {

	public function change ($name = 'english')
	{	
		$this->language->change($name);
		redirect('home');
	}
}