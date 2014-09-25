<?php
/**
 * models/userModel.php dealing with database done for users
 * Copyright (C) 2008-2012 Brain Socker <berainsocket.com>
 *
 * LICENSE: this program isn't open source
 * you don't have the right to copy it,use it, download it or use some part of it without
 * permission
 *
 * @package Clix
 * @version 0.1
 * @author  Mohammed Manssour <manssour.mohammed@gmail.com>
 * @link    http://www.jawsaqLabs.com
 */
class UserModel extends CI_Model{

    function getUsersNames()
    {
        $q=$this->db->query("SELECT id,userName FROM user");
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
	
	/**
     * getting all info of the current user
     *
     * this function isn't completed or tested yet 
     * check current user
     * @since          0.2  
     * @return $object 
     */
	function get_current_user_info($user_id){

	}

	/**
     * getting user permissions
     *
     * becuase we are dealing with one user then the result will be one row 
     * then we check if the user result didn't have problems when fetching from database
     * @since  0.2  
     * @return $object 
     */
	function get_user_permission($user_id){
		//the query
		$this->db->select('user_permission');
		$query = $this->db->get_where('user',array('id'=>$user_id));

		if($query->num_rows() == 1 && $query->result())
			return $query->result();
		return false;

	}

	/**
     * getting Item publisher permissions
     *
     * becuase we are dealing with one user then the result will be one row 
     * then we check if the user result didn't have problems when fetching from database
     * @since  0.2  
     * @return $object 
     */
	function get_item_publisher($tabel,$itemID){
		$this->db->select('userID');
		$query = $this->db->get_where($tabel,array('id'=>$itemID));
		if($query->num_rows() ==1 && $query->result())
			return $query->result();

		return false;

	}
}
?>