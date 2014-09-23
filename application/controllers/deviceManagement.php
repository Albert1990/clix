<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * application/controllers/deviceManagement.php main controller for managing device atributes
 * Copyright (C) 2008-2012 Brain Socker <berainsocket.com>
 *
 * LICENSE: this program isn't open source
 * you don't have the right to copy it,use it, download it or use some part of it without
 * permission
 *
 * @package Clix
 * @version 0.1
 * @author  Mohammed Manssour <manssour.mohammed@gmail.com>
 * @link    http://www.jawsaqLabs.com
 */
class deviceManagement extends MY_Controller{

	private $viewDirectoryName="deviceManagement";
	
	function __construct(){
		parent::__construct();
        $this->load->model('deviceModel');
        $this->load->model('LanguageModel');
        $this->imagesDestPath='images/devices/';
	}
	

	/**
     * index page of this department site
     *
     * under testing 
     *
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
	function index(){
		
		$table_to_join = array(
				array(
						'table_name' => 'device-type',
						'col_1'		 => 'device.deviceTypeID',
						'col_2'		 => 'device-type.id',
					),
				array(
						'table_name' => 'brand',
						'col_1'		 => 'device.brandID',
						'col_2'		 => 'brand.id',
					),
			);
		$data['devices'] = $this->deviceModel->getAll('device',$table_to_join);
		$this->load->template($this->viewDirectoryName.'/index.php',$data); 
	}

	function create(){
		$this->load->template($this->viewDirectoryName."/create.php");
	}
	
}