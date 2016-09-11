<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function index(){
        $this->load->helper('url');
        $this->load->library("mybook/LoginLib");
        $this->load->view('mybook/template/login', array("arrBaseUrl" => site_url()));
    }
    
    public function userLogin(){
        $this->load->library("mybook/LoginLib");
        $strUser = $this->input->post('user');
        $strPassword = $this->input->post('password');
        $arrResult = $this->loginlib->login($strUser, $strPassword);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function logout(){
        $this->load->library("mybook/LoginLib");
        $this->loginlib->logout();
    }
    
}

?>