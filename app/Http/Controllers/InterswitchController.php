<?php

namespace App\Libraries\Billers\src;
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
use Billers\BillPayment;
use Interswitch\Interswitch;

class InterswitchController extends Controller
{
    private $key="categorys";
    private $paymentCode = "90101";
    var $clientId = "IKIA9614B82064D632E9B6418DF358A6A4AEA84D7218";
    var $clientSecret="XCTiBtLy1G9chAnyg0z3BcaFK4cVpwDg/GTw2EmjTZ8=";
    var $billPayment;

    public function __construct(){
        $this->billPayment = new BillPayment($this->clientId, $this->clientSecret, Interswitch::ENV_SANDBOX);
    }
    
    public function is_sandbox_test($id){
        $id = $id;
$nonce=$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 60);

    $date = time();
    $timestamp =strtotime('now');
    $httpMethod = "GET";
    $clientId = "IKIA9614B82064D632E9B6418DF358A6A4AEA84D7218"; 
    $clientSecretKey = "XCTiBtLy1G9chAnyg0z3BcaFK4cVpwDg/GTw2EmjTZ8=";

    $resourceUrl='https://sandbox.interswitchng.com/api/v2/quickteller/categorys';
    $resourceUrl = strtolower($resourceUrl);
    $resourceUrl = str_replace('http://', 'https://', $resourceUrl);
    $encodedUrl = urlencode($resourceUrl);
    $transactionParams = "1";
    $httpMethod = "GET";

    $signatureCipher = $httpMethod . '&' . $encodedUrl . '&' . $timestamp . '&' . $nonce . '&' . $clientId . '&' . $clientSecretKey;

    if (!empty($transactionParams) && is_array($transactionParams)) {
        $parameters = implode("&", $transactionParams);
        $signatureCipher = $signatureCipher . $parameters;
    }
    $signature = base64_encode(sha1($signatureCipher, true));
    $auth = base64_encode($clientId);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$resourceUrl);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        'Content-Type:application/json',
        'Authorization:InterswitchAuth '.$auth,           
        'Signature:'.$signature,            
        'Nonce:'.$nonce,            
        'Timestamp:'.$timestamp,            
        'SignatureMethod:SHA1',
        'TerminalID:3DMO0001'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    // header('Content-Type: application/json');
    return $server_output;
    }
    public function test(){

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

            //echo "\n CategoryId: ".$categoryId;
            
            //print_r($categoryResponse->categorys);
            
            foreach($categoryResponse->categorys as $key => $value){
                echo $value->categoryname." ========  ".$value->categoryid."<br>";
            }

            //2. Get Billers in a category
             echo"\n <br><br> "."STEP 2: Get Billers in a category";
            $billerCategorys = json_decode($this->billPayment->get_category_billers(4)["RESPONSE_BODY"]);

            if(isset($billerCategorys->errors)) throw new Exception("Error in Billers in Category response");

            $billerId = $billerCategorys->billers[0]->billerid;

            //echo "\n BillerId: ".$billerId;
            
            //print_r($billerCategorys->billers);
            foreach($billerCategorys->billers as $key => $value){
                echo $value->billername." ========  ".$value->billerid."<br>";
            }

            //3. Get all Payment Item codes
            echo "\n Step 3: Get all payment Item Codes";

            $paymentItemResponse = json_decode($this->billPayment->get_biller_payment_items(402)["RESPONSE_BODY"]);
            
            if(isset($paymentItemResponse->errors)) throw new Exception("Error in Getting payment item response");
            $paymentItemId = $paymentItemResponse->paymentitems[0]->paymentitemid;

            //echo "\n payment item id: ".$paymentItemId;
            
            //print_r($paymentItemResponse->paymentitems);
            foreach($paymentItemResponse->paymentitems as $key => $value){
                echo $value->paymentitemname." ========  ".$value->paymentitemid."<br>";
            }

            //Step 4: Validate Customer
            echo "\n Step 4: Validate Customer";

            $validateCustomerResponse = json_decode($this->billPayment->validateCustomer(90501, 0434556574)["RESPONSE_BODY"]);
            
            print_r($validateCustomerResponse);

            /*if(isset($validateCustomerResponse->errors)) throw new Exception("Error in Validating customer");
            $fullName = $validateCustomerResponse->Customers[0]->fullName;

            echo"\n Full-Name ".$fullName;*/

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
            $referencePrefix = "1453"; //prefix for test environment, use test
            
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
    
    
    public function getBiller($categoryid){
       
       $data = "";
       try{

            $billerCategorys = json_decode($this->billPayment->get_category_billers($categoryid)["RESPONSE_BODY"]);

            if(isset($billerCategorys->errors)) throw new Exception("Error in Billers in Category response");

            $data = $billerCategorys->billers;
       
       }catch(Exception $ex){


       }
       
       return $data;
       
    }
    
    public function getServices($billerid){
       
       $data = "";
       try{

            $paymentItemResponse = json_decode($this->billPayment->get_biller_payment_items($billerid)["RESPONSE_BODY"]);
            
            if(isset($paymentItemResponse->errors)) throw new Exception("Error in Getting payment item response");

            $data = $paymentItemResponse->paymentitems;
       
       }catch(Exception $ex){


       }
       
       return $data;
       
    }
    
    
    public function validateCustomer($customerId){
       
       $data = "";
       try{

            $validateCustomerResponse = json_decode($this->billPayment->validateCustomer($this->paymentCode, $customerId)["RESPONSE_BODY"]);
            
            if(isset($validateCustomerResponse->errors)){
                $data = ['status'=>'error', 'name'=>'', 'response'=>$validateCustomerResponse->errors];
            } 
            
            $data = ['status'=>'success', 'name'=>$validateCustomerResponse->Customers[0]->fullName];
            
       
       }catch(Exception $ex){


       }
       
       return $data;
       
    }
    
    public function payBill($payment){
       
       $data = "";
       try{

            $referencePrefix = "1453"; //prefix for test environment, use test

            $requestRef = $referencePrefix.$payment['requestRef'];
            
            $payment_data = array_merge($payment, ["requestReference"=>$requestRef]);
 
            $paymentResponse = json_decode($this->billPayment->make_payment($payment_data)["RESPONSE_BODY"]);

            if(isset($paymentResponse->errors)){
                $data = ['status'=>'error', 'message'=>'Unable to make purchase', 'response'=>$paymentResponse->errors];
            } 
            
            $data = ['status'=>'success', 'message'=>'Purchase was successful', 'response'=>$paymentResponse->transactionRef];
       
       }catch(Exception $ex){


       }
       
       return $data;
       
    }


}
