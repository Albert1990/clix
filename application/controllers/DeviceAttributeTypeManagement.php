<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * application/controllers/DeviceAttributeTypeManagement.php main controller for managing device atributes
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
class DeviceAttributeTypeManagement extends MY_Controller
{
	private $viewDirectoryName="DeviceAttributeTypeManagement";

	function __construct(){
		parent::__construct();
        $this->load->model('deviceModel');
        $this->load->model('LanguageModel');
	}
	
	/**
     * index page for deviceType Management
     *
     * completed & tested
     * 
     * @since          0.2  
     * @param  array   message when an action done and redirected to index
     * @return bool    load->view
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
	function index($message = array()){

		if(is_array($message) && !empty($message)){
			$this->data['message'] = $message;
		}

		$tables_to_join = array(
				array(
						'table_name'=> 'device-attribute',
						'col_2'		=> 'device-attribute.id',
						'col_1'		=> 'deviceAttributeID',
					),
				array(
						'table_name' => 'device-type',
						'col_2'	=> 'device-type.id',
						'col_1'	=> 'deviceTypeID',
					),
			);
		$select = 'device-attribute-type.id,device-type.name,device-attribute.enName,device-attribute.arName';
		$this->data['items'] = $this->deviceModel->getAll('device-attribute-type',$tables_to_join,$select);
		$this->load->template($this->viewDirectoryName.'/index.php',$this->data);
	}

	/**
     * insert new element in the database
     *
     * completed & tested
     * 
     * @since          0.2  
     * @return bool    load->view
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
	function create(){

		$attributes = $this->deviceModel->getAll('device-attribute');
		if($attributes){
			foreach ($attributes as $attr) {
				$this->data['attributes'][$attr->id] = $attr->enName;	
			}

		}

		$devices = $this->deviceModel->getAll('device-type');
		if($devices){
			foreach ($devices as $device) {
				$this->data['devices'][$device->id] = $device->name;
			}
		}

		$this->load->template($this->viewDirectoryName.'/create.php',$this->data);
	}


	/**
     * insert new element in the database
     *
     * completed & tested
     * 
     * @since          0.2  
     * @return bool    load->view
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
	function insert(){

		$device = $this->input->post('device');
		$attributes = $this->input->post('attributes');
		if($attributes && is_array($attributes) && !empty($attributes)){
			$attributes = array_unique($attributes);

			foreach ($attributes as $attr) {
				$values = array(
						'deviceTypeID' 		=> $device,
						'deviceAttributeID'	=> $attr,
					);
				$q = $this->deviceModel->insert_new('device-attribute-type',$values);
				if(!$q)
					break;
			}
		}

		if($q){
			/*the message that will be shown to the user when the action is done*/
			$action_message = array(
					'css_class' => 'alert-success',
					'msg' 		=>  'inserting is done successfully',
				);
		}else{
			$action_message = array(
					'css_class' => 'alert-danger',
					'msg' 		=>  'an error occured',
				);
		}
			

		$this->index($action_message);
		
		
	}


	/**
     * delete the type
     *
     * completed & tested
     * 
     * @since          0.2  
     * @return bool    load->view
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
	function delete(){
		$post_id = $this->uri->segment(3);

		if($this->deviceModel->get('device-attribute-type',array('id'=>$post_id))){

			$q = $this->deviceModel->delete('device-attribute-type',$post_id);

			if($q){
				/*the message that will be shown to the user when the action is done*/
					$action_message = array(
							'css_class' => 'alert-success',
							'msg' 		=>  'deleteing is done successfully',
						);
			}else{
				$action_message = array(
							'css_class' => 'alert-danger',
							'msg' 		=>  'an error occured',
						);
			}

		}else{
			$action_message = array(
							'css_class' => 'alert-error',
							'msg' 		=>  'you\'re not allowed to do this action' ,
						);
		}

		$this->index($action_message);
	}


	function edit($post_id = null){
		
		if(is_null($post_id)){
			$post_id = $this->uri->segment(3);
		}

		$this->data['item'] = $this->deviceModel->get('device-attribute-type',array('id'=>$post_id));
		
		if($this->data['item']){

			$devices = $this->deviceModel->getAll('device-type');
			if($devices){
				foreach ($devices as $device) {
					$this->data['devices'][$device->id] = $device->name;	
				}
			}

			$attributes = $this->deviceModel->getAll(' device-attribute');
			if($attributes){
				foreach ($attributes as $attr) {
					$this->data['attributes'][$attr->id] = $attr->enName;
				}
			}

			$this->load->template($this->viewDirectoryName.'/edit.php',$this->data);

		}else{
			$action_message = array(
							'css_class' => 'alert-error',
							'msg' 		=>  'you\'re not allowed to do this action' ,
						);
			$this->index($action_message);
		}

		
	}

	function update(){
		$post_id = $this->input->post('id');
		
		/* checking if the id belong to database */
		if($this->deviceModel->get('device-attribute-type',array('id'=>$post_id))){


				
				$values = array(
					
					'deviceAttributeID' 	=> $this->input->post('attributes'),
					'deviceTypeID' 			=> $this->input->post('device'),
				);
				$q = $this->deviceModel->update('device-attribute-type',$post_id,$values);

				if($q){
					/*the message that will be shown to the user when the action is done*/
					$action_message = array(
						'css_class' => 'alert-success',
						'msg' 		=>  'updating is done successfully',
					);
					
				}else{
					$action_message = array(
						'css_class' => 'alert-error',
						'msg' 		=>  'an error occured',
					);

				}
			
		}else{
			$action_message = array(
						'css_class' => 'alert-error',
						'msg' 		=>  'you\'re not allowed to do this action',
					);

		}
		
		$this->index($action_message);
		

	}

}