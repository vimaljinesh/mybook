<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function saveCategory(){
        $this->load->library("mybook/CategoriesLib");
        $objCategory = json_decode($this->input->post('strCategory'));
        $arrResult = $this->categorieslib->saveCategory($objCategory);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getCategory(){
        $this->load->library("mybook/CategoriesLib");
        $arrResult = $this->categorieslib->getCategory();
        $this->commonlib->sendJson($arrResult);
    }
    
    public function deleteCategory(){
        $this->load->library("mybook/CategoriesLib");
        $intCategoryId = $this->input->post('intCategoryId');
        $arrResult = $this->categorieslib->deleteCategory($intCategoryId);
        $this->commonlib->sendJson($arrResult);
    }
    
}
?>