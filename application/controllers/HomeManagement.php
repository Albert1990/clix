<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/28/14
 * Time: 10:29 AM
 * To change this template use File | Settings | File Templates.
 */

class HomeManagement extends MY_Controller
{
    private $viewDirectoryName="HomeManagement";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdvertisementModel');
        $this->load->model('LanguageModel');
        $this->imagesDestPath='images/ads/';
    }

    function index()
    {
        $this->load->template($this->viewDirectoryName.'/index',$this->data);
    }

}