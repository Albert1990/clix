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
class deviceTypeManagement extends MY_Controller
{
	private $viewDirectoryName="deviceTypeManagement";

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
			$data['message'] = $message;
		}

		$data['types'] = $this->deviceModel->getAll('device-type');
		$this->load->template($this->viewDirectoryName.'/index.php',$data);
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
		$this->load->template($this->viewDirectoryName.'/create.php');
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

		$this->form_validation->set_rules('name', 'Type name', 'trim|required');

		if ($this->form_validation->run() === FALSE){
			/*redirect to create page of the controller*/
			$this->create();
		}else{
			$name = $this->input->post('name');
			$q = $this->deviceModel->insert_new('device-type',array('name'=>$name));

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

		if($this->deviceModel->get('device-type',array('id'=>$post_id))){

			$q = $this->deviceModel->delete('device-type',$post_id);

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

		$data['type'] = $this->deviceModel->get('device-type',array('id'=>$post_id));
		
		if($data['type']){

			/*getting all attributes*/
			$attrs = $this->deviceModel->getAll('device-attribute');
			if($attrs){
				foreach ($attrs as $attr) {
					$data['attributes'][$attr->id] = $attr->enName;
				}
			}



			/*selecting device Attributes*/

			$table_to_join = array(
					array(
							'table_name' => 'device-attribute',
							'col_1' => 'deviceAttributeID',
							'col_2'	=> 'device-attribute.id'
						)
				);
			$select = 'device-attribute.id,device-attribute.enName';
			$data['deviceAttributes'] = $this->deviceModel->getAll('device-attribute-type',$table_to_join,$select,array('deviceTypeID'=>$data['type']->id));

			$this->load->template($this->viewDirectoryName.'/edit.php',$data);

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
		if($this->deviceModel->get('device-type',array('id'=>$post_id))){

			$this->form_validation->set_rules('name','device type name','trim|required');

			if($this->form_validation->run() == false){
				$this->edit($post_id);
			}else{
				
				$name = $this->input->post('name');
				$q = $this->deviceModel->update('device-type',$post_id,	array('name'=>$name));

				$attributes = $this->input->post('attributes'); 
				if(isset($attributes) && is_array($attributes)){
					$attributes = array_unique($this->input->post('attributes'));
				}else{
					$attributes = array();
				}
				

				/*delete all old attrs for the deviceType*/
				$q_deletion = $this->deviceModel->delete('device-attribute-type',array('deviceTypeID'=>$post_id));
				/*if deletion has done successfully*/
				if($q_deletion){
					$values = array('deviceTypeID'=>$post_id);
					foreach ($attributes as $attr) {
						$values['deviceAttributeID'] = $attr;
						$q_inserting = $this->deviceModel->insert_new('device-attribute-type',$values);
						if(!$q_inserting){
							/*the message that will be shown to the user when the action is done*/
							$action_message = array(
								'css_class' => 'alert-error',
								'msg' 		=>  'an error occured1',
							);
							break;	
						}
					}

					if($q_inserting){
						$action_message = array(
								'css_class' => 'alert-success',
								'msg' 		=>  'updating is done successfully',
							);
					}
							

							
						

				}else{
					$action_message = array(
							'css_class' => 'alert-error',
							'msg' 		=>  'an error occured',
						);
				}//else deletion

			}//else validation



		}else{
			$action_message = array(
						'css_class' => 'alert-error',
						'msg' 		=>  'you\'re not allowed to do this action',
					);

		}

		$this->index($action_message);
		

	}

}