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
        $arrResult = $this->bookmarklib->getBookmark();
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