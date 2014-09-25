<?php

/**
 * core/MY_Controller.php main controller that we will extend from
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

class MY_Controller  extends CI_Controller
{
    protected  $imagesDestPath='./images/';
    protected  $types=array(
            '1'     => 'int',
            '2'     => 'float',
            '3'     => 'string',
            'none'  => 'none'
        );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
    }

	
    public function do_upload($path)
    {
        $config['upload_path'] =$path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['max_width']  = '2000';
        $config['max_height']  = '2000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $d=$this->upload->data();
            return $path.$d['file_name'];
        }
    }
	
    public function resize($imgSourcePath,$width,$height,$createThumb)
    {
        //$picturePath=$this->do_upload($imgSourcePath);//$this->input->post('picturePath');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $imgSourcePath;
        $config['create_thumb'] = $createThumb;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

    }
    public function generateThumbPhoto($picturePath)
    {
        $thumbPicturePath=substr($picturePath,0,strlen($picturePath)-4).'_thumb'. substr($picturePath, -4);
        return $thumbPicturePath;
    }
	
    /**
     * check if current user is logged in
     *
     * this function isn't completed or tested yet 
     * 
     * @since          0.2  
     * @return bool    true or false
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
	function _is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if($is_logged_in)
            return true;
        else
            return false;
    }

    /**
     * check if current user is admin
     *
     * this function isn't completed or tested yet 
     * 
     * @since          0.2  
     * @return bool    true or false
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
    function _is_admin(){
        $user_id = $this->sessin->userdata('user_id');
        $user_permission = $this->userModel->get_user_permission($user_id);
        if($user_permission == 1)
            return true;
        return false;
    }

    /**
     * check if current user is the editor of the post
     *
     * this function isn't tested yet 
     * 
     * @since          0.2  
     * @return bool    true or false
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
    function _is_post_editor(){
        if($this->_is_admin())
            return TRUE;
        
        $post_id = $this->uri->segment(3);
        $user_id = $this->session->userdata('user_id');
        $post_editor = $this->userModel->get_item_publisher('post',$post_id);
        if($user_id == $post_editor)
            return TRUE;

        return false;
    }

    /**
     * check if current user is editor
     *
     * this function isn't completed or tested yet 
     * 
     * @since          0.2  
     * @return bool    true or false
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
    function _is_editor(){
         $user_id = $this->sessin->userdata('user_id');
        $user_permission = $this->userModel->get_user_permission($user_id);
        //<=2 admin is editor as well
        if($user_permission <= 2)
            return true;
        return false;
    }

    /**
     * check if current user is admin
     *
     * this function isn't completed or tested yet 
     * more privileges will be added
     * 
     * @since          0.2  
     * @param string   edit_post , edit_posts , view_cart
     * @return bool    true or false
     * @author Mohammed Manssour <manssour.mohammed@gmail.com>
     */
    function current_user_can($privileges){
        switch ($privileges) {
            case 'edit_post':
                $this->_is_editor();
                $this->_is_post_editor();
                break;
                
            case 'edit_posts':
                $this->_is_editor();
                break;
            
            default:
                # code...
                break;
        }
    }

}