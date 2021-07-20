<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll_model extends CI_Model {

    public function vote($data, $id) 
	{
	    if($this->get_poll_voted($id, $data['user_id'])){
			exit('Voting is not alowed');
	    }	
		$ip_address  = $_SERVER['REMOTE_ADDR'];
		// local host fix
		if($ip_address == '::1'){
			$ip_address = '127.1.0.1';
		}
		$user = $this->db->get_where('user', 'user_id = '. $data['user_id'])->row_array();
		$gender    = $user['gender'];
		$region_id = $user['region_id'];
		$nation_id = $user['nation_id'];	
		$age = get_age(gmdate('Y-m-d'), $user['date_birth']);

		$this->db->query("INSERT INTO votes SET poll_id = '". (int)$id ."', answer_id = '". (int)$data['answer_id'] ."', user_id = '". (int)$data['user_id'] ."', nation_id = '". (int)$nation_id ."', region_id = '". (int)$region_id ."', gender = '". (int)$gender ."', age = '". (int)$age ."', ip_address = '". $ip_address ."', date_add = NOW()");
	
		return $this->db->insert_id();
    }
	
	public function add_explanation($data, $id) 
	{
		$this->db->query("UPDATE votes SET explanation_id = '". (int)$data['explanation_id'] ."' WHERE user_id = '". (int)$data['user_id'] ."' AND answer_id = '". (int)$id ."'");
    }
	
	public function get_latest_polls()
	{		
		$query = $this->db->query("SELECT * FROM poll ORDER BY date_add DESC LIMIT 10");		
	    return $query->result_array();
	}
	
	public function get_category_polls($id = 0)
	{		
		$query =  $this->db->query("SELECT * FROM poll p LEFT JOIN poll_to_category pc ON(p.poll_id = pc.poll_id) WHERE pc.category_id = '". (int)$id ."' ORDER BY date_add DESC");
		return $query->result_array();
	}
	
	public function get_poll_votes($id)
	{		
		$query = $this->db->query("SELECT COUNT(v.user_id) as total, a.* FROM votes v LEFT JOIN answer a ON(v.answer_id = a.answer_id) WHERE v.poll_id = '". (int)$id ."' GROUP BY v.answer_id");		
	    return $query->result_array();
	}
	
	public function get_votes_by_month($id)
	{		
		$query = $this->db->query("SELECT COUNT(v.user_id) as total, MONTH(v.date_add) as month_voted, v.date_add, a.* FROM votes v LEFT JOIN answer a ON(v.answer_id = a.answer_id) WHERE v.poll_id = '". $id ."' GROUP BY v.answer_id, MONTH(v.date_add)");			   
		return $query->result_array();
	}
	
	public function get_votes_by_gender($id, $gender)
	{		
		$query = $this->db->query("SELECT COUNT(v.user_id) as total, a.name FROM votes v LEFT JOIN answer a ON(v.answer_id = a.answer_id) WHERE v.poll_id = '". (int)$id ."' AND v.gender='". (int)$gender ."' GROUP BY v.answer_id");		
	    return $query->result_array();
	}
	
	public function get_age_answer_votes($age_min = 0, $age_max = 0, $answer_id)
	{		
		$query = $this->db->query("SELECT COUNT(v.user_id) as total FROM votes v WHERE  v.age BETWEEN '". (int)$age_min ."' AND '". (int)$age_max ."' AND v.answer_id='". (int)$answer_id ."'");		
	    $poll = $query->row_array();
		return $poll['total'];
	}
	
	public function get_next($poll_id, $answer_id = 0,$user_id)
	{
		$link = '';
		if($answer_id){
			$exp = $this->db->get_where('explanation',  'answer_id = '.$answer_id)->result_array();
			if($exp){
				$link = 'poll/explanation/'. $answer_id .'/'. $poll_id;
			}
		}
		if(!$link){
			$poll = $this->db->query("SELECT * FROM poll WHERE poll_id NOT IN (SELECT poll_id FROM votes WHERE user_id='". (int)$user_id ."') LIMIT 1")->row_array();
			if(!empty($poll)){
				$link = 'poll/index/'. $poll['poll_id'];
			} else {
				$link = 'poll/results/'. $poll_id;
			}
		}
		return $link ? $link : "home";
		
	}
		
	public function get_poll_voted($id, $user_id)
	{	
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$ip_address_array = explode('.', $ip_address);
		// local host fix
		if(count($ip_address_array) < 2){
			$ip_address = '127.1.0.1';
			$ip_address_array = explode('.', $ip_address);
		}
		$ip_address = $ip_address_array[0]. '.'. $ip_address_array[1];
		$query = $this->db->query("SELECT v.user_id FROM votes v WHERE v.poll_id = '". (int)$id ."' AND (v.user_id ='".(int)$user_id."' OR v.ip_address LIKE '". $ip_address ."%')");		
	    return $query->row_array();
	}
}