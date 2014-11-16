<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/20/14
 * Time: 11:23 AM
 * To change this template use File | Settings | File Templates.
 */

class Home extends MY_Controller
{
    private $viewDirectoryName="NewsManagement";

    public function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->data['lastDevices']=$this->deviceModel->getLastDevices();
        $dbBrands=$this->BrandModel->getAll();
//        foreach($dbBrands as $dbBrand)
//        {
//            $this->data[$dbBrand->]
//        }
        $this->data['nokiaDevices']=$this->deviceModel->getDevicesRelated2Brand($this->getBrandID($dbBrands,'Nokia'));
        $this->data['samsungDevices']=$this->deviceModel->getDevicesRelated2Brand($this->getBrandID($dbBrands,'Samsung'));
        $this->data['Iphone']=$this->deviceModel->getDevicesRelated2Brand($this->getBrandID($dbBrands,'Iphone'));
        $this->load->template($this->viewDirectoryName."/index",$this->data);
    }
    private function getBrandID($brands,$brandName)
    {
        foreach($brands as $brand)
        {
            if($brand->name==$brandName)
                return $brand->id;
        }
    }
    public function getDevicesRelated2Brand()
    {
        $brandId=$this->input->post('brandId');
        $devices=$this->deviceModel->getDevicesRelated2Brand($brandId);
        echo json_encode($devices);
    }
}