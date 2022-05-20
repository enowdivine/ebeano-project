<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    /**
    * 
    * @author 
    * An all in one sample is meant to show all the requests used at once.
    * The flow is 
    * 
    * 1. Get All Categorys.
    * 2. Select a biller from any category.
    * 3. Get all payment item codes for that biller selected from Number 2 Step.
    * 4. Validate Customer.
    * 5. Make Payment
    * 6. Query the status of a transaction
    *
    */

    class AllInOneSample extends BaseSample{

        public function run(){

            $paymentCode = "90101"; //paymentCode for test="40201", paymentCode for sandbox=90101
        
            //sample customerId for the above paymentCode
            $customerId = "07030241757";

            //amount to be used in STEP 5: Make Payment
            $amount = 500; // Amount is in minor format.


           try{
                echo"\n "."STEP 1: Get All Categorys";
                // 1. Get All Categorys
                $categoryResponse = json_decode($this->billPayment->get("categorys")["RESPONSE_BODY"]);

                if(isset($categoryResponse->errors)) throw new Exception("Error in Fetching Category response");

                //echo"\n ".json_encode($categoryResponse);

                $categoryId = $categoryResponse->categorys[0]->categoryid;

                echo "\n CategoryId: ".$categoryId;

                //2. Get Billers in a category
                 echo"\n "."STEP 2: Get Billers in a category";
                $billerCategorys = json_decode($this->billPayment->get_category_billers($categoryId)["RESPONSE_BODY"]);

                if(isset($billerCategorys->errors)) throw new Exception("Error in Billers in Category response");

                $billerId = $billerCategorys->billers[0]->billerid;

                echo "\n BillerId: ".$billerId;

                //3. Get all Payment Item codes
                echo "\n Step 3: Get all payment Item Codes";

                $paymentItemResponse = json_decode($this->billPayment->get_biller_payment_items($billerId)["RESPONSE_BODY"]);
                
                if(isset($paymentItemResponse->errors)) throw new Exception("Error in Getting payment item response");
                $paymentItemId = $paymentItemResponse->paymentitems[0]->paymentitemid;

                echo "\n payment item id: ".$paymentItemId;

                //Step 4: Validate Customer
                echo "\n Step 4: Validate Customer";

                $validateCustomerResponse = json_decode($this->billPayment->validateCustomer($paymentCode, $customerId)["RESPONSE_BODY"]);

                if(isset($validateCustomerResponse->errors)) throw new Exception("Error in Validating customer");
                $fullName = $validateCustomerResponse->Customers[0]->fullName;

                echo"\n Full-Name ".$fullName;

                //Step 5: Validate Customer
                echo "\n Step 5: Make Payment";
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

                $paymentResponse = json_decode($this->billPayment->make_payment($amount, $customerId, $paymentCode, $requestRef)["RESPONSE_BODY"]);

                if(isset($paymentItemResponse->errors)) throw new Exception("Error in Making Payment");

                //echo "\n ".json_encode($paymentItemResponse);
                
                //Step 6: Query Transaction Status
                echo "\n Step 6: Query Transaction Status";
                
                $transactionStatusResponse = json_decode($this->billPayment->get_transaction_status($requestRef)["RESPONSE_BODY"]);
                
                if(isset($transactionStatusResponse->errors)) throw new Exception("Error in Getting Transacton status");

                $transactionStatusRef = $transactionStatusResponse->transactionRef;

                echo"\n transaction ref for query transaction  status: ".$transactionStatusRef;

           
           }catch(Exception $ex){


           }
        }
    }

    //create nee odbc_fetch_object
    $allInOneSampe = new AllInOneSample();
    $allInOneSampe->run();
?>