<?php
    namespace Billers;
    use Interswitch\Interswitch;
    use Billers\Constants;
    //require_once __DIR__ . '/../vendor/autoload.php';
    
    class BillPayment{

        private $interswitch;
        public function __construct($clientId, $clientSecret, $env="SANDBOX"){
            $this->interswitch = new Interswitch($clientId, $clientSecret,$env);
        }
        public function get_billers(){
            echo "get billers function\n";
            try {
                return $this->interswitch->send(Constants::GET_BILLERS_URL, Constants::GET);
            }
            catch(Exception $e){
                return null;
            }
        }
        public function get($key){//generic get
            
            try{
                //echo Constants::MAP[$key];
                return $this->interswitch->send(Constants::MAP[$key], Constants::GET);
            }
            catch(Exception $e) {
                return null;
            }
        }
        public function get_category_billers($id){

            try{

                $prefixURL = Constants::GET_CATEGORYS_BILLERS_PREFIX;
                $suffixURL = Constants::GET_CATEGORYS_BILLERS_SUFFIX;

                return $this->interswitch->send($prefixURL.$id.$suffixURL, Constants::GET);

            }
            catch(Exception $e){
                return null;
            }
        }

        public function get_biller_payment_items($id){
            try{
                $prefixURL = Constants::GET_CATEGORY_BILLERS_PAYMENTITEMS_PREFIX;
                $suffixURL = Constants::GET_CATEGORY_BILLERS_PAYMENTITEMS_SUFFIX;

                return $this->interswitch->send($prefixURL.$id.$suffixURL, Constants::GET);
            }
            catch(Exception $e){
                return null;
            }
        }
        public function transaction_inquiry($payment_code, $customer_id){
            try{

                $req = new \stdClass(); 
                $req->paymentCode = $payment_code;
                $req->customerId = $customer_id;

                echo "\n ".json_encode($req);

                return $this->interswitch->send(Constants::TRANSACTION_INQUIRY_URL, Constants::POST, json_encode($req));

            }
            catch(Exception $e){
                return null;
            }
        }

        public function validateCustomer($payment_code, $customer_id){
            try{

                $req = new \stdClass();
                $arr = [];
                $sub_obj = new \stdClass();
                $sub_obj->paymentCode = $payment_code;
                $sub_obj->customerId = $customer_id;
                $arr[0] = ($sub_obj);
                $req->customers = $arr;
                //echo "\n ".json_encode($req)." ".json_encode($sub_obj);

                return $this->interswitch->send(Constants::VALIDATE_CUSTOMER_URL, Constants::POST, json_encode($sub_obj));

            }
            catch(Exception $e){
                return null;
            }
        }
        public function get_transaction_status($requestRef){
            try{
                $header = [
                    'requestReference: '. $requestRef
                ];
                return $this->interswitch->send(Constants::TRANSACTION_STATUS_RESOURCE_URL, Constants::GET, null, $header);

            }catch(Exception $ex){
                return null;
            }
        }
        public function make_payment($data){
            try{

                /*$payment = new \stdClass();
                $payment->amount = $amount;
                $payment->paymentCode = $payment_code;
                $payment->customerId = $customer_id;
                $payment->requestReference = $requestRef;*/

                return $this->interswitch->send(Constants::MAKE_PAYMENT_RESOURCE_URL, Constants::POST, json_encode($data));
            }
            catch(Exception $e){
                return null;
            }
        }
    }
?>