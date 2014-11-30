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
		if(is_array($id)){
			$this->db->where($id);
		}else{
			$this->db->where('id', $id);
		}
		$this->db->delete($table); 

		if($this->db->affected_rows() > 0)
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

//    function getLastDevicesInBrand($brandID)
//    {
//        $query="SELECT dev4Sale.id as device4SaleID,
//        dev4Sale.price,
//        device.id as deviceID,
//        device.name as deviceName,
//        brand.name as brandName,
//        brand.photo as brandPhoto,
//        device.photo as devicePhoto
//        FROM `device-for-sale` dev4Sale
//        LEFT JOIN device ON device.id=dev4Sale.deviceID
//        LEFT JOIN brand ON brand.id=device.brandID
//        LEFT JOIN `device-type` devType ON devType.id=device.deviceTypeID
//        WHERE
//        dev4Sale.isNew=1 AND
//        devType.name='Mobile' AND
//        brand.id=$brandID LIMIT 6;";
//        //echo $query;
//
//        $res=$this->db->query($query);
//        if($res->num_rows()>0)
//            return $res->result();
//        return false;
//    }

    function getDeviceOverview($deviceID)
    {
        $query="SELECT devProp.value,
        devAttr.enName as name,
        devAttrUnit.name as unitName
        FROM `device-property` devProp
        LEFT JOIN `device-attribute` devAttr ON devAttr.id=devProp.deviceAttributeID
        LEFT JOIN `device-attribute-unit` devAttrUnit ON devAttrUnit.id=devAttr.deviceAttributeUnitID
        WHERE
        devProp.deviceID=$deviceID AND
        devAttr.isImportant=1;";
        //echo $query;
        $res=$this->db->query($query);
        if($res->num_rows())
            return $res->result();
        return false;
    }

	function get_last($table='device'){

		$q = $this->db->query("SELECT * FROM $table ORDER BY id DESC LIMIT 1");

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