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
        $arrResult = $this->notelib->getNote();
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