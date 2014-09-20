<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 10:48 AM
 * To change this template use File | Settings | File Templates.
 */

class NewsModel extends CI_Model
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
    function getAll()
    {
        $q=$this->db->query("SELECT *,
        (SELECT language.name from language WHERE language.id=n.languageID) as languageName
         FROM news n");
        if($q->num_rows>0)
            return $q->result();
        return false;
    }
}