<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/15/14
 * Time: 4:22 PM
 * To change this template use File | Settings | File Templates.
 */

class BrandModel extends CI_Model
{
    function insert($brand)
    {
        $res=$this->db->query("INSERT INTO brand VALUES (null,'".$brand['name']."','".$brand['photo']."');");
        return $res;
    }
    function delete($brandID)
    {
        $this->db->query("DELETE FROM brand WHERE id=".$brandID.";");
    }
    function get($brandID)
    {
        $q=$this->db->query("SELECT * FROM brand WHERE id=".$brandID.";");
        //$q=$this->get_where('brand',array('id'=>$brandID));
        if($q->num_rows>0)
            return $q->row();
        return false;
    }
    function update($updatedBrand)
    {
        $this->db->query("UPDATE brand SET name='".$updatedBrand['name']."',photo='".$updatedBrand['photo']."' WHERE id=".$updatedBrand['id']);
    }
    function getAll()
    {
        $q=$this->db->query("SELECT * FROM brand");
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
    function getDevices($brandID,$numberOfDevices2Fetch)
    {
        $query="SELECT device.id as deviceID,
        dev4Sale.id as device4SaleID,
        dev4Sale.price,
        device.name as deviceName,
        brand.name as brandName,
        brand.photo as brandPhoto,
        device.photo as devicePhoto
        FROM `device-for-sale` dev4Sale
        LEFT JOIN device ON device.id=dev4Sale.deviceID
        LEFT JOIN brand ON brand.id=device.brandID
        LEFT JOIN `device-type` devType ON devType.id=device.deviceTypeID
        WHERE
        dev4Sale.isNew=1 AND
        devType.name='Mobile' AND
        brand.id=$brandID LIMIT ".$numberOfDevices2Fetch.";";
        //echo $query;
        $res=$this->db->query($query);
        if($res->num_rows()>0)
            return $res->result();
        return false;
    }

}