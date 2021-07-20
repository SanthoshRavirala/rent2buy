<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll_model extends CI_Model {

    public function add($data) 
	{
		$this->db->query("INSERT INTO poll SET name = " . $this->db->escape($data['name']) . ", description = " . $this->db->escape($data['description']) . ", meta_description = " . $this->db->escape($data['meta_description']) . ", message_long = " . $this->db->escape($data['message_long']) . ", message_short = " . $this->db->escape($data['message_short']) . ", tag = " . $this->db->escape($data['tag']) . ", type = " . (int)$data['type'] . ", user_id = ". (int)$data['user_id'] .", status = ". (int)$data['status'] .", date_add = NOW()");
		
		$poll_id = $this->db->insert_id();
		
		if(isset($data['category'])){
			foreach($data['category'] as $category_id){
				$this->db->query("INSERT INTO poll_to_category SET poll_id = '". (int)$poll_id ."', category_id = '". (int)$category_id ."'");
			}
		}
		
		foreach($data['answers'] as $answer){
			$this->db->query("INSERT INTO answer SET poll_id = '". $poll_id ."', name =" . $this->db->escape($answer['name']));
			$answer_id = $this->db->insert_id();
			if(isset($answer['explanation'])){
			    foreach($answer['explanation'] as $explanation){
					if($explanation['name'])	{	
						$this->db->query("INSERT INTO explanation SET answer_id ='". (int)$answer_id ."', poll_id ='". (int)$poll_id ."', name = " . $this->db->escape($explanation['name']));	
					}
				}    
			} 
	    }
		return $poll_id;
    }
	
	public function edit($data, $id) {
		$this->db->query("UPDATE poll SET name = " . $this->db->escape($data['name']) . ", description = " . $this->db->escape($data['description']) . ", meta_description = " . $this->db->escape($data['meta_description']) . ", message_long = " . $this->db->escape($data['message_long']) . ", message_short = " . $this->db->escape($data['message_short']) . ", tag = " . $this->db->escape($data['tag']) . ", type = " . (int)$data['type'] . ", status = ". (int)$data['status'] ." WHERE poll_id = '". (int)$id ."'");
		
		$this->db->query("DELETE FROM poll_to_category WHERE poll_id = '". (int)$id ."'");		
		if(isset($data['category'])){
			foreach($data['category'] as $category_id){
				$this->db->query("INSERT INTO poll_to_category SET poll_id = '". (int)$id ."', category_id = '". (int)$category_id ."'");
			}
		}		
		$vote = $this->db->query("SELECT v.poll_id FROM votes v WHERE v.poll_id = '". (int)$id ."'");		
	    if($vote->num_rows){
	        return $id;
	    }
		$this->db->query("DELETE FROM answer WHERE poll_id = '". (int)$id ."'");
		$this->db->query("DELETE FROM explanation WHERE poll_id = '". (int)$id ."'");
		foreach($data['answers'] as $answer){
			$this->db->query("INSERT INTO answer SET poll_id = '". (int)$id ."', name = " . $this->db->escape($answer['name']));
			$answer_id = $this->db->insert_id();
			if(isset($answer['explanation'])){			   			   
			    foreach($answer['explanation'] as $explanation){
					if($explanation['name'])	{	
						$this->db->query("INSERT INTO explanation SET answer_id ='". (int)$answer_id ."', poll_id = '". (int)$id ."', name = " . $this->db->escape($explanation['name']));	
					}
				}    
			} 
	    }
		return $id;
    }	

	public function get_poll_categories($id)
	{		
		$category = array();
		$query =  $this->db->query("SELECT category_id FROM poll_to_category  WHERE poll_id = '". (int)$id ."'");
		foreach($query->result_array() as $row){
			$category[] = $row['category_id'];
		}
		return $category;
    }
	
	public function get_poll_answers($id)
	{				
		$answer_explanation = array();
		$answers = $this->db->query("SELECT * FROM answer WHERE poll_id = '". (int)$id ."'");		
	    foreach($answers->result_array() as $answer){
			$explanation = $this->db->query("SELECT name FROM explanation WHERE answer_id = '". (int)$answer['answer_id'] ."'");
			$answer_explanation[] = array(
				'name' => $answer['name'],
				'explanation'=> $explanation->result_array()
			);					
	    }
		return $answer_explanation;
	}
}