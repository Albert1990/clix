<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/15/14
 * Time: 5:21 PM
 * To change this template use File | Settings | File Templates.
 */

class AdvertisementModel extends CI_Model
{
    function insert($ad)
    {
        $res=$this->db->query("INSERT INTO advertisement VALUES (null,'".$ad['languageID']."',
        '".$ad['title']."','".$ad['text']."','".$ad['photo']."','".$ad['date']."');");
        return $res;
    }
    function delete($adID)
    {
        $this->db->query("DELETE FROM advertisement WHERE id=".$adID.";");
    }
    function get($adID)
    {
        $q=$this->db->query("SELECT * FROM advertisement WHERE id=".$adID.";");
        if($q->num_rows>0)
            return $q->row();
        return false;
    }
    function update($updatedAd)
    {
        $this->db->query("UPDATE advertisement SET languageID='".$updatedAd['languageID']."',
        title='".$updatedAd['title']."',
        text='".$updatedAd['text']."',
        photo='".$updatedAd['photo']."'
        WHERE id=".$updatedAd['id']);
    }
    function getAll()
    {
        $q=$this->db->query("SELECT *,
        (SELECT language.name from language WHERE language.id=ads.languageID) as languageName
         FROM advertisement ads");
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
}