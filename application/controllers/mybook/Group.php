<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {
    
    public function saveGroup(){
        $this->load->library("mybook/GroupLib");
        $objGroup = json_decode($this->input->post('strGroup'));
        $arrResult = $this->grouplib->saveGroup($objGroup);
        $this->commonlib->sendJson($arrResult);
    }
    
    public function getGroup(){
        $this->load->library("mybook/GroupLib");
        $arrResult = $this->grouplib->getGroup();
        $this->commonlib->sendJson($arrResult);
    }
    
    public function deleteGroup(){
        $this->load->library("mybook/GroupLib");
        $intGroupId = $this->input->post('intGroupId');
        $arrResult = $this->grouplib->deleteGroup($intGroupId);
        $this->commonlib->sendJson($arrResult);
    }
    
}
?>