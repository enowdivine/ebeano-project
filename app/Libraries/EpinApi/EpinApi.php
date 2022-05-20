<?php
    namespace EpinApi;
    
    class EpinApiBillPayment{

        private $url = 'https://epins.com.ng/api';
        private $apikey = "Cs2BCkA63xA0ApzC9ACACngl1CCx25qtCBB6EoAdb4GcDxem3yiadFvfJACx";
        public function __construct(){
            
        }
        public function buyAirtime($request){
            $url = $this->url.'/airtime?apikey='.$this->apikey.'&network='.$request->billerCode.'&phone='.$request->customer_phone.'&amount='.$request->amount.'&ref='.$request->token;
            $result = self::send($url);
            if($result->code ==101){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result->description->response_description];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>json_encode($result)];
            }
            return $ret;
        }
        public function buyData($request, $databundle){
            $service = ['MTN'=>'01', 'AIRTEL'=>'04', 'GLO'=>'02', 'AIRTEL'=>'03'];
            $url = $this->url.'/sme-data?apikey='.$this->apikey.'&service='.$service[$request->billerCode].'&MobileNumber='.$request->data_phone.'&DataPlan='.$databundle;
            $result = self::send($url);
            if($result->code ==101){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>json_encode($result)];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>json_encode($result)];
            }
            return $ret;
        }
        public function getMeterServices(){
            $result = (object)['discos'=>(object)[(object)['disco-name'=>'ikeja-electric'], (object)['disco-name'=>'eko-electric'], (object)['disco-name'=>'enugu-electric'], (object)['disco-name'=>'abuja-electric'], (object)['disco-name'=>'portharcourt-electric'], (object)['disco-name'=>'jos-electric'], (object)['disco-name'=>'kano-electric'], (object)['disco-name'=>'ibadan-electric']]];
            if($result){
                $ret = ['status'=>'success', 'service'=>$result->discos];
            }else{
                $ret = ['status'=>'fail', 'service'=>'No Service Found'];
            }
            return (object)$ret;
        }
        public function validateMeter($request){
            
            $type = ($request->meter_name == 0) ? "prepaid" : "postpaid";
            
            $url = $this->url.'/electric-verify?apikey='.$this->apikey.'&service='.$request->package.'&meterno='.$request->customer_id.'&type='.$type;
            $result = self::send($url);
            if($result->code ==119){
                $ret = ['status'=>'success', 'name'=>$result->description->Customer];
            }else{
                $ret = ['status'=>'fail', 'name'=>'No Name Found'];
            }
            return $ret;
        }
        public function buyMeter($request){
            
            $type = ($request->billerCode == 0) ? "prepaid" : "postpaid";
            
            $url = $this->url.'/electric?apikey='.$this->apikey.'&service='.$request->payment_service.'&meterno='.$request->meter_no.'&metertype='.$type.'&amount='.$request->amount.'&ref='.$request->token;
            $result = self::send($url);
            if($result->code ==101){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>json_encode($result)];
            }
            return $ret;
        }
        public function getCableServices($brand){
            $url = $this->url.'/variations/?service='.$brand;
            $result = self::send($url);
            if($result->code ==302){
                foreach($result->description as $plan) {
                    $plans[] = (object)['plan'=>$plan->vcode, 'name'=>$plan->Plan, 'amount'=>$plan->amount];
                }
                $ret = ['status'=>'success', 'service'=>(object)$plans];
            }else{
                $ret = ['status'=>'fail', 'service'=>$result];
            }
            return (object)$ret;
        }
        public function validateCable($request){
            $url = $this->url.'/merchant-verify?apikey='.$this->apikey.'&service='.$request->package.'&smartNo='.$request->customer_id.'&type='.$request->package;
            $result = self::send($url);
            if($result->code ==119){
                $ret = ['status'=>'success', 'name'=>$result->description->Customer];
            }else{
                $ret = ['status'=>'fail', 'name'=>$url];
            }
            return $ret;
        }
        public function buyCable($request){
            $url = $this->url.'/biller?apikey='.$this->apikey.'&service='.$request->billerCode.'&accountno='.$request->cable_smartcard.'&vcode='.$request->payment_service.'&amount='.$request->amount.'&ref='.$request->token;
            $result = self::send($url);
            if($result->code ==101){
                $ret = ['status'=>'success', 'message'=>'Transaction successful', 'response'=>$result];
            }else{
                $ret = ['status'=>'fail', 'message'=>'Transaction failed', 'response'=>json_encode($result)];
            }
            return $ret;
        }
        
        // curl
        private function send($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            $data = curl_exec($ch);
            
            //Close the cURL handle.
            curl_close($ch);
            
            $response = json_decode($data);
            return $response;
        }
    }
?>