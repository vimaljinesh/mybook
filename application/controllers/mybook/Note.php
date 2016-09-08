<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note extends CI_Controller {
    
    public function saveNote(){
        $this->load->library("mybook/NoteLib");
        $objNote = json_decode($this->input->post('strNote'));
        $arrResult = $this->notelib->saveNote($objNote);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getNote(){
        $this->load->library("mybook/NoteLib");
        $objSearchData = json_decode($this->input->post('strSearchData'));
        $strWhere = "";
        if($objSearchData->name != ""){
            $strWhere .= " and n.vchr_name like '%".addslashes($objSearchData->name)."%' ";
        }
        if($objSearchData->category != ""){
            $strWhere .= " and n.fk_category_id = $objSearchData->category ";
        }
        if($objSearchData->subcategory != ""){
            $strWhere .= " and n.fk_sub_category_id = $objSearchData->subcategory ";
        }
        $arrResult = $this->notelib->getNote($strWhere);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function deleteNote(){
        $this->load->library("mybook/NoteLib");
        $intNoteId = $this->input->post('intNoteId');
        $arrResult = $this->notelib->deleteNote($intNoteId);
        $this->commonlib->sendJson($arrResult);
    }
    
}
?>