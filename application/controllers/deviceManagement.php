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
		$where = 'device-type.id !='.$this->accessoire_field_id;
		$data['devices'] = $this->deviceModel->getAll('device',$table_to_join,$select,$where);
		$this->load->template($this->viewDirectoryName.'/index.php',$data); 
	}

	function create(){

		/*inof of the devices stored in session*/
		$data['stored_sess_info'] = $this->session ->all_userdata();
		
		

		$brands = $this->deviceModel->getAll('brand');
		if($brands){
			foreach ($brands as $brand) {
				$data['brands'][$brand->id]=$brand->name; 
			}
		}
		$where = 'id !='.$this->accessoire_field_id;
		$devices = $this->deviceModel->getAll('device-type',null,null,$where);
		if($devices){
			foreach ($devices as $device) {
				$data['devices'][$device->id] = $device->name;
			}
		}

		$this->load->template($this->viewDirectoryName."/create.php",$data);
	}
	
	function insert_step_1(){
		$this->form_validation->set_rules('deviceName','device Name','trim|required');

		if($this->form_validation->run() == false){

			$this->create();

		}else{
			$stored_sess_info = array(
					'deviceName' 			=> $this->input->post('deviceName'),
					'deviceTypeID'	=> $this->input->post('deviceType'),
					'brandID'		=> $this->input->post('deviceBrand'),
					'date'			=> date('Y-m-d'),
					'devicePhoto'	=> '',
				);
				
			

	        if(!empty($_FILES['userfile']['name'])){
	           $stored_sess_info['devicePhoto'] = $this->do_upload($this->imagesDestPath);
	            $this->resize($stored_sess_info['devicePhoto'],150,125,true);
	        }
	        

	       	$this->session->set_userdata($stored_sess_info);
	        

	        /**
	        * move to phase two
	        * pahse two must have the id of the device and it's type to get the correct attributes
	        */
	       $action_message = array(
					'css_class' 	=> 'alert alert-success',
					'msg'			=> 'step 1 has done seccessfully now you must enter device specification',
				);

	        $this->step_2($action_message);
	        
	        
		}
	}


	function step_2($action_message){
		if(!$action_message){
			$action_message = array(
					'css_class' 	=> 'alert alert-danger',
					'msg'			=> 'you\'re not allowed to do this action',
				);
			$this->index($action_message);
		}else{
			$data['message'] = $action_message;
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

			$data['stored_sess_info'] = $this->session->all_userdata();

			$select = 'device-attribute.id,device-attribute.enName,device-attribute.arName,device-attribute-unit.name,device-attribute.attributeType';
			$data['attributes'] = $this->deviceModel->getAll('device-attribute-type',$table_to_join,$select,array('deviceTypeID'=>$data['stored_sess_info']['deviceTypeID']));

			$this->load->template($this->viewDirectoryName."/step_2.php",$data);
		}
	}

	function insert_step_2(){
		
		$attributes = $this->input->post('attribute');



		$this->session->set_userdata('attributes',serialize($attributes));
	        

	        /**
	        * move to phase two
	        * pahse two must have the id of the device and it's type to get the correct attributes
	        */
	       $action_message = array(
					'css_class' 	=> 'alert alert-success',
					'msg'			=> 'step 2 has done seccessfully now you must enter device specification',
				);

	        $this->step_3($action_message);

	}

	function step_3($action_message){
		if(!$action_message){
			$action_message = array(
					'css_class' 	=> 'alert alert-danger',
					'msg'			=> 'you\'re not allowed to do this action',
				);
		}else{
			$data['stored_sess_info'] = $this->session->all_userdata(); 
			$this->load->template($this->viewDirectoryName."/step_3.php",$data);
		}
		
	}

	/**
	 * this function was added for security
	 * 
	 */
	function move_to_step_2(){
		/*it's not empty and it's not an array so the message will not apear*/
		$this->step_2('s');
	}

	function insert_final(){
		$stored_sess_info = $this->session->all_userdata();
		$values = array(
				'name'			=> $stored_sess_info['deviceName'],
				'deviceTypeID' 	=> $stored_sess_info['deviceTypeID'],
				'brandID'		=> $stored_sess_info['brandID'],
				'date'			=> $stored_sess_info['date'],
				'photo' 		=> $stored_sess_info['devicePhoto']
			);
		$q = $this->deviceModel->insert_new('device',$values);

		$deviceID = $this->deviceModel->get_last()->id;
		if($deviceID && $q){
			/*inserting attributes*/
			$attributes = @unserialize($stored_sess_info['attributes']);
			if($attributes && is_array($attributes)){
				foreach ($attributes as $attr) {
					$values = array(
						'deviceID' => $deviceID,
						'deviceAttributeID' => $attr['id'],
						'value'	=> $attr['value'], 
					);
					$f = $this->deviceModel->insert_new('device-property',$values);
					if(!$f)
						break;
				}
			}


			/*inserting device for sale*/
			$values = array(
					'date' => date('Y-m-d'),
					'price' => $this->input->post('price'),
					'isNew' => $this->input->post('isNew'),
					'state' => $this->input->post('state'),
					'deviceID' => $deviceID,
				);
			$d = $this->deviceModel->insert_new('device-for-sale',$values);

			if($q && $d){
				$action_message = array(
					'css_class' 	=> 'alert alert-success',
					'msg'			=> 'inserting has done successfully',
				);
			}else{
				$action_message = array(
					'css_class' 	=> 'alert alert-error',
					'msg'			=> 'inserting not done successfully',
				);
			}
		}else{
			 $action_message = array(
					'css_class' 	=> 'alert alert-danger',
					'msg'			=> 'inserting not done successfully',
				);
		}

		$this->unset_sess_info();
		$this->index($action_message);
	}

	function cancel_inserting(){

		$this->unset_sess_info();

		$this->index();
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
			$where = 'id !='.$this->accessoire_field_id;
			$devices = $this->deviceModel->getAll('device-type',null,null,$where);
			if($devices){
				foreach ($devices as $device) {
					$data['devices'][$device->id] = $device->name;
				}
			}


			/*getting labels*/
			
			$data['attributes'] = $this->deviceModel->excute_query("SELECT `device-property`.`id` as property_id,`device-attribute`.`id`, `device-attribute`.`enName`, `device-attribute`.`arName`, `device-attribute-unit`.`name`, `device-attribute`.`attributeType`,`device-property`.`value` FROM (`device-attribute-type`) JOIN `device-attribute` ON `deviceAttributeID`=`device-attribute`.`id` JOIN `device-attribute-unit` ON `deviceAttributeUnitID`=`device-attribute-unit`.`id` JOIN `device-property` ON `device-attribute`.`id`=`device-property`.`deviceAttributeID` WHERE `deviceTypeID` = ".$data['device']->deviceTypeID ." AND `device-property`.`deviceID`=".$data['device']->id);

			$data['status'] = $this->deviceModel->get('device-for-sale',array('deviceId'=>$data['device']->id));

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


			/*updating device stats*/
			$values = array(
					'price' => $this->input->post('price'),
					'isNew' => $this->input->post('isNew'),
					'state' => $this->input->post('state'),
				);
			$q = $this->deviceModel->update('device-for-sale',$this->input->post('recoed_id'),$values);


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

			$d = $this->deviceModel->delete('device-for-sale',array('deviceID'=>$deviceID));
			
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
		echo '<input type="hidden" name="attribute['.$id.'][id]"  value="'.$id.'" />';
		if(!is_null($property_id)){
			echo '<input type="hidden" name="attribute['.$id.'][property_id]"  value="'.$property_id.'" />';
		}
		switch ($type) {
			case '1':
				echo '<input type="number" name="attribute['.$id.'][value]"  value="'.$value.'" />';
				
				break;

			case '2':
				echo '<input type="number" name="attribute['.$id.'][value]"  value="'.$value.'" />';
				break;

			case '3':
				echo '<input type="text" name="attribute['.$id.'][value]"  value="'.$value.'" />';
				break;
			
			default:
				# code...
				break;
		}
	}


	function _check_value($value,$key = ''){
		if(is_array($value) && in_array($key,array_keys($value)))
			return $value[$key];
		if(!is_array($value) && !empty($value) && !is_null($value) && isset($value) && $value != '')
			return $value;
		return '';
	}

	function unset_sess_info(){
		$this->session->unset_userdata('stored_sess_info');
		$this->session->unset_userdata('deviceName');
		$this->session->unset_userdata('deviceTypeID');
		$this->session->unset_userdata('brandID');
		$this->session->unset_userdata('date');
		$this->session->unset_userdata('devicePhoto');
		$this->session->unset_userdata('attributes');
	}

	
	
}