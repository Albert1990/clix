<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 8:02 PM
 * To change this template use File | Settings | File Templates.
 */

class SliderModel extends CI_Model
{
    function insert($slide)
    {
        $res=$this->db->query("INSERT INTO slider VALUES (null,'".$slide['languageID']."',
        '".$slide['title']."','".$slide['text']."','".$slide['photo']."');");
        return $res;
    }
    function delete($slideID)
    {
        $this->db->query("DELETE FROM slider WHERE id=".$slideID.";");
    }
    function get($slideID)
    {
        $q=$this->db->query("SELECT * FROM slider WHERE id=".$slideID.";");
        if($q->num_rows>0)
            return $q->row();
        return false;
    }
    function update($updatedSlide)
    {
        $this->db->query("UPDATE slider SET languageID='".$updatedSlide['languageID']."',
        title='".$updatedSlide['title']."',
        text='".$updatedSlide['text']."',
        photo='".$updatedSlide['photo']."'
        WHERE id=".$updatedSlide['id']);
    }
    function getAll()
    {
        $q=$this->db->query("SELECT *,
        (SELECT language.name from language WHERE language.id=ads.languageID) as languageName
         FROM slider ads");
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
}