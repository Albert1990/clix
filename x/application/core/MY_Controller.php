<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 11/1/14
 * Time: 4:28 AM
 * To change this template use File | Settings | File Templates.
 */

class MY_Controller extends CI_Controller
{
    protected  $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
        $this->data['normalViewStream']=true;
    }
}