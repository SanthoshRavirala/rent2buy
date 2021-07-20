<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function insert($data)
	{
		$this->db->insert('admin',$data);
		return $this->db->insert_id();
	}
	
	public function get_admin($admin_id)
	{	
        $this->db->select('*');
		$this->db->from('admin');
        $this->db->where('admin_id', $admin_id);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	    return false;	   
	}
	
	public function get_admin_by_email($data)
	{	
		$this->db->select('*');
		$this->db->from('admin');
        $this->db->where('email', $data['email']);
        $this->db->where('password', md5($data['password']));
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	    return false;
	}
	
	public function check_admin_by_email($email)
	{	
		$this->db->select('*');
		$this->db->from('admin');
        $this->db->where('email', $email);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	    return false;
	}
}