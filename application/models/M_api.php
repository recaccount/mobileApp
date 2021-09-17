<?php

class M_api extends CI_Model {
    public $table = "";
    
    public function insert_data(){
    
        return $this->db->insert();
    
    }
    
    public function get_data($whr=array()){
    
        return $this->db->get($table);
        if($whr!="" or $whr!=NULL){
          where($whr)  
        }
        ->result();
    
    }

    



}
