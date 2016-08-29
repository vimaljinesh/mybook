<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mybook extends CI_Controller {
    
    public function index(){
        $this->load->helper('url');
        $this->load->library("mybook/CategoriesLib");
        
        $arrCategories = $this->categorieslib->deleteCategory("");
        $arrCategories = $this->categorieslib->getCategory();
        $arrSubCategories = $this->categorieslib->getCategory("S");
        $this->load->view('mybook/template/mybook_view', array(
            "arrCategories" => $arrCategories,
            "arrSubCategories" => $arrSubCategories,
        ));
    }
}
?>