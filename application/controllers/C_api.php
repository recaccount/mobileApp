<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends CI_Controller {

	public $table;

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_api");
		// $data = $this->M_api->get_data("device");
		// $this->registration($data);
		
	}

	public function registration()
	{	
		
		if($this->input->method()=="post"){	
			
			$stream_clean = $this->input->raw_input_stream;
			$req = json_decode($stream_clean);
			
			$uid 			= trim($req->uid);
			$uuid 			= trim($req->uuid);
			$appid 			= trim($req->appid);
			$lang 	    	= trim($req->lang);
			$os 			= trim($req->os);
			$clientToken	= trim("T-".randomHash());
			$dataArray 		= array($uid,$uuid,$appid,$lang,$os,$clientToken);

			$data = json_decode($this->M_api->get_data("device",array("uuid" => $uuid)));
			
			if(checkData($dataArray)===true){
				if(count($data)==0){
					$res = $this->M_api->insert_device($uuid, $lang, $uid, $os, $appid, $clientToken);

					if($res===true){

						Response(200,"You're successfully registered.","success","response",$clientToken);

					}else{
						Response(400,"There is a problem with the system. Please try again later.","failed","response");
					}
				}
				else {

					Response(400,"You're already registered.","failed","response");

				}
				
			}
			
		}
		// Method Post değilse
		else {
			redirect(base_url(""));
			
		}
	}
	
	public function purchase() 
	{
		if ($this->input->method()=="post"){
		  	$stream_clean = $this->input->raw_input_stream;
			$req = json_decode($stream_clean);
			$data = json_decode($this->M_api->get_data("device",array("client_token" => $req->client_token)));
			
			$clientToken = $req->client_token;
			$receiptHash = $req->receiptHash;
			$req = checkData(array($clientToken,$receiptHash));

			if($req===true && count($data)>0){
				$res = $this->M_api->insert_purchase_reqs($clientToken,$receiptHash,date("Y-m-d H:i:s",strtotime('-9 hours')), date('Y-m-d H:i:s', strtotime('+3 days -9 hours')));
				if ($res == true){
					$sonHarf = substr($receiptHash, -1);
					$sonuc = checkHarf($sonHarf);
					if($sonuc != false){

						ResponsePurchase(200,"Your purchase request has been sent. Your receipt-hash is -> ".$receiptHash,"OK","response",$clientToken,date('Y-m-d H:i:s', strtotime('+3 days -9 hours')));				  
					}else{
						Response(400,"There is a problem with the system. Please try again later.","failed","response");
					}
				}
				else{
					Response(400,"There is a problem with the system. Please try again later.","failed","response");
				}
			}
			
		} 
		else {
		  
		  
		}
	}
	
	public function checkSubscription()
	{
		if ($this->input->method()=="post"){
			
			$stream_clean = $this->input->raw_input_stream;
			$req = json_decode($stream_clean);
			$clientToken = trim($req->clientToken);
			if (checkData(array($clientToken))===true){
				$data = json_decode($this->M_api->get_data("device",array("client_token" => $clientToken)));
			  
				if(count($data)>0){

					Response(200,"Registered","200","response");

			 	}
			} 

			else {
			  
				Response(404,"This user isn't registered in the system","404","response");
			  
			}
			
		  
		} 
		else {
			redirect(base_url(""));
		}
		
	}

}
