<?php
class PhoneBookLib{
    
    public $objCi;
    
    public function __construct(){
        $this->objCi = & get_instance();
    }

    public function savePhoneBook($objPhoneBook){
        $this->objCi->load->database();
        $this->objCi->db->trans_begin();
        
        try{
            
            $strQuery = "select count(*) as count from phone_book_master where  
                         bln_deleted is null and vchr_name = ? ";
            if($objPhoneBook->id != ""){
                $strQuery .= " and pk_phone_book_master_id != ".$objPhoneBook->id;
            }
            $objResult = $this->objCi->db->query($strQuery, array($objPhoneBook->name))->row();
//                die($this->objCi->db->last_query());
            if($objResult->count != 0){
                return "DUPLICATE";
            }

            $arrPhoneBook = array(
                "pk_phone_book_master_id" => $objPhoneBook->id,
                "vchr_name" => $objPhoneBook->name,
                "fk_group_id" => $objPhoneBook->group,
                "fk_sub_group_id" => $objPhoneBook->subgroup,
                "vchr_address" => $objPhoneBook->address,
                "vchr_description" => $objPhoneBook->description,
                "bln_deleted" => null,
            );

            $this->objCi->db->replace('phone_book_master', $arrPhoneBook);
            $intId = $this->objCi->db->insert_id();
            
            $this->objCi->db->delete('phone_book_sub', "fk_phone_book_master_id = $intId");
            
            foreach($objPhoneBook->phone as $objData){
                $arrPhoneBook = array(
                    "fk_phone_book_master_id" => $intId,
                    "vchr_type" => "phone",
                    "vchr_value" => $objData,
                );
                $this->objCi->db->replace('phone_book_sub', $arrPhoneBook);
            }
            foreach($objPhoneBook->mobile as $objData){
                $arrPhoneBook = array(
                    "fk_phone_book_master_id" => $intId,
                    "vchr_type" => "mobile",
                    "vchr_value" => $objData,
                );
                $this->objCi->db->replace('phone_book_sub', $arrPhoneBook);
            }
            foreach($objPhoneBook->email as $objData){
                $arrPhoneBook = array(
                    "fk_phone_book_master_id" => $intId,
                    "vchr_type" => "email",
                    "vchr_value" => $objData,
                );
                $this->objCi->db->replace('phone_book_sub', $arrPhoneBook);
            }
            foreach($objPhoneBook->fax as $objData){
                $arrPhoneBook = array(
                    "fk_phone_book_master_id" => $intId,
                    "vchr_type" => "fax",
                    "vchr_value" => $objData,
                );
                $this->objCi->db->replace('phone_book_sub', $arrPhoneBook);
            }
            
            $this->objCi->db->trans_commit();
            $strMessage = "SUCCESS";
        }
        catch(Exception $e){
            $this->objCi->db->trans_rollback();
            $strMessage = "FAILED";
        }
        
        return array("Message" => $strMessage, "intId"=> $intId);
    }
    
    public function getPhoneBook($strWhere = ""){
        $this->objCi->load->database();
        $strQuery = "select pm.*, g.vchr_name as `group`, sg.vchr_name as subgroup,
                     (select a.vchr_value from phone_book_sub a where a.bln_deleted is null and a.fk_phone_book_master_id = pm.pk_phone_book_master_id and a.vchr_type = 'phone' order by pk_phone_book_sub limit 1) as phone,
                     (select a.vchr_value from phone_book_sub a where a.bln_deleted is null and a.fk_phone_book_master_id = pm.pk_phone_book_master_id and a.vchr_type = 'mobile' order by pk_phone_book_sub limit 1) as mobile,
                     (select a.vchr_value from phone_book_sub a where a.bln_deleted is null and a.fk_phone_book_master_id = pm.pk_phone_book_master_id and a.vchr_type = 'email' order by pk_phone_book_sub limit 1) as email,
                     (select a.vchr_value from phone_book_sub a where a.bln_deleted is null and a.fk_phone_book_master_id = pm.pk_phone_book_master_id and a.vchr_type = 'fax' order by pk_phone_book_sub limit 1) as fax
                     from phone_book_master pm 
                     left join groups g
                     on g.pk_group_id = pm.fk_group_id
                     left join groups sg
                     on sg.pk_group_id = pm.fk_sub_group_id
                     where pm.bln_deleted is null $strWhere order by vchr_name";
        $objResult = $this->objCi->db->query($strQuery);
        
        $arrPhoneBook = array();
        foreach ($objResult->result() as $objRow){
            $arrPhoneBook[] = array(
                "id" => $objRow->pk_phone_book_master_id?$objRow->pk_phone_book_master_id:"",
                "name" => $objRow->vchr_name?$objRow->vchr_name:"",
                "group" => $objRow->fk_group_id?$objRow->fk_group_id:"",
                "group_name" => $objRow->group?$objRow->group:"",
                "subgroup" => $objRow->fk_sub_group_id?$objRow->fk_sub_group_id:"",
                "subgroup_name" => $objRow->subgroup?$objRow->subgroup:"",
                "phone" => $objRow->phone?$objRow->phone:"",
                "mobile" => $objRow->mobile?$objRow->mobile:"",
                "email" => $objRow->email?$objRow->email:"",
                "fax" => $objRow->fax?$objRow->fax:"",
                "address" => $objRow->vchr_address?$objRow->vchr_address:"",
                "description" => $objRow->vchr_description?$objRow->vchr_description:"",
            );
        }
        
        return $arrPhoneBook;
        
    }
    
    public function deletePhoneBook($intPhoneBookId){
        $this->objCi->load->database();
//        $this->objCi->db->delete('groups', "pk_phone_book_master_id = $intPhoneBookId");
        $Result = $this->objCi->db->update('phone_book_master', array("bln_deleted" => 1),"pk_phone_book_master_id = $intPhoneBookId");
        $strMessage = "SUCCESS";
        return $strMessage;
    }
    
    public function getPhoneBookData($intPhoneBookId){
        $this->objCi->load->database();
        $strQuery = "select pm.*, g.vchr_name as `group`, sg.vchr_name as subgroup
                     from phone_book_master pm 
                     left join groups g
                     on g.pk_group_id = pm.fk_group_id
                     left join groups sg
                     on sg.pk_group_id = pm.fk_sub_group_id
                     where pm.bln_deleted is null and pm.pk_phone_book_master_id = $intPhoneBookId 
                     order by vchr_name";
        $objResult = $this->objCi->db->query($strQuery)->row();
        
        $arrPhoneBook = array(
                "id" => $objResult->pk_phone_book_master_id?$objResult->pk_phone_book_master_id:"",
                "name" => $objResult->vchr_name?$objResult->vchr_name:"",
                "group" => $objResult->fk_group_id?$objResult->fk_group_id:"",
                "group_name" => $objResult->group?$objResult->group:"",
                "subgroup" => $objResult->fk_sub_group_id?$objResult->fk_sub_group_id:"",
                "subgroup_name" => $objResult->subgroup?$objResult->subgroup:"",
                "phone" => "",
                "mobile" => "",
                "email" => "",
                "fax" => "",
                "address" => $objResult->vchr_address?$objResult->vchr_address:"",
                "description" => $objResult->vchr_description?$objResult->vchr_description:"",
            );
        
        $strQuery = "select a.* from phone_book_sub a 
                    where a.bln_deleted is null 
                    and a.fk_phone_book_master_id = $intPhoneBookId
                    order by pk_phone_book_sub";
        $objResult = $this->objCi->db->query($strQuery);
        
        $arrPhoneBookData = array();
        foreach ($objResult->result() as $objRow){
            if($objRow->vchr_type == "phone"){
                $arrPhoneBookData["phone"][] = $objRow->vchr_value;
            }
            if($objRow->vchr_type == "mobile"){
                $arrPhoneBookData["mobile"][] = $objRow->vchr_value;
            }
            if($objRow->vchr_type == "email"){
                $arrPhoneBookData["email"][] = $objRow->vchr_value;
            }
            if($objRow->vchr_type == "fax"){
                $arrPhoneBookData["fax"][] = $objRow->vchr_value;
            }
        }
        
        $arrPhoneBook["phone"] = isset($arrPhoneBookData["phone"])?$arrPhoneBookData["phone"]:array("");
        $arrPhoneBook["mobile"] = isset($arrPhoneBookData["mobile"])?$arrPhoneBookData["mobile"]:array("");
        $arrPhoneBook["email"] = isset($arrPhoneBookData["email"])?$arrPhoneBookData["email"]:array("");
        $arrPhoneBook["fax"] = isset($arrPhoneBookData["fax"])?$arrPhoneBookData["fax"]:array("");
        
        return $arrPhoneBook;
    }
}
?>

