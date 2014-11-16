<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/14/14
 * Time: 4:10 PM
 * To change this template use File | Settings | File Templates.
 */

class NewsManagement extends MY_Controller
{
    private $viewDirectoryName="NewsManagement";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NewsModel');
        $this->load->model('LanguageModel');
        $this->imagesDestPath='images/news/';
    }
    function index()
    {
        $this->data['news']=$this->NewsModel->getAll();
        $this->data['languages']=$this->LanguageModel->getAll();

        $this->load->template($this->viewDirectoryName.'/index',$this->data);
    }

    function create()
    {
        $this->data['languages']=$this->LanguageModel->getAll();
       
        if($this->data['languages'] === false){
            $this->data['languages'][1] = new stdClass();
            $this->data['languages'][1]->id = 1;
            $this->data['languages'][1]->name = 'english';
        }

        $this->load->template($this->viewDirectoryName."/create",$this->data);
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

        $news=array('languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>$picturePath);

        if($this->NewsModel->insert($news))
            redirect($this->viewDirectoryName.'/index');
    }

    function delete()
    {
        $newsID=$this->uri->segment(3);
        $news=$this->NewsModel->get($newsID);
        $thumbPhoto=$this->generateThumbPhoto($news->photo);
        unlink($news->photo);
        unlink($thumbPhoto);
        $this->NewsModel->delete($newsID);
        redirect($this->viewDirectoryName.'/index');
    }
    function edit()
    {
        $newsID=$this->uri->segment(3);
        $this->data['news']=$this->NewsModel->get($newsID);
        $this->data['languages']=$this->LanguageModel->getAll();
        $this->load->template($this->viewDirectoryName.'/edit',$this->data);
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

        $news=array('id'=>$id,'languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>$picturePath);
        $this->NewsModel->update($news);
        redirect($this->viewDirectoryName.'/index');

    }
}