<?php
class LoginLib{
    
    public $objCi;
    
    public function __construct(){
        $this->objCi = & get_instance();
    }
    
    public function login($strUser, $strPassword){
        $this->objCi->load->database();
        $strQuery = "select * from user where vchr_user = ? and vchr_password = ?";
        $objResult = $this->objCi->db->query($strQuery, array($strUser, $strPassword));
        if($objResult->num_rows() == 1){
            $this->objCi->session->set_userdata("login", TRUE);
            return "SUCCESS";
        }
        else{
            return "INVALID";
        }
    }
    
    public function logout(){
        $this->objCi->load->helper('url');
        if($this->objCi->session->has_userdata('login')){
            $this->objCi->session->unset_userdata('login');
        }
        redirect('mybook/login');
    }
    
    public function isLogedIn(){
        $this->objCi->load->helper('url');
        if(!$this->objCi->session->has_userdata('login')){
            redirect('mybook/login', 'refresh');
        }
    }
}
?>