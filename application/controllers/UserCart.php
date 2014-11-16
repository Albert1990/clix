<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 11/13/14
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */

class UserCart extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserCartModel');
        $this->imagesDestPath='images/brands/';
    }
    public function add()
    {
        $deviceForSaleID=$this->input->get('deviceForSaleID');
        $userID=$this->input->get('userID');
        //$deviceID=$this->input->get('deviceID');
        $isSeen=0;
        $isProcessed=0;

        $userCart=array('userID'=>$userID,'deviceForSaleID'=>$deviceForSaleID,'isSeen'=>$isSeen,'isProcessed'=>$isProcessed);
        $res=$this->UserCartModel->insert($userCart);
        $flag=false;
        if($res)
            $flag=true;

        echo json_encode(array('flag'=>$flag));
    }
    public function remove()
    {
        $userID=$this->input->get('userID');
        $deviceForSaleID=$this->input->get('deviceForSaleID');

        $res=$this->UserCartModel->removeDevice($userID,$deviceForSaleID);
        $flag=false;
        if($res)
            $flag=true;
        echo json_encode(array('flag'=>$flag));
    }
    public function reset()
    {
        $userID=$this->input->get('userID');
        $res=$this->UserCartModel->reset($userID);
        $flag=false;
        if($res)
            $flag=true;
        echo json_encode(array('flag'=>$flag));
    }
    public function acceptCart()
    {
        $userID=$this->input->get('userID');
        $res=$this->UserCartModel->acceptCart($userID);
        $flag=false;
        if($res)
            $flag=true;
        echo json_encode(array('flag'=>$flag));
    }
    public function getCart()
    {
        $userID=$this->input->post('userID',true);
        $userCart=$this->UserCartModel->getUnapproved($userID);
        echo json_encode($userCart);
    }
}