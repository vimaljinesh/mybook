<?php
class GroupLib{
    
    public $objCi;
    
    public function __construct(){
        $this->objCi = & get_instance();
    }

    public function saveGroup($objGroup){
        $this->objCi->load->database();
        $this->objCi->db->trans_begin();
        
        try{
            
            foreach($objGroup as $objData){
                $strQuery = "select count(*) as count from groups where chr_type = '$objData->type' and 
                             bln_deleted is null and vchr_name = ? ";
                if($objData->id != ""){
                    $strQuery .= " and pk_group_id != ".$objData->id;
                }
                $objResult = $this->objCi->db->query($strQuery, array($objData->name))->row();
//                die($this->objCi->db->last_query());
                if($objResult->count != 0){
                    return "DUPLICATE";
                }
                
                $arrGroup = array(
                    "pk_group_id" => $objData->id,
                    "vchr_name" => $objData->name,
                    "chr_type" => $objData->type,
                    "bln_deleted" => null,
                );
                
                $this->objCi->db->replace('groups', $arrGroup);
            }
            
            $this->objCi->db->trans_commit();
            $strMessage = "SUCCESS";
        }
        catch(Exception $e){
            $this->objCi->db->trans_rollback();
            $strMessage = "FAILED";
        }
        
        return $strMessage;
    }
    
    public function getGroup($strMode = "G"){
        $this->objCi->load->database();
        $strQuery = "select * from groups where chr_type = '$strMode' and bln_deleted is null order by vchr_name";
        $objResult = $this->objCi->db->query($strQuery);
        
        $arrGroup = array();
        foreach ($objResult->result() as $objRow){
            $arrGroup[] = array(
                "id" => $objRow->pk_group_id,
                "name" => $objRow->vchr_name,
                "type" => $objRow->chr_type,
            );
        }
        
        return $arrGroup;
        
    }
    
    public function deleteGroup($intGroupId){
        $this->objCi->load->database();
//        $this->objCi->db->delete('groups', "pk_group_id = $intGroupId");
        $Result = $this->objCi->db->update('groups', array("bln_deleted" => 1),"pk_group_id = $intGroupId");
        $strMessage = "SUCCESS";
        return $strMessage;
    }
}
?>

