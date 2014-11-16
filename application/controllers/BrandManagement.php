<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/14/14
 * Time: 3:58 PM
 * To change this template use File | Settings | File Templates.
 */

class BrandManagement extends MY_Controller
{
    private $viewDirectoryName="BrandManagement";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('BrandModel');
        $this->imagesDestPath='images/brands/';
    }
    function index()
    {
        $this->data['brands']=$this->BrandModel->getAll();
        $this->load->template($this->viewDirectoryName.'/index',$this->data);
    }
    function create()
    {
        $this->load->template($this->viewDirectoryName."/create",$this->data);
    }

    function insert()
    {
        $name=$this->input->post('name');
        $picturePath='';
        if(!empty($_FILES['userfile']['name']))
        {
            $picturePath=$this->do_upload($this->imagesDestPath);
            $this->resize($picturePath,150,125,true);
        }
        $brand=array('name'=>$name,'photo'=>$picturePath);
        if($this->BrandModel->insert($brand))
        {
            redirect($this->viewDirectoryName.'/index');
        }
    }
    function delete()
    {
        $brandID=$this->uri->segment(3);
        $brand=$this->BrandModel->get($brandID);
        $thumbPhoto=$this->generateThumbPhoto($brand->photo);
        unlink($brand->photo);
        unlink($thumbPhoto);
        $this->BrandModel->delete($brandID);
        redirect($this->viewDirectoryName.'/index');
    }
    function edit()
    {
        $brandID=$this->uri->segment(3);
        $this->data['brand']=$this->BrandModel->get($brandID);
        $this->load->template($this->viewDirectoryName.'/edit',$this->data);
    }
    function update()
    {
        $id=$this->input->post('id');
        $name=$this->input->post('name');

        $oldPicPath=$this->input->post('oldPicPath',true);

        $picturePath='';

        if (empty($_FILES['userfile']['name']))
        {
            //echo 'no photo';
            $picturePath=$oldPicPath;
        }
        else
        {
            //echo 'has photo';
            if(file_exists($oldPicPath))
                unlink($oldPicPath);
            $picturePath=$this->do_upload($this->imagesDestPath);
            $this->resize($picturePath,150,125,true);
        }

        $updatedBrand=array('id'=>$id,'name'=>$name,'photo'=>$picturePath);
        $this->BrandModel->update($updatedBrand);
        redirect($this->viewDirectoryName.'/index');
    }
}