<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/22/14
 * Time: 12:28 PM
 * To change this template use File | Settings | File Templates.
 */

class UserManagement extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->imagesDestPath='images/users/';
    }
    public function getAllUsersNames()
    {
        $res=$this->UserModel->getUsersNames();
        echo json_encode($res);
    }
}