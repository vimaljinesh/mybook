<?php
class CategoriesLib{
    
    public $objCi;
    
    public function __construct(){
        $this->objCi = & get_instance();
    }

    public function saveCategory($objCategory){
        $this->objCi->load->database();
        $this->objCi->db->trans_begin();
        
        try{
            
            foreach($objCategory as $objData){
                $strQuery = "select count(*) as count from categories where chr_type = '$objData->type' and 
                             bln_deleted is null and vchr_name = ? ";
                if($objData->id != ""){
                    $strQuery .= " and pk_categorie_id != ".$objData->id;
                }
                $objResult = $this->objCi->db->query($strQuery, array($objData->name))->row();
//                die($this->objCi->db->last_query());
                if($objResult->count != 0){
                    return "DUPLICATE";
                }
                
                $arrCategory = array(
                    "pk_categorie_id" => $objData->id,
                    "vchr_name" => $objData->name,
                    "chr_type" => $objData->type,
                    "bln_deleted" => null,
                );
                
                $this->objCi->db->replace('categories', $arrCategory);
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
    
    public function getCategory($strMode = "C"){
        $this->objCi->load->database();
        $strQuery = "select * from categories where chr_type = '$strMode' and bln_deleted is null order by vchr_name";
        $objResult = $this->objCi->db->query($strQuery);
        
        $arrCategories = array();
        foreach ($objResult->result() as $objRow){
            $arrCategories[] = array(
                "id" => $objRow->pk_categorie_id,
                "name" => $objRow->vchr_name,
                "type" => $objRow->chr_type,
            );
        }
        
        return $arrCategories;
        
    }
    
    public function deleteCategory($intCategoryId){
        $this->objCi->load->database();
//        $this->objCi->db->delete('categories', "pk_categorie_id = 7");
        $Result = $this->objCi->db->update('categories', array("bln_deleted" => 1),"pk_categorie_id = $intCategoryId");
        $strMessage = "SUCCESS";
        return $strMessage;
    }
}
?>

