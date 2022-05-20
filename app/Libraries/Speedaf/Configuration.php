<?php 
return 
[
	// The secretkey and the customer code AppCode are provided by Su Da Fei
	'app_code' => "T660011",


    'secret_key' => "ovKINyTX23GBiKeU",
	
    'base_path' => 'http://47.241.40.42:8480', // kinldy replace this with the LIVE PATH like 'api.speedaf.com'



    /*
    Don't temper with the below settings 
    except you know what you are doing
	*/

	'sorting_code_by_waybill_path'  => '/open-api/network/threeSectionsCode/getByBillCode',
    'sorting_code_by_address_path' =>  '/open-api/network/threeSectionsCode/getByAddress',
    'create_order_path' => '/open-api/express/order/createOrder',
    'track_path' => '/open-api/express/track/query',
    'print_path' => '/open-api/express/order/print'
	
]

?>