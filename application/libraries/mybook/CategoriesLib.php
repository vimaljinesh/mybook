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
            
            $arrCategory = array(
                "pk_categorie_id" => "7",
                "vchr_name" => "test'",
                "chr_type" => "S",
                "bln_deleted" => null,
            );
            
            $this->objCi->db->replace('categories', $arrCategory);
            
            $this->objCi->db->trans_commit();
        }
        catch(Exception $e){
            $this->objCi->db->trans_rollback();
        }
        
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
        $this->objCi->db->delete('categories', "pk_categorie_id = 7");
    }
}
?>

