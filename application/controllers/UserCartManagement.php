<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 1:41 PM
 * To change this template use File | Settings | File Templates.
 */

class UserCartManagement extends MY_Controller
{
    private $viewDirectoryName="UserCartManagement";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserCartModel');
        $this->imagesDestPath='images/brands/';
    }

    public function showProcessed()
    {
        $this->data['userCarts']=$this->UserCartModel->getProcessed();
        //var_dump($this->data['userCarts']);
        $this->load->template($this->viewDirectoryName.'/showProcessed',$this->data);
    }

    public function showUnprocessed()
    {
        $this->data['userCarts']=$this->UserCartModel->getUnprocessed();
        //var_dump($this->data['userCarts']);
        $this->load->template($this->viewDirectoryName.'/showUnprocessed',$this->data);
    }
    public function markAsProcessed()
    {
        $userCartID=$this->input->post('userCartID',true);
        $res=$this->UserCartModel->markAsProcessed($userCartID);
        $flag=false;
        if($res)
            $flag=true;
        echo json_encode(array('flag'=>$flag));
    }
    public function removeDevice($userID,$deviceForSaleID)
    {
        $query="DELETE FROM `user-cart` WHERE userID=$userID AND deviceForSaleID=$deviceForSaleID;";
        return $this->db->query($query);
    }
    public function reset($userID)
    {
        $query="DELETE FROM `user-cart` WHERE userID=$userID;";
        return $this->db->query($query);
    }
}