<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class GetBillers extends BaseSample{
        
        private $key = "billers";
        public function run(){
            return $this->billPayment->get($this->key);
        }
    }


    //////// 
    //////////////////////////////////////////////////////////////////////////////////////////////////

    $billers = new GetBillers();

    $response = $billers->run();

    if($response != null) {

        $response_code = json_decode($response["HTTP_CODE"]);
        $response_body = json_decode($response["RESPONSE_BODY"]);

        $biller_array = $response_body->billers;//billers array from response

        $first_biller = $response_body->billers[0];//first biller, index 0
        
        $biller_id = $first_biller->billerid; //billerid of first biller
        $biller_name = $first_biller->billername; //biller name of first biller
        
        echo $biller_id." ".$biller_name;
//////////////////////////////////////////////////////////////////////////////////////////////////
    }
 ?>