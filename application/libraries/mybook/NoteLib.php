<?php
class NoteLib{
    
    public $objCi;
    
    public function __construct(){
        $this->objCi = & get_instance();
    }

    public function saveNote($objNote){
        $this->objCi->load->database();
        $this->objCi->db->trans_begin();
        
        try{
            
            $strQuery = "select count(*) as count from notes where  
                         bln_deleted is null and vchr_name = ? ";
            if($objNote->id != ""){
                $strQuery .= " and pk_note_id != ".$objNote->id;
            }
            $objResult = $this->objCi->db->query($strQuery, array($objNote->name))->row();
//                die($this->objCi->db->last_query());
            if($objResult->count != 0){
                return "DUPLICATE";
            }

            $arrNote = array(
                "pk_note_id" => $objNote->id,
                "vchr_name" => $objNote->name,
                "fk_category_id" => $objNote->category,
                "fk_sub_category_id" => $objNote->subcategory,
                "txt_note" => $objNote->note,
                "bln_deleted" => null,
            );

            $this->objCi->db->replace('notes', $arrNote);
            $intId = $this->objCi->db->insert_id();
            
            $this->objCi->db->trans_commit();
            $strMessage = "SUCCESS";
        }
        catch(Exception $e){
            $this->objCi->db->trans_rollback();
            $strMessage = "FAILED";
        }
        
        return array("Message" => $strMessage, "intId"=> $intId);
    }
    
    public function getNote($strWhere = ""){
        $this->objCi->load->database();
        $strQuery = "select n.*, c.vchr_name as category, sc.vchr_name as subcategory from notes n 
                     left join categories c
                     on c.pk_categorie_id = n.fk_category_id
                     left join categories sc
                     on sc.pk_categorie_id = n.fk_sub_category_id
                     where n.bln_deleted is null $strWhere order by vchr_name";
        $objResult = $this->objCi->db->query($strQuery);
        
        $arrNote = array();
        foreach ($objResult->result() as $objRow){
            $arrNote[] = array(
                "id" => $objRow->pk_note_id,
                "name" => $objRow->vchr_name,
                "category" => $objRow->fk_category_id,
                "category_name" => $objRow->category,
                "subcategory" => $objRow->fk_sub_category_id,
                "subcategory_name" => $objRow->subcategory,
                "note" => $objRow->txt_note,
            );
        }
        
        return $arrNote;
        
    }
    
    public function deleteNote($intNoteId){
        $this->objCi->load->database();
//        $this->objCi->db->delete('groups', "pk_note_id = $intNoteId");
        $Result = $this->objCi->db->update('notes', array("bln_deleted" => 1),"pk_note_id = $intNoteId");
        $strMessage = "SUCCESS";
        return $strMessage;
    }
}
?>

