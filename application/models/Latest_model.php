<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Latest_model extends CI_Model {

    function getDemoData()
    {
        $query = $this->db->get('region');
        return $query->result_array();
    }
}