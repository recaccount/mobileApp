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
		// CONTROL and SECURITY of POSTED DATAS
		if($this->input->method("post")){	
			
			$stream_clean = $this->input->raw_input_stream;
			$request = json_decode($stream_clean);
			
			$uid 		= trim($request->uid);
			$uuid 		= trim($request->uuid);
			$appId 		= trim($request->appId);
			$lang 	    = trim($request->lang);
			$os 		= trim($request->os);


			$data = json_decode($this->M_api->get_data("device",array("uuid" => $uuid)));
			
			if(checkData(array($uid,$uuid,$appId,$lang,$os))===true){
				if(count($data)==0){
					$res = $this->M_api->insert($uuid, $lang, $uid, $os, $appId);

					if($res===true){
						Response(200,"You're successfully registered","200","success");					
					}

				}
				else{
					Response(400,"You're already registered","400","failure");
				}
			}
			


			

					
			
		}
	}
	
	public function purchase() 
	{
		$this->load->view("api");
		// echo "Purchase";
	}
	
	public function checkSubscription()
	{
		echo "Check Subscription";
	}

}
