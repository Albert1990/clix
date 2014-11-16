<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * application/controllers/attributeTyoeManagement.php main controller for managing device atributes types
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
class attributeTypeManagement extends MY_Controller
{
	private $viewDirectoryName="attributeTypeManagement";

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

		$this->data['types'] = $this->deviceModel->getAll('attribute-type');
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

			$type = $this->input->post('type');
			$q = $this->deviceModel->insert_new('attribute-type',array('type'=>$type));

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

		if($this->deviceModel->get('attribute-type',array('id'=>$post_id))){
			$q = $this->deviceModel->delete('attribute-type',$post_id);

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

		$this->data['type'] = $this->deviceModel->get('attribute-type',array('id'=>$post_id));
		
		if($this->data['type']){

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
		if($this->deviceModel->get('attribute-type',array('id'=>$post_id))){

			$type = $this->input->post('type');

			$q = $this->deviceModel->update('attribute-type',$post_id,	array('type'=>$type));

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

		}else{
			$action_message = array(
					'css_class' => 'alert-error',
					'msg' 		=>  'you\'re not allowed to do this action' ,
				);
		}

		$this->index($action_message);
	}
		

	

}