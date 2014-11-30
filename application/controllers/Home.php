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
    private $viewDirectoryName = "Home";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('deviceModel');
        $this->load->model('BrandModel');
    }

    function index()
    {
        $brandID = $this->uri->segment(3);
        $dbBrands = $this->BrandModel->getAll();
        $this->data['brands'] = $dbBrands;
        $numberOfDevicesPerShelf = $this->config->item('numberOfDevicesPerShelf');

        if ($brandID) {
            $dbDevices = $this->BrandModel->getDevices($brandID,30);
            $this->data['brands'] = $this->BrandModel->getAll();
            //var_dump($this->data['devices']);
            $shelvesCount = count($dbDevices) / $numberOfDevicesPerShelf;
            $counter = 0;
            for ($i = 0; $i < count($shelvesCount); $i++) {
                $shelfDevices = array();
                for ($j = 0; $j < $numberOfDevicesPerShelf; $j++) {

                    if (count($dbDevices) <= (($i * $numberOfDevicesPerShelf) + $j))
                        break;
                    $shelfDevices[$j] = $dbDevices[$counter];
                    $counter++;
                }
                $this->data['devices'][$i] = $shelfDevices;
            }
        } else {
            for ($i = 0; $i < count($dbBrands); $i++)
                $this->data['devices'][$i] = $this->BrandModel->getDevices($dbBrands[$i]->id,$numberOfDevicesPerShelf);
        }

        $this->load->template($this->viewDirectoryName . "/index", $this->data);
    }

    public function getDeviceOverview()
    {
        $deviceID = $this->input->post('deviceID', true);
        $deviceProps = $this->deviceModel->getDeviceOverview($deviceID);
        echo json_encode(array('deviceProps' => $deviceProps));
    }
}