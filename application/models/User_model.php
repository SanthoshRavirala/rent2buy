<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert($data)
	{
		$this->db->insert('user',$data);
		return $this->db->insert_id();
	}
	
	public function get_user($user_id)
	{	
        $this->db->select('*');
		$this->db->from('user');
        $this->db->where('user_id', $user_id);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	    return false;	   
	}
	
	public function get_user_by_email($data)
	{	
		$this->db->select('*');
		$this->db->from('user');
        $this->db->where('email', $data['email']);
        $this->db->where('password', md5($data['password']));
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	    return false;
	}
	
	public function check_user_by_email($email)
	{	
		$this->db->select('*');
		$this->db->from('user');
        $this->db->where('email', $email);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	    return false;
	}
	
	public function get_regions()
	{	
        $query = $this->db->get('region');
        return $query->result_array();	   
	}
	
	public function get_nations()
	{	
        $query = $this->db->get('nation');
        return $query->result_array();	   
	}
}