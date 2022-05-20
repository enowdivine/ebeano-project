<?php
namespace Speedaf;

require('CryptoServices.php');
use Exception;
use Speedaf as api;

class ApiServices {
	
	private $crypto_services = null;
	private $config = null;
	
	public function __construct()
	{
		$this->crypto_services = new api\CryptoServices();
		$this->config = require('Configuration.php');
	}
	//returns current time in milliseconds
	private function getCurrentTimestamp()
	{
            list($msec, $sec) = explode(' ', microtime());
            $timestamp = ceil((floatval($msec) + floatval($sec)) * 1000);
			return $timestamp;
	}

	/*
		By bill code 
		By Address
		$data :
		[
    		 "billCode" => "77130065353256"

		]

	*/

	public function getSoringCodeByWaybillNumber($data)
	{
		//validate the sorting code parameters
		$url = $this->config['sorting_code_by_waybill_path'];
		$result = $this->retrieve_data($data, $url);
		
		return $result;
	}


	public function track($data)
	{
		//validate the track parameters
		
		$url = $this->config['track_path'];
		$result = $this->retrieve_data($data, $url);
		return $result;	
	}

	public function createOrder($data)
	{
		//Validate order parameters
		$url = $this->config['create_order_path'];
		$result = $this->retrieve_data($data, $url);

		//you can process b4 return
		return $result;
	}
	
	
	private function retrieve_data($data, $url)
	{
		//Todo handle network errors
		$timeline = $this->getCurrentTimestamp();
		
		//handle encryption exceptions
		$encrypted_data = $this->crypto_services->encrypt($data, $timeline);

		$post_url = $this->config['base_path'].$url.'?timestamp=' . $timeline . '&appCode=' . $this->config['app_code'];

		//You can use another Network client like guzzle here
		$header = array('Content-Type: application/json', 'Content-Length: ' . strlen($encrypted_data));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $post_url);    //Set the URl
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  //Do not verify the HTTPS certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  //Do not verify HTTPS Host
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // Get data Return
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);    // When CURLOPT_RETURNTRANSFER is enabled, the data will be obtained and returned
		curl_setopt($ch, CURLOPT_POSTFIELDS, $encrypted_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		$result = curl_exec($ch); //Execution
		if(curl_errno($ch)){
			
			throw new Exception(curl_error($ch));
		}
		curl_close($ch);

		


		//handle descryption exception

		//Incoming data is in Json format. it needs to be in arrat format.
		//the array has keys like 'success' (boolean), 'data' a base 64 string
		$result_in_array_form =  json_decode($result, true);
		if(!isset($result_in_array_form['success'])){
			throw new Exception("Request failed");
		}
		if($result_in_array_form['success'] == false){
			$error_messages = require('ErrorCodes.php');
			throw new Exception($error_messages[$result_in_array_form['error']['code']]);
		}

		$result_data = $this->crypto_services->decrypt($result_in_array_form);
		return $result_data;
		
	}

		
}