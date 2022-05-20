<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    /**
    * Purpose: To get the status of a transaction after making a payment.
    * 
    * 1. Make Payment with a unique requestReference
    * 2. Query for the transaction
    */
    class TransactionStatus extends BaseSample{
        
        private $key = "transactionstatus";
        public function run($requestRef){
            return $this->billPayment->get_transaction_status($requestRef);
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

    $transactionStatus = new TransactionStatus();

    $transactionStatus = $transactionStatus->run($requestRef);

    if($transactionStatus != null) {
        $response_code = json_decode($response["HTTP_CODE"]);
        $response_body = json_decode($response["RESPONSE_BODY"]);

        if($response_code == "200") {

            $transactionRef = $response_body->transactionRef;

            echo "\n ".$transactionRef;
        }
    }
    
    
 ?>