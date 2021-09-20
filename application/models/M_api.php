<?php

class M_api extends CI_Model {
    
    
    public function get_data($table,$whr=array()){
        
        return json_encode($this->db->select("uuid")->get_where($table,$whr)->result());
    
    }


    public function insert_device($uuid, $lang, $uid, $os, $appid, $clientToken) {
        $insert_user_stored_proc = "CALL insert_device(?, ?, ?, ?, ?,?)";
        $data = array('uuid' => $uuid, 'uid' => $uid, 'appid' => $appid, 'lang' => $lang, 'os' => $os, 'client_token' => $clientToken );
        

        $result = $this->db->query($insert_user_stored_proc, $data);

        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function insert_purchase_reqs($clientToken, $receiptHash, $date, $expireDate) {
        $insert_user_stored_proc = "CALL insert_purchase_reqs( ?, ? , ?, ? )";
        $data = array('client_token' => $clientToken, 'receipt_hash' => $receiptHash, 'activity_date' => $date, 'expire_date' => $expireDate);
        

        $result = $this->db->query($insert_user_stored_proc, $data);

        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    } 


    public function check_lang($langid) {
        $insert_user_stored_proc = "CALL check_lang(?)";
        $data = array('langid' => $langid);

        $result = $this->db->query($insert_user_stored_proc, $data);
        return $result;

    }

    public function	check_uuid($uuid){
        $insert_user_stored_proc = "CALL check_uuid(?)";
        $data = array('uuid' => $uuid);

        $result = $this->db->query($insert_user_stored_proc, $data);
        return $result;
    }
    

}

