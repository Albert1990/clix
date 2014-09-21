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
	

	function index(){
		echo "this is deviceManagementModel";	
	}
	
}