<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/14/14
 * Time: 4:11 PM
 * To change this template use File | Settings | File Templates.
 */

class SliderManagement extends MY_Controller
{
    private $viewDirectoryName="SliderManagement";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SliderModel');
        $this->load->model('LanguageModel');
        $this->imagesDestPath='images/slider/';
    }
    function index()
    {
        $data['slides']=$this->SliderModel->getAll();
        $this->load->template($this->viewDirectoryName.'/index',$data);
    }
    function create()
    {
        $data['languages']=$this->LanguageModel->getAll();
        $this->load->template($this->viewDirectoryName."/create",$data);
    }

    function insert()
    {
        $languageID=$this->input->post('languageID');
        $title=$this->input->post('title');
        $text=$this->input->post('text');

        //echo 'languageID:'.$languageID.',title:'.$title.',text:'.$text;
        $picturePath='';

        if(!empty($_FILES['userfile']['name']))
        {
            $picturePath=$this->do_upload($this->imagesDestPath);
            $this->resize($picturePath,150,125,true);
        }
        $slide=array('languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>$picturePath);
        if($this->SliderModel->insert($slide))
            redirect($this->viewDirectoryName.'/index');
    }
    function delete()
    {
        $slideID=$this->uri->segment(3);
        $ad=$this->SliderModel->get($slideID);
        $thumbPhoto=$this->generateThumbPhoto($ad->photo);
        unlink($ad->photo);
        unlink($thumbPhoto);
        $this->SliderModel->delete($slideID);
        redirect($this->viewDirectoryName.'/index');
    }
    function edit()
    {
        $slideID=$this->uri->segment(3);
        $data['slide']=$this->SliderModel->get($slideID);
        $data['languages']=$this->LanguageModel->getAll();
        $this->load->template($this->viewDirectoryName.'/edit',$data);
    }
    function update()
    {
        $id=$this->input->post('id',true);
        $languageID=$this->input->post('languageID',true);
        $title=$this->input->post('title',true);
        $text=$this->input->post('text',true);
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

        $slide=array('id'=>$id,'languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>$picturePath);
        $this->SliderModel->update($slide);
        redirect($this->viewDirectoryName.'/index');
    }
}