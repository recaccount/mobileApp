<?php

class M_api extends CI_Model {
    
    
    public function get_data($table,$whr=array()){
        
        return json_encode($this->db->select("uuid")->get_where($table,$whr)->result());
    
    }


    public function insert($uuid, $lang, $uid, $os, $appId) {
        $insert_user_stored_proc = "CALL insert_device(?, ?, ?, ?, ?)";
        $data = array('uuid' => $uuid, 'lang' => $lang, 'uid' => $uid, 'os' => $os, 'appId' => $appId);


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

