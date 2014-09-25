<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * application/controllers/attributeUnitManagement.php main controller for managing device atributes types units
 * Copyright (C) 2008-2012 Brain Socker <berainsocket.com>
 *
 * LICENSE: this program isn't open source
 * you don't have the right to copy it,use it, download it or use some part of it without
 * permission
 *
 * @package Clix
 * @version 0.1
 * @author  Mohammed Manssour <manssour.mohammed@gmail.com>
 * @link    http://www.example.com
 */
class attributeUnitManagement extends MY_Controller
{
	private $viewDirectoryName="attributeUnitManagement";

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

		$data['units'] = $this->deviceModel->getAll('device-attribute-unit');
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

		$this->form_validation->set_rules('name', 'attribute unit name', 'trim|required');

		if ($this->form_validation->run() === FALSE){
			/*redirect to create page of the controller*/
			$this->create();
		}else{
			$name = $this->input->post('name');
			$q = $this->deviceModel->insert_new('device-attribute-unit',array('name'=>$name));

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

		if($this->deviceModel->get('device-attribute-unit',array('id'=>$post_id))){

			$q = $this->deviceModel->delete('device-attribute-unit',$post_id);

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

		$data['unit'] = $this->deviceModel->get('device-attribute-unit',array('id'=>$post_id));
		
		if($data['unit']){

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
		if($this->deviceModel->get('device-attribute-unit',array('id'=>$post_id))){

			$this->form_validation->set_rules('name','attribute unit name','trim|required');

			if($this->form_validation->run() == false){
				$this->edit($post_id);
			}else{
				
				$name = $this->input->post('name');
				$q = $this->deviceModel->update('device-attribute-unit',$post_id,	array('name'=>$name));

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
		

	

}