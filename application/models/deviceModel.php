<?php

class deviceModel extends CI_Model{
	function insert_new($table = 'device',$values_array){
		$this->db->insert($table,$values_array);
		if($this->db->affected_rows() == 1)
			return true;
		return false;
	}

	function update($table = 'device',$post_id,$new_values){
		$this->db->where('id', $post_id);
		$this->db->update($table, $new_values);

		if($this->db->affected_rows() == 1)
			return true;
		return false; 
	}

	function delete($table = 'device',$post_id){
		$this->db->where('id', $id);
		$this->db->delete($table); 

		if($this->db->affected_rows() == 1)
			return true;
		return false; 
	}

	function get($table = 'device',$where,$join_tables = array()){
		
		if(is_array($join_tables) && !empty($join_tables)){
			//tables you want to join here;
		}

		$q = $this->db->get_where($table,$where);

		if($q->num_rows() == 1){
			$row = $q->result()
			return $row[0];
		}
		return flase;
	}

	function getAll($table = 'device',$join_tables = array()){
		
		if(is_array($join_tables) && !empty($join_tables)){
			//tables you want to join here;
		}

		$q = $this->db->get($table)

		if($q->num_rows() > 0){
			
		}
	}
}
?>