<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 11/1/14
 * Time: 4:40 AM
 * To change this template use File | Settings | File Templates.
 */

class Home extends MY_Controller
{
    private $viewDirectoryName='Home';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['hello']='hi iam samer';
        $this->data['normalViewStream']=false;
        $this->load->template($this->viewDirectoryName.'/index',$this->data);
    }

}