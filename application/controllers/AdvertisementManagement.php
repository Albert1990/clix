<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 9/14/14
 * Time: 3:58 PM
 * To change this template use File | Settings | File Templates.
 */

class AdvertisementManagement extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdvertisementModel');
        $this->load->model('LanguageModel');
        $this->imagesDestPath='images/ads/';
    }
    function index()
    {
        $data['ads']=$this->AdvertisementModel->getAll();
        $data['languages']=$this->LanguageModel->getAll();
        $this->load->template('Advertisement/index',$data);
    }
    function create()
    {
        $data['languages']=$this->LanguageModel->getAll();
        $this->load->template("Advertisement/create",$data);
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
        $advertisement=array('languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>$picturePath);
        if($this->AdvertisementModel->insert($advertisement))
            redirect('AdvertisementManagement/index');
    }
    function delete()
    {
        $advertisementID=$this->uri->segment(3);
        $ad=$this->AdvertisementModel->get($advertisementID);
        $thumbPhoto=$this->generateThumbPhoto($ad->photo);
        unlink($ad->photo);
        unlink($thumbPhoto);
        $this->AdvertisementModel->delete($advertisementID);
        redirect('AdvertisementManagement/index');
    }
    function edit()
    {
        $advertisementID=$this->uri->segment(3);
        $data['advertise']=$this->AdvertisementModel->get($advertisementID);
        $this->load->template('Advertisement/edit',$data);
    }
    function update()
    {
        $id=$this->input->post('id',true);
        $languageID=$this->input->post('languageID',true);
        $title=$this->input->post('title',true);
        $text=$this->input->post('text',true);


        $advertisement=array('id'=>$id,'languageID'=>$languageID,'title'=>$title,'text'=>$text,'photo'=>'');
        $this->AdvertisementModel->update($advertisement);
        redirect('AdvertisementManagement/index');

    }
}