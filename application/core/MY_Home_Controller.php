<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 11/1/14
 * Time: 3:21 AM
 * To change this template use File | Settings | File Templates.
 */

class MY_Home_Controller extends CI_Controller
{
    protected  $imagesDestPath='./images/';
    protected $data;
    protected  $types=array(
        '1'     => 'int',
        '2'     => 'float',
        '3'     => 'string',
        'none'  => 'none'
    );

    public function __construct()
    {
        parent::__construct();
        $this->data['startPageView']='templates/start';
        $this->load->model('userModel');
    }

}