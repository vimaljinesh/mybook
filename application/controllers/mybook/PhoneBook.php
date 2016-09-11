<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhoneBook extends CI_Controller {
    
    function __construct(){
       parent::__construct();
       $this->loginlib->isLogedIn();
    }
    
    public function savePhoneBook(){
        $this->load->library("mybook/PhoneBookLib");
        $objPhoneBook = json_decode($this->input->post('strPhoneBook'));
        $arrResult = $this->phonebooklib->savePhoneBook($objPhoneBook);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getPhoneBook(){
        $this->load->library("mybook/PhoneBookLib");
        $objSearchData = json_decode($this->input->post('strSearchData'));
        $strWhere = "";
        if($objSearchData->name != ""){
            $strWhere .= " and pm.vchr_name like '%".addslashes($objSearchData->name)."%' ";
        }
        if($objSearchData->group != ""){
            $strWhere .= " and pm.fk_group_id = $objSearchData->group ";
        }
        if($objSearchData->subgroup != ""){
            $strWhere .= " and pm.fk_sub_group_id = $objSearchData->subgroup ";
        }
        $arrResult = $this->phonebooklib->getPhoneBook($strWhere);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getPhoneBookData(){
        $this->load->library("mybook/PhoneBookLib");
        $intId = $this->input->post('intId');
        $arrResult = $this->phonebooklib->getPhoneBookData($intId);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function deletePhoneBook(){
        $this->load->library("mybook/PhoneBookLib");
        $intPhoneBookId = $this->input->post('intPhoneBookId');
        $arrResult = $this->phonebooklib->deletePhoneBook($intPhoneBookId);
        $this->commonlib->sendJson($arrResult);
    }
    
}
?>