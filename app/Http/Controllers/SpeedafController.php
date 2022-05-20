<?php

namespace App\Http\Controllers;
use App\Seller;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Libraries\Speedaf\ApiServices;

class SpeedafController extends Controller
{
    private $crypto_services = null;
	//private $secret = "HrEZWKMg";
	//private $app_code = "TT660033";
	//private $customer_code = "2340011";
	private $secret = "HrEZWKMg";
	private $app_code = "TT660033";
	private $customer_code = "2340011";
	private $base_url = "https://apis.speedaf.com/";
	private $track_path = "/open-api/express/track/query";
	private $create_order_path = "/open-api/express/order/createOrder";


   public function __construct(){
       
       
        $this->encryption_algorithm =  "des-cbc";
	    $this->secret_key = $this->secret;
		$ivArray = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF);
        $iv = null;
        foreach($ivArray as $element){ $iv .= CHR($element); }
		$this->initilization_vector = $iv; 
       
       
       
   }
    public function InitiateOrder($data)
	{
		//Validate order parameters
		$url = $this->create_order_path;
		$result = $this->retrieve_data($data, "https://apis.test.speedaf.com/open-api/express/order/createOrder");

		//you can process b4 return
		return $result;
	}
	
	public function test()
	{
		//Validate order parameters
		/*$data =  [

        "mailNoList" => ["86254200001257"]

        ];
        */
        
        $data = [

        "acceptAddress" => "Lokoja road" ,

        "acceptCityCode" => "Ibadan" ,

        "acceptCityName" => "Oyo" ,

        "acceptCompanyName" => "acceptCompanyName" ,

        "acceptCountryCode" => "NG" ,

        "acceptCountryName" => "Nigiera" ,

        "acceptDistrictCode" => "acceptDistrictCode" ,

        "acceptDistrictName" => "acceptDistrictName" ,

        "acceptEmail" => "123@Test.com" ,

        "acceptMobile" => "1778922222" ,

        "acceptName" => "acceptName" ,

        "acceptPhone" => "999999" ,

        "acceptPostCode" => "acceptPostCode" ,

        "acceptProvinceCode" => "acceptProvinceCode" ,

        "acceptProvinceName" => "acceptProvinceName" ,

        "codFee" => 700 ,

        "customOrderNo" => "309654332" ,

        "customerCode" => "2340002" ,

        "goodsDesc" => "goodsDesc" ,

        "goodsHigh" => 1000 ,

        "goodsLength" => 1000 ,

        "goodsName" => "goodsname" ,

        "goodsPrice" => 1000 ,

        "goodsQTY" => 99 ,

        "goodsValue" => 100 ,

        "goodsVolume" => 1 ,

        "goodsWeight" => 200 ,

        "goodsWidth" => 1000 ,

        "insurePrice" => 876 ,

        "itemList" => [

                [

                        "battery" => 0 ,

                        "blInsure" => 0 ,

                        "dutyMoney" => 1000 ,

                        "goodsId" => "19999" ,

                        "goodsMaterial" => "" ,

                        "goodsName" => "item mane" ,

                        "goodsNameDialect" => "item namme" ,

                        "goodsQTY" => 1 ,

                        "goodsRemark" => "goodsRemark" ,

                        "goodsRule" => "goodsRule" ,

                        "goodsType" => "IT02" ,

                        "goodsUnitPrice" => 1 ,

                        "goodsValue" => 1 ,

                        "goodsWeight" => 1 ,

                        "high" => 1 ,

                        "length" => 1 ,

                        "makeCountry" => "makeCountry" ,

                        "salePath" => "salePath" ,

                        "sku" => "sku001" ,

                        "unit" => "" ,

                        "width" => 1

                ]

        ],

        "piece" => 1 ,

        "remark" => "1" ,

        "sendAddress" => "sendAddress" ,

        "sendCityCode" => "sendCityCode" ,

        "sendCityName" => "sendCityName" ,

        "sendCompanyName" => "sendCompanyName" ,

        "sendCountryCode" => "CN" ,

        "sendCountryName" => "CHINA" ,

        "sendDistrictCode" => "sendDistrictCode" ,

        "sendDistrictName" => "sendDistrictName" ,

        "sendMail" => "sendMail" ,

        "sendMobile" => "sendMobile" ,

        "sendName" => "sendName" ,

        "sendPhone" => "sendPhone" ,

        "sendPostCode" => "sendPostCode" ,

        "sendProvinceCode" => "sendProvinceCode" ,

        "sendProvinceName" => "sendProvinceName" ,

        "shippingFee" => 1 ,

     "deliveryType" => "DE01" ,

     "payMethod" => "PA01" ,

  "parcelType" => "PT01" ,

     "shipType" => "ST01" ,

     "transportType" => "TT01" ,

     "platformSource" => "csp" ,

     "smallCode" => "" ,

     "threeSectionsCode" => ""

    ];

	 $url = $this->create_order_path;
		
	 $result = $this->retrieve_data($data, "http://8.214.27.92:8480/open-api/express/order/createOrder");

		//you can process b4 return
		//echo $_SERVER['SERVER_ADDR'];
		$track_parameters =  [

        "mailNoList" => ["47234208709909"]

        ];
        
		//$result = $this->retrieve_data($track_parameters, "https://apis.speedaf.com/open-api/express/track/query");
		
		print_r($result);
		//echo $url;
	}
	
	public function track($data)
	{
		//validate the track parameters
		
		$url = $this->track_path;
		$result = $this->retrieve_data($data, $url);
		return $result;	
	}
   
   
   private function getCurrentTimestamp()
	{
            list($msec, $sec) = explode(' ', microtime());
            $timestamp = ceil((floatval($msec) + floatval($sec)) * 1000);
			return $timestamp;
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
			"sign" => md5($timestamp . $this->secret . $data_in_json_format, false)
		);
		
		//turn whole data into json b4 ecryption
		$data = json_encode($data); 
        $encrypted_data = openssl_encrypt($data, $this->encryption_algorithm, $this->secret, 0, $this->initilization_vector);
        
		
		return $encrypted_data; //based_64_encoded string
    }


    public function decrypt($data_to_decrypt) 
	{
		
        $decrypted_data = openssl_decrypt($data_to_decrypt['data'], $this->encryption_algorithm,  $this->secret, 0, $this->initilization_vector);
		$decrypted_data = json_decode($decrypted_data, true);
		
		//data can be of mixed type
		return $decrypted_data;
    }

	
   	private function retrieve_data($data, $url)
	{
		//Todo handle network errors
		$timeline = $this->getCurrentTimestamp();
		
		//handle encryption exceptions
		$encrypted_data = $this->encrypt($data, $timeline);

		$post_url = $url.'?timestamp=' . $timeline . '&appCode=' . $this->app_code;
        
		//Send request
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

		$result_data = $this->decrypt($result_in_array_form);
		
		return $result_in_array_form;
		
	}


}
