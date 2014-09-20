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
    public function koko()
    {
        echo URL.'lib/bootstrap/css/bootstrap.css';
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BrandModel');
        $this->imagesDestPath='images/brands/';
    }
    function index()
    {
        $data['brands']=$this->BrandModel->getAll();
        $this->load->template('Brand/index',$data);
    }
    function create()
    {
        $this->load->template("Brand/create");
    }

    function insert()
    {
        $name=$this->input->post('name');
        $picturePath='';
        if(!empty($_FILES['userfile']['name']))
        {
            $picturePath=$this->do_upload($this->imagesDestPath);
            $this->resize($picturePath,150,125);
        }
        $brand=array('name'=>$name,'photo'=>$picturePath);
        if($this->BrandModel->insert($brand))
        {
            redirect('BrandManagement/index');
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
        redirect('BrandManagement/index');
    }
    function edit()
    {
        $brandID=$this->uri->segment(3);
        $data['brand']=$this->BrandModel->get($brandID);
        $this->load->view('Brand/edit',$data);
    }
    function update()
    {
        $id=$this->input->post('id');
        $name=$this->input->post('name');

        $updatedBrand=array('id'=>$id,'name'=>$name,'photo'=>'');
        $this->BrandModel->update($updatedBrand);
    }
}