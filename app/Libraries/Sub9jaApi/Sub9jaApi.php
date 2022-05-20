<?php
    namespace Sub9jaApi;
    
    class Sub9jaApi{

        private $client = "wikidailies:paskey";
        public function __construct(){
            
        }
        public function buyAirtime($request){
            $result = self::send('POST',
						'https://sub9ja.ng/api/v1/airtime',
						['network' => $request->billerCode, 'amount' => $request->amount_paid, 'phonenumber' => $request->customer_phone]);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result->discription];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>$result];
            }
            return $ret;
        }
        public function buyData($request){
            $result = self::send('POST',
						'https://sub9ja.ng/api/v1/data',
						['network' => $request->billerCode, 'databundle' => $request->payment_service, 'phonenumber' => $request->data_phone]);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result->discription];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>$result];
            }
            return $ret;
        }
        public function validateMeter($request){
            $result = self::send('POST',
				'https://sub9ja.ng/api/v1/electricity/verify',
				['disco_name' => $request->package, 'meter_number' => $request->customer_id]);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'name'=>$result->name];
            }else{
                $ret = ['status'=>'fail', 'name'=>'Meter number not valid'];
            }
            return (object)$ret;
        }
        public function getMeterServices(){
            $result = self::send('GET', 'https://sub9ja.ng/api/v1/electricity', []);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'service'=>$result->discos];
            }else{
                $ret = ['status'=>'fail', 'service'=>$result];
            }
            return (object)$ret;
        }
        public function buyMeter($request){
            $result = self::send('POST',
					'https://sub9ja.ng/api/v1/electricity',
					['disco_name' => $request->payment_service, 'meter_number' => $request->meter_no, 'amount' => $request->amount_paid]);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result->details, 'token'=>$result->details->token];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>$result];
            }
            return (object)$ret;
        }
        public function validateCable($request){
            $result = self::send('POST',
				'https://sub9ja.ng/api/v1/tv/verify',
				['category' => $request->package, 'smartcard_number' => $request->customer_id]);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'name'=>$result->customer_name];
            }else{
                $ret = ['status'=>'fail', 'name'=>'Card not smart'];
            }
            return $ret;
        }
        public function getCableServices($brand){
            $result = self::send('GET', 'https://sub9ja.ng/api/v1/tv', []);
            if($result){
                $ret = ['status'=>'success', 'service'=>$result->{$brand}];
            }else{
                $ret = ['status'=>'fail', 'service'=>$result];
            }
            return (object)$ret;
        }
        public function buyCable($request){
            $result = self::send('POST',
					'https://sub9ja.ng/api/v1/tv',
					['category' => $request->billerCode, 'category_plan' => $request->payment_service, 'smartcard_number' => $request->cable_smartcard, 'phonenumber' => $request->cable_phone]);
            if($result->status =='success'){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result->details];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>$result];
            }
            return (object)$ret;
        }
        
        // curl
        private function send($method, $url, $fields = ''){
            
            $auth = base64_encode($this->client);
        	$curl = curl_init();
        	if ($method == 'POST') {
        		curl_setopt_array($curl, array(
        			CURLOPT_URL => $url,
        			CURLOPT_RETURNTRANSFER => true,
        			CURLOPT_ENCODING => "",
        			CURLOPT_MAXREDIRS => 10,
        			CURLOPT_TIMEOUT => 0,
        			CURLOPT_FOLLOWLOCATION => true,
        			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        			CURLOPT_CUSTOMREQUEST => $method,
        			CURLOPT_POSTFIELDS => json_encode($fields),
        			CURLOPT_HTTPHEADER => array(
        				"Authorization: Basic $auth",
        				"Content-Type: application/json"
        			),
        		));
        	} else {
        		curl_setopt_array($curl, array(
        			CURLOPT_URL => $url,
        			CURLOPT_RETURNTRANSFER => true,
        			CURLOPT_ENCODING => "",
        			CURLOPT_MAXREDIRS => 10,
        			CURLOPT_TIMEOUT => 0,
        			CURLOPT_FOLLOWLOCATION => true,
        			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        			CURLOPT_CUSTOMREQUEST => $method,
        			CURLOPT_HTTPHEADER => array(
        				"Authorization: Basic " . $auth,
        				"Content-Type: application/json"
        			),
        		));
        	}
        	
        	$data = curl_exec($curl);
        	curl_close($curl);
        	$response = json_decode($data);
        	return $response;
        }
    }
?>