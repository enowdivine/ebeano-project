<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers\samples\GetBillers;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class GetPaymentItems extends BaseSample{
        
        private $key = "paymentitems";
        public function run($id){
            return $this->billPayment->get_biller_payment_items($id);
        }
    }

    $billers = new GetBillers();
    $response = $billers->run();

    if($response != null) {
        $response_code = json_decode($response["HTTP_CODE"]);
        $response_body = json_decode($response["RESPONSE_BODY"]);

        if($response_code == "200") {

            //get the billerId
            //based on this billerId, get the payment items for that biller
            $biller_array = $response_body->billers;
            $billerid = $biller_array[2]->billerid;

            echo "\n billerid ".$billerid;

            //create instance of paymentitems
            $payment_items = new GetPaymentItems();

            $response = $payment_items->run($billerid);

            

            $response_code = json_decode($response["HTTP_CODE"]);
            $response_body = json_decode($response["RESPONSE_BODY"]);

            if($response_code == "200") {//get payment items successful

               
                $payment_items_array = $response_body->paymentitems;
                $first_payment_item = $payment_items_array[0];

                $id = $first_payment_item->paymentitemid;
                $name = $first_payment_item->paymentitemname;
                $amount = $first_payment_item->amount;

                echo $id." ".$name." ".$amount;
            }

        }
    }

    

    
 ?>