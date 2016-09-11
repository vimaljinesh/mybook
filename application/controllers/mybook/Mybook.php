<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mybook extends CI_Controller {
    
    function __construct(){
       parent::__construct();
       $this->loginlib->isLogedIn();
    }
    
    public function index(){
        $this->load->helper('url');
        $this->load->library("mybook/CategoriesLib");
        $this->load->library("mybook/GroupLib");
        $this->load->library("mybook/BookmarkLib");
        $this->load->library("mybook/NoteLib");
        $this->load->library("mybook/PhoneBookLib");
        
        $arrCategories = $this->categorieslib->getCategory();
        $arrSubCategories = $this->categorieslib->getCategory("S");
        
        $arrGroups = $this->grouplib->getGroup();
        $arrSubGroups = $this->grouplib->getGroup("S");
        
        $arrBookMark = $this->bookmarklib->getBookmark();
        $arrNote = $this->notelib->getNote();
        $arrPhoneBook = $this->phonebooklib->getPhoneBook();
        
        $this->load->view('mybook/template/mybook_view', array(
            "arrCategories" => $arrCategories,
            "arrSubCategories" => $arrSubCategories,
            "arrGroups" => $arrGroups,
            "arrSubGroups" => $arrSubGroups,
            
            "arrBookMark" => $arrBookMark,
            "arrNote" => $arrNote,
            "arrPhoneBook" => $arrPhoneBook,
            
            "arrBaseUrl" => site_url(),
        ));
    }
    
    public function getGroupAndCategory(){
        $this->load->library("mybook/CategoriesLib");
        $this->load->library("mybook/GroupLib");
        
        $arrCategories = $this->categorieslib->getCategory();
        $arrSubCategories = $this->categorieslib->getCategory("S");
        $arrGroups = $this->grouplib->getGroup();
        $arrSubGroups = $this->grouplib->getGroup("S");
        
        $arrResult = array(
            "arrCategories" => $arrCategories,
            "arrSubCategories" => $arrSubCategories,
            "arrGroups" => $arrGroups,
            "arrSubGroups" => $arrSubGroups
        );
        
        $this->commonlib->sendJson($arrResult);
    }
}
?>