<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class GetCategorys extends BaseSample{
        
        private $key="categorys";

        public function run(){
            return $this->billPayment->get($this->key);
        }
    }
///////////////////////////////////////////////////////////////////////
    $billers = new GetCategorys();

    $response = $billers->run();

    if($response != null) {
        
        $response_code = json_decode($response["HTTP_CODE"]);
        $response_body = json_decode($response["RESPONSE_BODY"]);

        if($response_code == "200") {

            $category_array = $response_body->categorys;

            $first = $category_array[0];

            $id = $first->categoryid;
            $name = $first->categoryname;
            $description = $first->categorydescription;

            echo $id." ".$name." ".$description;


        }
    }
    
////////////////////////////////////////////////////////////////////////////////////
    
 ?>