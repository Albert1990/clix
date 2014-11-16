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
    function insert($userCart)
    {
        $query="INSERT INTO `user-cart` VALUES (null,
        ".$userCart['userID'].",
        ".$userCart['deviceForSaleID'].",
        -1,
        NOW(),
        ".$userCart['isSeen'].",
        ".$userCart['isProcessed'].");";
        $res=$this->db->query($query);
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
    function getUnprocessed()
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
        LEFT JOIN `device-for-sale` dev4Sale ON cart.deviceForSaleID=dev4Sale.id
        LEFT JOIN device dev ON dev4Sale.deviceID=dev.id
        LEFT JOIN brand br ON dev.brandID=br.id
        WHERE
        cart.isProcessed=0 AND
        cart.isAccepted=1;";

        //echo $query;
        $q=$this->db->query($query);
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
    function getProcessed()
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
        LEFT JOIN `device-for-sale` dev4Sale ON cart.deviceForSaleID=dev4Sale.id
        LEFT JOIN device dev ON dev4Sale.deviceID=dev.id
        LEFT JOIN brand br ON dev.brandID=br.id
        WHERE
        cart.isProcessed=1 AND
        cart.isAccepted=1;";

        //echo $query;
        $q=$this->db->query($query);
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
    function markAsProcessed($userCartID)
    {
        $query="UPDATE `user-cart` SET isProcessed=1,processingDate=NOW() WHERE id=".$userCartID.";";
        return $this->db->query($query);
    }
    function acceptCart($userID)
    {
        $query="UPDATE `user-cart` SET isAccepted=1 WHERE userID=$userID;";
        return $this->db->query($query);
    }
    function getUnapproved($userID)
    {
        $query="SELECT cart.id,
        dev.name as deviceName,
        dev.photo as devicePhoto,
        br.photo as brandPhoto,
        cart.date
        FROM `user-cart` cart
        LEFT JOIN user u ON cart.userID=u.id
        LEFT JOIN `device-for-sale` dev4Sale ON cart.deviceForSaleID=dev4Sale.id
        LEFT JOIN device dev ON dev4Sale.deviceID=dev.id
        LEFT JOIN brand br ON dev.brandID=br.id
        WHERE
        cart.isAccepted=0;";

        //echo $query;
        $q=$this->db->query($query);
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
}
