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

    public function index()
    {
        $data['userCarts']=$this->UserCartModel->getUnseen();
        $this->load->template($this->viewDirectoryName.'/index');
    }
}