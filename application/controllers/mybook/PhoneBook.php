<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhoneBook extends CI_Controller {
    
    public function savePhoneBook(){
        $this->load->library("mybook/PhoneBookLib");
        $objPhoneBook = json_decode($this->input->post('strPhoneBook'));
        $arrResult = $this->phonebooklib->savePhoneBook($objPhoneBook);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getPhoneBook(){
        $this->load->library("mybook/PhoneBookLib");
        $arrResult = $this->phonebooklib->getPhoneBook();
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