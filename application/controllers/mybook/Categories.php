<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function saveCategory($objCategory){
        $this->load->library("mybook/CategoriesLib");
    }
    
    public function getCategory($strMode){
        $this->load->library("mybook/CategoriesLib");
        $this->categorieslib->getCategory();
    }
    
    public function deleteCategory(){
        $this->load->library("mybook/CategoriesLib");
    }
    
}
?>