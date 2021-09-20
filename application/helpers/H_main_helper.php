<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function getOs($no=2){
    return explode(" ",php_uname())[$no];
}


function Response($Status, $Message, $Code, $MessageType, $clientToken=NULL)
{
    if($clientToken!=NULL){
        $ResponseArray = array(
            $MessageType => $Message,
            'status_code'=> $Code,
            'hash' => randomHash(64),        
            'client_token' => $clientToken,
            'status' => $Status
        );
    }

    else{
        $ResponseArray = array(
            $MessageType => $Message,
            'status'=> $Code,      
            'status_code' => $Status
        );
    }


    header('Content-Type: application/json');
    echo json_encode($ResponseArray, JSON_UNESCAPED_UNICODE);
    exit();
}

function ResponsePurchase($Status, $Message, $Code, $MessageType, $clientToken=NULL, $ExpireDate){
    
    if($clientToken!=NULL){
        $ResponseArray = array(
            $MessageType => $Message,
            'status_code'=> $Code,
            'client_token' => $clientToken,
            'status' => $Status,
            'expire-date' => $ExpireDate
        );                                  
    }

    header('Content-Type: application/json');
    echo json_encode($ResponseArray, JSON_UNESCAPED_UNICODE);
    exit();
}

function checkData($data=array()){
    $res = false;
    foreach($data as $d){       
        if(isset($d)){
            if($d!=NULL or trim($d)!=""){
                $res = true;
            }else{
                $res = false;
                break;
            }
        }else{
            $res = false;
            break;
        }
    }
    return $res;

}
function checkHarf($d)
{
    if($d=="0" or $d=="1" or $d=="2" or $d=="3" or $d=="4" or $d=="5" or $d=="6" or $d=="7" or $d=="8" or $d=="9"){
        $no = intval($d);
        if($no % 2 == 1){
            return $no;
        }else{

        }
    }else{
        return false;
    }
}

function randomHash($length = 64) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



?>