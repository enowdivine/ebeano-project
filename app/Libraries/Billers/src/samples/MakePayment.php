<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class MakePayment extends BaseSample{
        
        private $key = "makepayment";
        public function run($amount, $customerId, $paymentCode, $requestRef){
            return $this->billPayment->make_payment($amount, $customerId, $paymentCode, $requestRef);
        }
    }

    $paymentCode = "90101"; //paymentCode for test="40201", paymentCode for sandbox=90101

    $customerId = "07030241757";

    $amount = "500"; // amount is in minor format.

    /**
        * The referencePrefix is a unique 4-sequence code for each Biller
        * You can get your own when you are set up as a merchant on our platform
        * It is not mandatory to have one
        * We strongly advice you get one because it will reduce the chances of reference collisions.
        * 
        * In the example below, we will be using "test" as out referencePrefix
        */
    $referencePrefix = "1456"; //prefix for test environment, use test
    
    $requestRef = mt_rand(100000, 999999);// unique reference number

    $requestRef = $referencePrefix.$requestRef;

    $billers = new MakePayment();

    $response = $billers->run($amount, $customerId, $paymentCode, $requestRef);
    echo "\n".json_encode($response);
    if($response != null) {

        $response_code = json_decode($response["HTTP_CODE"]);
        $response_body = json_decode($response["RESPONSE_BODY"]);

        if($response_code == "200") {
            $transactionRef = $response_body->transactionRef;
            
        }
    }
    
 ?>