<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Albert
 * Date: 10/18/14
 * Time: 7:03 AM
 * To change this template use File | Settings | File Templates.
 */

class User extends MY_Controller
{
    private $viewDirectoryName='User';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->imagesDestPath='images/user/';
    }

    public function create()
    {
        $this->load->template($this->viewDirectoryName.'/create',$this->data);
    }
    public function register()
    {
        $userName=$this->input->post('userName',true);
        $password=md5($this->input->post('password',true));
        $email=$this->input->post('email',true);

        $user=array('userName'=>$userName,'password'=>$password,'email'=>$email);
        $this->data['normalView']=false;
        if($this->UserModel->insert($user))
            redirect('user/registerSuccess');
    }
    public function login($msg=null)
    {
        $this->data['normalViewStream']=false;
        $this->data['msg']=$msg;
        $this->load->template($this->viewDirectoryName.'/login',$this->data);
    }
    public function signin()
    {
        $email=$this->input->post('email',true);
        $password=md5($this->input->post('password',true));

        $dbUser=$this->UserModel->getUser($email,$password);
        if($dbUser)
        {
            $userData=array('userId'=>$dbUser->id,
            'userName'=>$dbUser->userName,
            'validate'=>true);
            var_dump($userData);
            $this->session->set_userdata($userData);
            redirect('/Home/index');
        }
        else
            $this->login("<h2 class='error'>email or password is wrong</h2>");
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('User/login');
    }
}