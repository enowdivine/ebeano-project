<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class ValidateCustomer extends BaseSample{
        
        private $key = "validatecustomer";
        public function run($payment_code, $customer_id){
            return $this->billPayment->validateCustomer($payment_code, $customer_id);
        }
    }


        $paymentCode = "40201";//glo recharge test
        
        //sample customerId for the above paymentCode
        $customerId = "07030241757";

        $billers = new ValidateCustomer();

        $response = $billers->run($paymentCode, $customerId);

        if($response != null) {
            echo "\n ".json_encode($response);

            $response_code = json_decode($response["HTTP_CODE"]);
            $response_body = json_decode($response["RESPONSE_BODY"]);

            if($response_code == "200") {

                $customer = $response_body->Customers[0];

                $fullname = $customer->fullName;

                echo "\n ".$fullname;
            }
        }
 ?>