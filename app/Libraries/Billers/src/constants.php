<?php
    namespace Billers;
    
    class Constants{
        const GET_BILLERS_URL = "api/v2/quickteller/billers";
        const GET_CATEGORYS_URL = "api/v2/quickteller/categorys";
        const GET = "GET";
        const POST = "POST";
        const MAP = array(
            "categorys" => "api/v2/quickteller/categorys",
            "billers" =>"api/v2/quickteller/billers"
        );
        const GET_CATEGORYS_BILLERS_PREFIX = "api/v2/quickteller/categorys/";
        const GET_CATEGORYS_BILLERS_SUFFIX = "/billers";
        const GET_CATEGORY_BILLERS_PAYMENTITEMS_PREFIX = "api/v2/quickteller/billers/";
        const GET_CATEGORY_BILLERS_PAYMENTITEMS_SUFFIX = "/paymentitems";
        const TRANSACTION_INQUIRY_URL = "api/v2/quickteller/transactions/inquirys";
        const VALIDATE_CUSTOMER_URL = "api/v2/quickteller/customers/validations";
        const MAKE_PAYMENT_RESOURCE_URL = "api/v2/quickteller/sendAdviceRequest";
        const TRANSACTION_STATUS_RESOURCE_URL = "api/v2/quickteller/transactions";
    }
?>