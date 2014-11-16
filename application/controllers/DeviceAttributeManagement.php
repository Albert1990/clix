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
 * @author  samer shatta <@example.com>
 * @author  Mohammed Manssour <manssour.mohammed@gmail.com>
 * @link    http://www.jawsaqLabs.com
 */
class DeviceAttributeManagement extends MY_Controller
{
	private $viewDirectoryName="DeviceAttributeManagement";
	

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
						'table_name'=> 'device-attribute-unit',
						'col_2'		=> 'device-attribute-unit.id',
						'col_1'		=> 'deviceAttributeUnitID',
					),
				
			);
		$select = 'device-attribute.id,arName,enName,attributeType,device-attribute-unit.name';
		$this->data['attrs'] = $this->deviceModel->getAll('device-attribute',$tables_to_join,$select);
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

		$units = $this->deviceModel->getAll('device-attribute-unit');
		if($units){
			foreach ($units as $unit) {
				$this->data['units'][$unit->id] = $unit->name;	
			}

		}

		$this->data['types'] = $this->types;

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

		$this->form_validation->set_rules('enName', 'english Name', 'trim|required');
		$this->form_validation->set_rules('arName', 'arabic Name', 'trim|required');

		if ($this->form_validation->run() === FALSE){
			/*redirect to create page of the controller*/
			$this->create();
		}else{
			$values = array(
					'enName' 					=> $this->input->post('enName'),
					'arName' 					=> $this->input->post('arName'),
					'deviceAttributeUnitID' 	=> $this->input->post('attributeUnitID'),
					'attributeType' 			=> $this->input->post('attributeTypeID'),
				);

			$q = $this->deviceModel->insert_new('device-attribute',$values);

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

		if($this->deviceModel->get('device-attribute',array('id'=>$post_id))){

			$q = $this->deviceModel->delete('device-attribute',$post_id);

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

		$this->data['attribute'] = $this->deviceModel->get('device-attribute',array('id'=>$post_id));
		
		if($this->data['attribute']){

			$units = $this->deviceModel->getAll('device-attribute-unit');
			if($units){
				foreach ($units as $unit) {
					$this->data['units'][$unit->id] = $unit->name;	
				}
			}

		$this->data['types'] = $this->types;

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
		if($this->deviceModel->get('device-attribute',array('id'=>$post_id))){

			$this->form_validation->set_rules('enName', 'english Name', 'trim|required');
			$this->form_validation->set_rules('arName', 'arabic Name', 'trim|required');

			if($this->form_validation->run() == false){
				$this->edit($post_id);
			}else{
				
				$values = array(
					'enName' 					=> $this->input->post('enName'),
					'arName' 					=> $this->input->post('arName'),
					'deviceAttributeUnitID' 	=> $this->input->post('attributeUnitID'),
					'attributeType' 			=> $this->input->post('attributeTypeID'),
				);
				$q = $this->deviceModel->update('device-attribute',$post_id,$values);

				if($q){
					/*the message that will be shown to the user when the action is done*/
					$action_message = array(
						'css_class' => 'alert-success',
						'msg' 		=>  'deleteing is done successfully',
					);
					
				}else{
					$action_message = array(
						'css_class' => 'alert-error',
						'msg' 		=>  'an error occured',
					);

				}
			}
		}else{
			$action_message = array(
						'css_class' => 'alert-error',
						'msg' 		=>  'you\'re not allowed to do this action',
					);

		}
		
		$this->index($action_message);
		

	}


	function _generate_type($type){
		switch ($type) {
			case 1:
				return 'int';
				break;

			case 2:
				return 'float';
				break;

			case 3:
				return 'string';
				break;
			
			default:
				return 'none';
				break;
		}
	}

}