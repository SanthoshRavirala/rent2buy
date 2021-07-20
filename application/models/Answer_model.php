<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer_model extends CI_Model {

   	public function get_answer_detail($id)
	{		
		$answers = $this->db->query("SELECT COUNT(v.answer_id) as total, a.name, v.* FROM votes v LEFT JOIN answer a ON(v.answer_id = a.answer_id) WHERE v.answer_id = '". (int)$id ."' GROUP BY v.gender, v.region_id, v.nation_id");	
		return $answers->result_array();
	}
	
	public function get_answer_explanations($answer_id)
	{		
		$answer = $this->db->query("SELECT COUNT(v.user_id) as total, e.name FROM votes v LEFT JOIN explanation e ON(v.explanation_id = e.explanation_id)  WHERE v.answer_id = '". (int)$answer_id ."' GROUP BY v.explanation_id");		
	    return $answer->result_array();
	}
	
	public function get_other_polls($id)
	{				
		$polls = $this->db->query("SELECT p.poll_id, p.name FROM poll p WHERE p.poll_id IN (SELECT v.poll_id FROM votes v) AND poll_id <> '". (int)$id ."' LIMIT 5");			   
		return $polls->result_array();
	}
	
	public function get_related_poll_votes($poll_id, $answer_id)
	{		
		$poll = $this->db->query("SELECT COUNT(v2.user_id) as total, a.* FROM votes v LEFT JOIN votes v2 ON(v.user_id = v2.user_id) LEFT JOIN answer a ON(v2.answer_id = a.answer_id) WHERE v2.poll_id = '". (int)$poll_id ."' AND v.answer_id = '". (int)$answer_id ."' GROUP BY v2.answer_id");		
	    return $poll->result_array();
	}
}