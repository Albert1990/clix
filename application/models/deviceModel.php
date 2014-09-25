<?php

class deviceModel extends CI_Model{
	function insert_new($table = 'device',$values_array){
		$this->db->insert($table,$values_array);
		if($this->db->affected_rows() == 1)
			return true;
		return false;
	}

	function update($table = 'device',$id,$new_values){
		$this->db->where('id', $id);
		$this->db->update($table, $new_values);

		if($this->db->affected_rows() == 1)
			return true;
		return false; 
	}

	function delete($table = 'device',$id){
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

		if($q->num_rows() > 0){
			$row = $q->result();
			return $row[0];
		}

		return false;
	}

	/**
     * get items from specific table and mabye join others table to 
     *
     * under testing 
     * 
     * @since          0.2  
     * @param  string  main table  
     * @param  array   array of arrays with array('table_name'=>$table_name,$col1=>first column joining on ,$col_2=> second table joing to)  
     * @return bool    true or false
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */

	function getAll($table = 'device',$join_tables = array(),$select = null,$where = null){
		
		if(!is_null($where)){
			$this->db->where($where);
		}

		if(!is_null($select)){
			$this->db->select($select);
		}
		if(is_array($join_tables) && !empty($join_tables)){
			foreach ($join_tables as $join_table) {
				$this->db->join($join_table['table_name'],$join_table['col_1'].'='.$join_table['col_2']);
			}
		}

		$q = $this->db->get($table);

		if($q->num_rows() > 0){
			return $q->result(); 
		}
		return false;
	}

	function get_last($table='device'){

		$q = $this->db->get($table,1,0);

		if($q->num_rows() == 1){
			$row = $q->result();
			return $row[0];
		}
	}

	function excute_query($query){
		$q = $this->db->query($query);
		if($q->num_rows() > 0){
			return $q->result();
		}
	}
}
?>