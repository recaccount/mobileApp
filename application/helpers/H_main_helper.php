<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function getOs($no){
    return explode(" ",php_uname())[$no];
}


function Response($Status, $Message, $Code, $MessageType)
{

    $ResponseArray = array(
        $MessageType => $Message,
        'status_code'=> $Code,
        'status' => $Status
    );

    http_response_code($Code);
    header('Content-Type: application/json');
    echo json_encode($ResponseArray, JSON_UNESCAPED_UNICODE);
    exit();
}

function checkData($data=array()){
    $res = false;
    foreach($data as $d){
        if(isset($d)){
            if($d!=NULL or $d!=""){
                $res = true;
            }else{
                $res = false;
            }
        }else{
            $res = false;
        }
    }
    return $res;

}



?>