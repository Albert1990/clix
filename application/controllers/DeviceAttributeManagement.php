<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * application/controllers/DeviceAttributeManagement.php main controller for managing device atributes
 * Copyright (C) 2008-2012 Brain Socker <berainsocket.com>
 *
 * LICENSE: this program isn't open source
 * you don't have the right to copy it,use it, download it or use some part of it without
 * permission
 *
 * @package Clix
 * @version 0.1
 * @author  samer shatta <email@example.com>
 * @author  Mohammed Manssour <manssour.mohammed@gmail.com>
 * @link    http://www.example.com
 */
class DeviceAttributeManagement extends MY_Controller
{
	function __construct(){
		parent::__construct();
        $this->load->model('deviceModel');
        $this->load->model('LanguageModel');
        $this->imagesDestPath='images/news/';
	}
}