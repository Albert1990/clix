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
		$select = 'device.id,device.name,device.photo,device-type.name as typeName,brand.name as brandName,device.date';
		$data['devices'] = $this->deviceModel->getAll('device',$table_to_join,$select);
		$this->load->template($this->viewDirectoryName.'/index.php',$data); 
	}

	function create(){

		$brands = $this->deviceModel->getAll('brand');
		if($brands){
			foreach ($brands as $brand) {
				$data['brands'][$brand->id]=$brand->name; 
			}
		}
		
		$devices = $this->deviceModel->getAll('device-type');
		if($devices){
			foreach ($devices as $device) {
				$data['devices'][$device->id] = $device->name;
			}
		}

		$this->load->template($this->viewDirectoryName."/create.php",$data);
	}
	
	function insert_1(){
		$this->form_validation->set_rules('deviceName','device Name','trim|required');

		if($this->form_validation->run() == false){

			$this->create();

		}else{
			$values = array(
					'name' 			=> $this->input->post('deviceName'),
					'deviceTypeID'	=> $this->input->post('deviceType'),
					'brandID'		=> $this->input->post('deviceBrand'),
					'date'			=> date('Y-m-d'),
				);

	        if(!empty($_FILES['userfile']['name'])){
	            $values['photo']=$this->do_upload($this->imagesDestPath);
	            $this->resize($values['photo'],150,125,true);
	        }

	        $q = $this->deviceModel->insert_new('device',$values);
	        if($q){
	        	$action_message = array(
	        			'css_class' => 'alert alert-success',
	        			'msg'		=> 'step1 has done successfully',
	        		);

	        	/*get last entry the one the we have just entered*/
	        	$last_entry = $this->deviceModel->get_last();

	        	/**
	        	* move to phase two
	        	* pahse two must have the id of the device and it's type to get the correct attributes
	        	*/

	        	$this->step_2($action_message,$last_entry->id,$last_entry->deviceTypeID);
	        }else{
	        	$action_message = array(
	        			'css_class'	 => 'alert alert-danger',
	        			'msg'		 => 'an error occured',
	        		);
	        	$this->index($action_message);
	        }
		}
	}


	function step_2($action_message,$id,$deviceTypeID){
		if(!$action_message){
			$action_message = array(
					'css_class' 	=> 'alert alert-danger',
					'msg'			=> 'you\'re not allowed to do this action',
				);
			$this->index($action_message);
		}else{

			$table_to_join = array(
					array(
							'table_name' => 'device-attribute',
							'col_2' => 'device-attribute.id',
							'col_1' => 'deviceAttributeID',
						),
					array(
							'table_name'	=> 'device-attribute-unit',
							'col_2'			=> 'device-attribute-unit.id',
							'col_1'			=> 'deviceAttributeUnitID'
						)
				);

			
			$data['deviceID'] = $id;

			$select = 'device-attribute.id,device-attribute.enName,device-attribute.arName,device-attribute-unit.name,device-attribute.attributeType';
			$data['attributes'] = $this->deviceModel->getAll('device-attribute-type',$table_to_join,$select,array('deviceTypeID'=>$deviceTypeID));

			$this->load->template($this->viewDirectoryName."/step_2.php",$data);
		}
	}


	function insert_final(){
		$attributes = $this->input->post('attribute');
		$deviceID = $this->input->post('deviceID');
		if(is_array($attributes)){
			foreach ($attributes as $attr) {
				$values = array(
					'deviceID' 			=> $deviceID,
					'deviceAttributeID' => $attr['id'],
					'value'				=> $attr['value'],
				);
				$q = $this->deviceModel->insert_new('device-property',$values);

				if(!$q)
					break;
			}
		}

		if($q){
			$action_message = array(
					'css_class'	=> 'alert alert-success',
					'msg'	=> 'inserting is done successfully',
				);
		}else{
			$action_message = array(
					'css_class'	=> 'alert alert-danger',
					'msg'	=> 'an error occured',
				);
		}

		$this->index($action_message);
	}


	function edit(){

		$device_id = $this->uri->segment(3);

		$data['device'] = $this->deviceModel->get('device',array('id'=>$device_id));

		if($data['device']){

			$brands = $this->deviceModel->getAll('brand');
			if($brands){
				foreach ($brands as $brand) {
					$data['brands'][$brand->id]=$brand->name; 
				}
			}
			
			$devices = $this->deviceModel->getAll('device-type');
			if($devices){
				foreach ($devices as $device) {
					$data['devices'][$device->id] = $device->name;
				}
			}


			/*getting labels*/
			
			$data['attributes'] = $this->deviceModel->excute_query("SELECT `device-property`.`id` as property_id,`device-attribute`.`id`, `device-attribute`.`enName`, `device-attribute`.`arName`, `device-attribute-unit`.`name`, `device-attribute`.`attributeType`,`device-property`.`value` FROM (`device-attribute-type`) JOIN `device-attribute` ON `deviceAttributeID`=`device-attribute`.`id` JOIN `device-attribute-unit` ON `deviceAttributeUnitID`=`device-attribute-unit`.`id` JOIN `device-property` ON `device-attribute`.`id`=`device-property`.`deviceAttributeID` WHERE `deviceTypeID` = ".$data['device']->deviceTypeID ." AND `device-property`.`deviceID`=".$data['device']->id);

			$this->load->template($this->viewDirectoryName.'/edit',$data);

		}else{
			$action_message = array(
							'css_class' => 'alert-error',
							'msg' 		=>  'you\'re not allowed to do this action' ,
						);
			$this->index($action_message);
		}



	}


	function update(){

		$deviceID = $this->input->post('id');
		$this->form_validation->set_rules('deviceName','device name','trim|required');

		if($this->form_validation->run() === false){
			$this->edit();
		}else{
			$values = array(
					'name' 			=> $this->input->post('deviceName'),
					'deviceTypeID'	=> $this->input->post('deviceType'),
					'brandID'		=> $this->input->post('deviceBrand'),
					'date'			=> date('Y-m-d'),
				);

			$oldPicPath=$this->input->post('oldPicPath',true);

	        if (!empty($_FILES['userfile']['name'])){
	            //echo 'has photo';
	            if(file_exists($oldPicPath))
	                unlink($oldPicPath);
	            $values['photo']=$this->do_upload($this->imagesDestPath);
	            $this->resize($values['photo'],150,125,true);
	        }

	        $q = $this->deviceModel->update('device',$deviceID,$values);
	        if(!$q){
	        	$action_message = array(
					'css_class'	=> 'alert alert-danger',
					'msg'	=> 'an error occured',
				);
				$this->index($action_message);
	        }



	        /*updating labels*/
	        $attributes = $this->input->post('attribute');
			if(is_array($attributes)){
				foreach ($attributes as $attr) {
					$values = array(
						'deviceID' 			=> $deviceID,
						'deviceAttributeID' => $attr['id'],
						'value'				=> $attr['value'],
					);
					$q = $this->deviceModel->update('device-property',$attr['property_id'],$values);

					if(!$q)
						break;
				}
			}

			if($q){
				$action_message = array(
						'css_class'	=> 'alert alert-success',
						'msg'	=> 'inserting is done successfully',
					);
			}else{
				$action_message = array(
						'css_class'	=> 'alert alert-danger',
						'msg'	=> 'an error occured',
					);
			}


			$this->index($action_message);

		}


		
	}



	function delete(){
		$deviceID = $this->uri->segment(3);

		if($this->deviceModel->get('device',array('id'=>$deviceID))){
			$q = $this->deviceModel->delete('device',$deviceID);

			$f = $this->deviceModel->delete('device-property',array('deviceID'=>$deviceID));
			if($q){
				$action_message = array(
					'css_class'	=> 'alert alert-success',
					'msg'	=> 'deleting has done successfully',
				);
			}else{
				$action_message = array(
					'css_class'	=> 'alert alert-danger',
					'msg'	=> 'an error occured',
				);
			}
		}else{
			$action_message = array(
					'css_class'	=> 'alert alert-error',
					'msg'	=> 'you\'re not allowed to do this action',
				);
				
		}
		$this->index($action_message);
	}



	function _generate_field($id,$type,$value = '',$property_id = null){
		$rand = rand(0,1000);
		echo '<input type="hidden" name="attribute['.$rand.'][id]"  value="'.$id.'" />';
		if(!is_null($property_id)){
			echo '<input type="hidden" name="attribute['.$rand.'][property_id]"  value="'.$property_id.'" />';
		}
		switch ($type) {
			case '1':
				echo '<input type="number" name="attribute['.$rand.'][value]"  value="'.$value.'" />';
				
				break;

			case '2':
				echo '<input type="number" name="attribute['.$rand.'][value]"  value="'.$value.'" />';
				break;

			case '3':
				echo '<input type="text" name="attribute['.$rand.'][value]"  value="'.$value.'" />';
				break;
			
			default:
				# code...
				break;
		}
	}
	
}