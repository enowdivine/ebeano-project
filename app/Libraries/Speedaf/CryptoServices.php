<?php

namespace Speedaf;

  class  CryptoServices {

    private  $encryption_algorithm = null;
	private  $initilization_vector =  null;
	private $config = null;
	private $secret_key = null;
	
	public function __construct()
	{
		$this->encryption_algorithm =  "des-cbc";
		$this->config = require('Configuration.php');
		$this->secret_key = $this->config['secret_key'];
		$ivArray = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF);
        $iv = null;
        foreach($ivArray as $element){ $iv .= CHR($element); }
		$this->initilization_vector = $iv;
	}
	
	//$data_to_encrypt is an array
    public function encrypt($data_to_encrypt, $timestamp)
    {
		if(empty($data_to_encrypt)){
			throw new \Exception("Kindly provide the data to be enctrypted");
		}
		
		if(empty($timestamp)){
			throw new \Exception("timestamp is required");
		}
		
		
		//incoming data are the query parameters. they are in array form.
		//we need to transform them into json_format 
		$data_in_json_format =  json_encode($data_to_encrypt);
		
		$data = array(
			"data" => $data_in_json_format,
			"sign" => md5($timestamp . $this->secret_key . $data_in_json_format, false)
		);
		
		//turn whole data into json b4 ecryption
		$data = json_encode($data); 
        $encrypted_data = openssl_encrypt($data, $this->encryption_algorithm, $this->secret_key, 0, $this->initilization_vector);
        
		
		return $encrypted_data; //based_64_encoded string
    }


    public function decrypt($data_to_decrypt) 
	{
		
        $decrypted_data = openssl_decrypt($data_to_decrypt['data'], $this->encryption_algorithm,  $this->secret_key, 0, $this->initilization_vector);
		$decrypted_data = json_decode($decrypted_data, true);
		
		//data can be of mixed type
		return $decrypted_data;
    }

}
