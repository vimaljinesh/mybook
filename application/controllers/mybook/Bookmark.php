<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookmark extends CI_Controller {
    
    public function saveBookmark(){
        $this->load->library("mybook/BookmarkLib");
        $objBookmark = json_decode($this->input->post('strBookmark'));
        $arrResult = $this->bookmarklib->saveBookmark($objBookmark);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getBookmark(){
        $this->load->library("mybook/BookmarkLib");
        $objSearchData = json_decode($this->input->post('strSearchData'));
        $strWhere = "";
        if($objSearchData->name != ""){
            $strWhere .= " and b.vchr_name like '%".addslashes($objSearchData->name)."%' ";
        }
        if($objSearchData->category != ""){
            $strWhere .= " and b.fk_category_id = $objSearchData->category ";
        }
        if($objSearchData->subcategory != ""){
            $strWhere .= " and b.fk_sub_category_id = $objSearchData->subcategory ";
        }
        $arrResult = $this->bookmarklib->getBookmark($strWhere);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function deleteBookmark(){
        $this->load->library("mybook/BookmarkLib");
        $intBookmarkId = $this->input->post('intBookmarkId');
        $arrResult = $this->bookmarklib->deleteBookmark($intBookmarkId);
        $this->commonlib->sendJson($arrResult);
    }
    
}
?>