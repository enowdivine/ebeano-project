<?php
    namespace Billers\samples;
    use Billers\samples;
    use Billers;
    use Billers\samples\GetCategorys;

    require_once __DIR__ . '/../../vendor/autoload.php';

    class GetCategoryInBillers extends BaseSample{
        
        private $key = "billers-categorys";
        public function run($id){
            return $this->billPayment->get_category_billers($id);
        }
    }

    $category = new GetCategorys();

    $category_response = $category->run();

    if($category_response != null) {
        $response_code = json_decode($category_response["HTTP_CODE"]);
        $response_body = json_decode($category_response["RESPONSE_BODY"]);

        if($response_code == "200") {

            //get the categoryid of the first category
            $firstCategoryId = $response_body->categorys[0]->categoryid;

            echo "\n category id is ".$firstCategoryId;

            //we can get categorybillers
            $billers = new GetCategoryInBillers();

            $response = $billers->run($firstCategoryId);

            $response_code = json_decode($response["HTTP_CODE"]);
            $response_body = json_decode($response["RESPONSE_BODY"]);

            if($response_code == "200") {//response from second method call to get billers in a categorys

                  $billers_array = $response_body->billers;

                  $first_biller = $billers_array[0];

                  $id = $first_biller->categoryid;
                  $name = $first_biller->categoryname;

                  echo "\n first biller under category ".$id." ".$name;
            }


        }
    }
    //$billers = new GetCategoryBillers();
    
 ?>