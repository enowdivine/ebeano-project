<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<body>
    <?php 
    //STEP 1: include the required sdk files
     require('sdk/ApiServices.php');
     use speedaf\sdk\ApiServices as Apiservices;
     
     
     //STEP 2: Create ann instance of ApiServices
     $api_services = new Apiservices();





     //STEP 3: Perform the desired operation


    //-------------------------CREATE ORDER EXAMPLE: format your operation like the one below---------------------------------

    $order_parameters = [

        "acceptAddress" => "detial acceptAddress" ,

        "acceptCityCode" => "IF Dont have  ,no need fill" ,

        "acceptCityName" => "acceptCityName" ,

        "acceptCompanyName" => "IF Dont have  ,no need fill" ,

        "acceptCountryCode" => "EG" ,

        "acceptCountryName" => "Egypt" ,

        "acceptDistrictCode" => "IF Dont have  ,no need fill" ,

        "acceptDistrictName" => "acceptDistrictName" ,

        "acceptEmail" => "IF Dont have  ,no need fill" ,

        "acceptMobile" => "1778922222,its  must" ,

        "acceptName" => "acceptName" ,

        "acceptPhone" => "999999" ,

        "acceptPostCode" => "IF Dont have  ,no need fill" ,

        "acceptProvinceCode" => "IF Dont have  ,no need fill" ,

        "acceptProvinceName" => "acceptProvinceName" ,

        "codFee" => if COD pls FILL  ,

        "customOrderNo" => "your own order No" ,

        "customerCode" => "speedaf give you" ,


        "parcelHigh" => just for international goods ,

        "parcelLength" => just for international goods ,


        "goodsQTY" => Goods total quantity ,


        "parcelVolume" =>just for international goods ,

        "parcelWeight" =>just for international goods ,

        "parcelWidth" => just for international goods		,

        "insurePrice" => just for international goods ,

        "itemList" => [

                [

                        "battery" => 0 ,

                        "blInsure" => 0 ,

                        "dutyMoney" => 1000 ,

                        "goodsId" => "19999" ,

                        "goodsMaterial" => "" ,

                        "goodsName" => "item english mane" ,

                        "goodsNameDialect" => "item namme" ,

                        "goodsQTY" => 1 ,

                        "goodsRemark" => "goodsRemark" ,

                        "goodsRule" => "goodsRule" ,

                        "goodsType" => "IT02" ,

                        "goodsUnitPrice" => 1 ,

                        "goodsValue" => 1 ,

                        "goodsWeight" => 1 ,

                        "high" => 1 ,

                        "length" => 1 ,

                        "makeCountry" => "makeCountry" ,

                        "salePath" => "salePath" ,

                        "sku" => "sku001" ,

                        "unit" => "" ,

                        "width" => 1

                ]

        ],

        "piece" => 1 ,

        "remark" => "1" ,

        "sendAddress" => "detail sendAddress" ,

        "sendCityCode" => "IF Dont have  ,no need fill" ,

        "sendCityName" => "sendCityName" ,

        "sendCompanyName" => "your company  name" ,

        "sendCountryCode" => "EG" ,

        "sendCountryName" => "Egypt" ,

        "sendDistrictCode" => "IF Dont have  ,no need fill" ,

        "sendDistrictName" => "sendDistrictName" ,

        "sendMail" => "sendMail" ,

        "sendMobile" => "sendMobile" ,

        "sendName" => "sendName" ,

        "sendPhone" => "sendPhone" ,

        "sendPostCode" => "sendPostCode" ,

        "sendProvinceCode" => "IF Dont have  ,no need fill" ,

        "sendProvinceName" => "sendProvinceName" ,

        "shippingFee" => IF Dont have  ,no need fill ,

     "deliveryType" => "DE01" ,

     "payMethod" => "PA02" ,

  "parcelType" => "PT01" ,

     "shipType" => "ST01" ,

     "transportType" => "TT01" ,

     "platformSource" => "speedaf give you" ,

     "smallCode" => "" ,

     "threeSectionsCode" => ""

    ];


    try
    {

        $create_order_result = $api_services->createOrder($order_parameters);
        echo"<br/>-----------------------------<br/>";
        var_dump($create_order_result);
        echo"<br/>-----------------------------<br/>";
    }
    catch(Exception $ex)
    {
        echo"<br/>-----------------------------<br/>";
        echo $ex->getMessage();
        echo"<br/>-----------------------------<br/>";
    }






    //To Track a Waybill. Format your parameters like the one below
    $track_parameters =  [

        "mailNoList" => ["86254200001257"]

        ];
    
    try
    {

        $track_result  = $api_services->track($track_parameters);

        echo"<br/>-----------------------------<br/>";

        var_dump($track_result);

        echo"<br/>-----------------------------<br/>";
    }
    catch(Exception $ex)
    {
        echo"<br/>-----------------------------<br/>";

        echo $ex->getMessage();

        echo"<br/>-----------------------------<br/>";
    }



?>
</body>
</html>