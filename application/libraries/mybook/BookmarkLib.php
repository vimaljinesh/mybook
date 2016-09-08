<?php
class BookmarkLib{
    
    public $objCi;
    
    public function __construct(){
        $this->objCi = & get_instance();
    }

    public function saveBookmark($objBookmark){
        $this->objCi->load->database();
        $this->objCi->db->trans_begin();
        
        try{
            
            $strQuery = "select count(*) as count from book_marks where  
                         bln_deleted is null and vchr_name = ? ";
            if($objBookmark->id != ""){
                $strQuery .= " and pk_bookmark_id != ".$objBookmark->id;
            }
            $objResult = $this->objCi->db->query($strQuery, array($objBookmark->name))->row();
//                die($this->objCi->db->last_query());
            if($objResult->count != 0){
                return "DUPLICATE";
            }

            $arrBookmark = array(
                "pk_bookmark_id" => $objBookmark->id,
                "vchr_name" => $objBookmark->name,
                "vchr_url" => $objBookmark->url,
                "fk_category_id" => $objBookmark->category,
                "fk_sub_category_id" => $objBookmark->subcategory,
                "vchr_description" => $objBookmark->description,
                "bln_deleted" => null,
            );

            $this->objCi->db->replace('book_marks', $arrBookmark);
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
    
    public function getBookmark($strWhere = ""){
        $this->objCi->load->database();
        $strQuery = "select b.*, c.vchr_name as category, sc.vchr_name as subcategory from book_marks b 
                     left join categories c
                     on c.pk_categorie_id = b.fk_category_id
                     left join categories sc
                     on sc.pk_categorie_id = b.fk_sub_category_id
                     where b.bln_deleted is null $strWhere order by vchr_name";
        $objResult = $this->objCi->db->query($strQuery);
        
        $arrBookmark = array();
        foreach ($objResult->result() as $objRow){
            $arrBookmark[] = array(
                "id" => $objRow->pk_bookmark_id?$objRow->pk_bookmark_id:"",
                "name" => $objRow->vchr_name?$objRow->vchr_name:"",
                "url" => $objRow->vchr_url?$objRow->vchr_url:"",
                "category" => $objRow->fk_category_id?$objRow->fk_category_id:"",
                "category_name" => $objRow->category?$objRow->category:"",
                "subcategory" => $objRow->fk_sub_category_id?$objRow->fk_sub_category_id:"",
                "subcategory_name" => $objRow->subcategory?$objRow->subcategory:"",
                "description" => $objRow->vchr_description?$objRow->vchr_description:"",
            );
        }
        
        return $arrBookmark;
        
    }
    
    public function deleteBookmark($intBookmarkId){
        $this->objCi->load->database();
//        $this->objCi->db->delete('groups', "pk_bookmark_id = $intBookmarkId");
        $Result = $this->objCi->db->update('book_marks', array("bln_deleted" => 1),"pk_bookmark_id = $intBookmarkId");
        $strMessage = "SUCCESS";
        return $strMessage;
    }
}
?>

