<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 1:44 PM
 * To change this template use File | Settings | File Templates.
 */

class UserCartModel extends CI_Model
{
    function insert($n)
    {
        $res=$this->db->query("INSERT INTO news VALUES (null,'".$n['languageID']."',
        '".$n['title']."','".$n['text']."','".$n['photo']."','".$n['date']."');");
        return $res;
    }
    function delete($newsID)
    {
        $this->db->query("DELETE FROM news WHERE id=".$newsID.";");
    }
    function get($newsID)
    {
        $q=$this->db->query("SELECT * FROM news WHERE id=".$newsID.";");
        if($q->num_rows>0)
            return $q->row();
        return false;
    }
    function update($updatedNews)
    {
        $this->db->query("UPDATE news SET languageID='".$updatedNews['languageID']."',
        title='".$updatedNews['title']."',
        text='".$updatedNews['text']."',
        photo='".$updatedNews['photo']."'
        WHERE id=".$updatedNews['id']);
    }
    function getUnseen()
    {
        $query="SELECT cart.id,
        u.userName,
        u.mobileNumber,
        dev.name as deviceName,
        dev.photo as devicePhoto,
        br.photo as brandPhoto,
        cart.date
        FROM `user-cart` cart
        LEFT JOIN user u ON cart.userID=u.id
        LEFT JOIN device dev ON cart.deviceID=dev.id
        LEFT JOIN brand br ON dev.brandID=br.id
        WHERE cart.isSeen=0;";

        $q=$this->db->query($query);
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
}