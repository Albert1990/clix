<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 11/30/14
 * Time: 5:10 PM
 * To change this template use File | Settings | File Templates.
 */

class Brand extends MY_Controller
{
    private $viewDirectoryName="Brand";

    function __construct(){
        parent::__construct();
        $this->load->model('BrandModel');
    }
    function index()
    {
        $brandID=$this->uri->segment(3);
        $numberOfDevicesPerShelf=$this->config->item('numberOfDevicesPerShelf');
        $dbDevices=$this->BrandModel->getDevices($brandID);
        $this->data['brands']=$this->BrandModel->getAll();
        //var_dump($this->data['devices']);
        $shelvesCount=count($dbDevices)/$numberOfDevicesPerShelf;
        $counter=0;
        for($i=0;$i<count($shelvesCount);$i++)
        {
            $shelfDevices=array();
            for($j=0;$j<$numberOfDevicesPerShelf;$j++)
            {

                if(count($dbDevices)<=(($i*$numberOfDevicesPerShelf)+$j))
                    break;
                $shelfDevices[$j]=$dbDevices[$counter];
                $counter++;
            }
            $this->data['devices'][$i]=$shelfDevices;
        }
        $this->load->template($this->viewDirectoryName."/index",$this->data);
    }
}