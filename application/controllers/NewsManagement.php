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
        $data['news']=$this->NewsModel->getAll();
        $data['languages']=$this->LanguageModel->getAll();
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
            $this->resize($picturePath,150,125);
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
        $data['news']=$this->NewsModel->get($newsID);
        $this->load->template($this->viewDirectoryName.'/edit',$data);
    }
    function update()
    {
        $id=$this->input->post('id',true);
        $languageID=$this->input->post('languageID',true);
        $title=$this->input->post('title',true);
        $text=$this->input->post('text',true);


        $news=array('id'=>$id,'languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>'');
        $this->AdvertisementModel->update($news);
        redirect($this->viewDirectoryName.'/index');

    }
}