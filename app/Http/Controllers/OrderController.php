<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use App\Order;
use App\Product;
use App\Payment;
use App\User;
use App\CouponUsage;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PDF;
use Mail;
use App\Http\Controllers\SpeedafController;
use App\Http\Controllers\PaymentController;
use App\Mail\InvoiceEmailManager;
class OrderController extends Controller
{
    //
    public function index()
    {
        //
        return view('admin.orders.index');
    }

    public function customer()
    {
        //
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->get();
        return view('pages.orders', compact('orders'));
    }
    public function seller()
    {
        //
        $seller_id = \App\Seller::where('id',Auth::user()->id)->first();
        $orders = OrderDetail::where('seller_id', $seller_id)->where('payment_status','paid')->get();
        return view('seller.sales', compact('orders'));
    }
    public function adminApproveOrder(Request $request, $id)
    {
        //
        $order = Order::find(decrypt($id));

        $order->approved = 1;

        if ($order->save()) {
            $success = 'Order ' . $order->code . ' approved successfully';
        } else {
            $error = 'Something went wrong';
        }

        return redirect()->back()->with(['error' => $error, 'success' => $success]);
    }

    public function adminCancelOrder(Request $request, $id)
    {
        //
        $order = Order::find(decrypt($id));

        $order->cancelled = 1;

        if ($order->save()) {
            $success = 'Order ' . $order->code . ' was cancelled';
        } else {
            $error = 'Something went wrong';
        }

        return redirect()->back()->with(['error' => $error, 'success' => $success]);
    }
    public function store(Request $request)
    {
        $error=$success="";
        $order = new Order;
        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        } else {
            $order->guest_id = mt_rand(100000, 999999);
        }

        $order->shipping_address = json_encode($request->shipping_info);

        $order->payment_type = $request->paymentMethod;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His') . rand(10, 99);
        $order->date = strtotime('now');

        if ($order->save()) {
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            if (Session::get('shipping') && Session::get('shipping') != 0){
                $shipping = Session::get('shipping');
            } 
            foreach (Session::get('cart') as $key => $cartItem) {
                $product = Product::find($cartItem['id']);

                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                // $tax += $cartItem['tax'] * $cartItem['quantity'];
                // $shipping += \App\Product::find($cartItem['id'])->shipping_cost * $cartItem['quantity'];


                $product_variation = $cartItem['variant'];

                if ($product_variation != null) {
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                } else {
                    $product->current_stock -= $cartItem['quantity'];
                    $product->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  = $order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                // $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = 'home_delivery';

                if ($order_detail->shipping_type == 'home_delivery') {
                    $order_detail->shipping_cost = \App\Product::find($cartItem['id'])->shipping_cost * $cartItem['quantity'];
                } else {
                    $order_detail->shipping_cost = 0;
                    $order_detail->pickup_point_id = $cartItem['pickup_point'];
                }

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if (Session::has('coupon_discount')) {
                $order->grand_total -= Session::get('coupon_discount');
                $order->coupon_discount = Session::get('coupon_discount');

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = Auth::user()->id;
                $coupon_usage->coupon_id = Session::get('coupon_id');
                $coupon_usage->save();
            }

            if ($order->save()){
                $saved = 1;
            };

            //stores the pdf for invoice
            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                'logOutputFile' => storage_path('logs/log.htm'),
                'tempDir' => storage_path('logs/')
            ])->loadView('invoices.customer_invoice', compact('order'));
            $output = $pdf->output();
            file_put_contents(public_path('invoices/') . 'Order#' . $order->code . '.pdf', $output);

            $array['view'] = 'emails.invoice';
            $array['subject'] = 'Order Placed - ' . $order->code;
            $array['from'] = env('MAIL_USERNAME');
            $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
            $array['file'] = public_path('invoices/') .'Order#' . $order->code . '.pdf';
            $array['file_name'] = 'Order#' . $order->code . '.pdf';

            $admin_products = array();
            $seller_products = array();
            foreach ($order->orderDetails as $key => $orderDetail) {
                if ($orderDetail->product->added_by == 'admin') {
                    array_push($admin_products, $orderDetail->product->id);
                } else {
                    $product_ids = array();
                    if (array_key_exists($orderDetail->product->user_id, $seller_products)) {
                        $product_ids = $seller_products[$orderDetail->product->user_id];
                    }
                    array_push($product_ids, $orderDetail->product->id);
                    $seller_products[$orderDetail->product->user_id] = $product_ids;
                }
            }

            foreach ($seller_products as $key => $seller_product) {
                try {
                    Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }

            // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value) {
            //     if (Auth::check() && Auth::user()->phone != null) {
            //         $otpController = new OTPVerificationController;
            //         $otpController->send_order_code($order);
            //     }
            // }

            //sends email to customer with the invoice pdf attached
            if (env('MAIL_USERNAME') != null) {
                try {
                    Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                    Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }
            unlink($array['file']);

            $request->session()->put('order_id', $order->id);
            $request->session()->put('payment_method', $request->paymentMethod);
            $shipping_info = $request->shipping_info;
            return view('pages.checkout',compact('error', 'success', 'saved' , 'shipping_info'));
            //return redirect()->back()->compact(['error' => $error, 'success' => $success, 'saved' => 1, 'shipping_info' => $request->shipping_info]);
            // return $this->payment($request);
            
        }
    }
    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('orders.show', compact('order'));
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        if ($order != null){
            $order->viewed = 1;
            $order->save();
        }
        
        return view('pages.order_details', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $order->save();
        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }

        // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
        //     if($order->user != null && $order->user->phone != null){
        //         $otpController = new OTPVerificationController;
        //         $otpController->send_delivery_status($order);
        //     }
        // }

        return 1;
    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();

        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status != 'paid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();

        if($order->payment_status == 'paid' && $order->commission_calculated == 0){
            if ($order->payment_type == 'cash_on_delivery') {

                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $commission_percentage = $orderDetail->product->category->commision_rate;
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                            $seller->save();
                        }
                    }

            }
            elseif($order->manual_payment) {

                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $commission_percentage = $orderDetail->product->category->commision_rate;
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
                            $seller->save();
                        }
                    }
            }

            // if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            //     $affiliateController = new AffiliateController;
            //     $affiliateController->processAffiliatePoints($order);
            // }

            // if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            //     $clubpointController = new ClubPointController;
            //     $clubpointController->processClubPoints($order);
            // }

            $order->commission_calculated = 1;
            $order->save();
        }

        // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value){
        //     if($order->user != null && $order->user->phone != null){
        //         $otpController = new OTPVerificationController;
        //         $otpController->send_payment_status($order);
        //     }
        // }
        return 1;
    }
    
        public function payment(Request $request)
    {
        $order = Order::findOrFail($request->session()->get('order_id'));
        $buyer_info  = json_decode($order->shipping_address);
        $request->session()->put('payment_type', 'order_payment');
        $request->session()->put('payment_method', Session::get('payment_method'));
        $data['email'] = $buyer_info->email;
        $data['amount'] = $order->grand_total;
        $request->session()->put('order_id', $order->id);

        $request->session()->put('payment_data', $data);
        
        
        
        $payment = new PaymentController;
        return $payment->directToGateway($request);
    }

    public function payment_done($payment)
    {
        $user = User::where('email', $payment['data']['customer']['email'])->first();
        
        // return $user;
        $transaction = Payment::where('txn_code',$payment['data']['reference'])->first();
        $transaction->payment_details = json_encode($payment);
        $transaction->approved = 1;
        $transaction->save();
        $order = Order::findOrFail($transaction->order_id);
        $buyer_info  = json_decode($order->shipping_address);
        $ordersD = OrderDetail::where('order_id', $order->id)->first();
        
        //Get product details
        $pro = Product::where('id', $ordersD->product_id)->first();
        
        $speedaf_price = $pro->unit_price * $ordersD->quantity;
        
        $speedaf_weight = $pro->unit_price * $ordersD->weight;
        
        
        //Initiate Speedaf to deliver products
        $speedaf = new SpeedafController;
        
        $orderID = mt_rand(111111111, 999999999);
        
        //prepare data to send
        $data = [

        "acceptAddress" => $buyer_info->address ,

        "acceptCityCode" => $buyer_info->city ,

        "acceptCityName" => $buyer_info->city ,

        "acceptCompanyName" => "EbeanoMarket" ,

        "acceptCountryCode" => "NG" ,

        "acceptCountryName" => "Nigeria" ,

        "acceptDistrictCode" => "acceptDistrictCode" ,

        "acceptDistrictName" => "acceptDistrictName" ,

        "acceptEmail" => $buyer_info->email ,

        "acceptMobile" => $buyer_info->phone ,

        "acceptName" => "acceptName" ,

        "acceptPhone" => "999999" ,

        "acceptPostCode" => "acceptPostCode" ,

        "acceptProvinceCode" => "acceptProvinceCode" ,

        "acceptProvinceName" => "acceptProvinceName" ,

        "codFee" => 700 ,

        "customOrderNo" => $orderID ,

        "customerCode" => "2340002" ,

        "goodsDesc" => (String) $pro->description ,

        "goodsHigh" => 0 ,

        "goodsLength" => 0 ,

        "goodsName" => (String) $pro->name ,

        "goodsPrice" => $speedaf_price ,

        "goodsQTY" => (int) $ordersD->quantity ,

        "goodsValue" => 100 ,

        "goodsVolume" => (int) $ordersD->quantity ,

        "goodsWeight" => $speedaf_weight ,

        "goodsWidth" => 0 ,

        "insurePrice" => 0 ,

        "itemList" => [

                [

                        "battery" => 0 ,

                        "blInsure" => 0 ,

                        "dutyMoney" => 1000 ,

                        "goodsId" => "19999" ,

                        "goodsMaterial" => "" ,

                        "goodsName" => "item mane" ,

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

        "sendAddress" => "sendAddress" ,

        "sendCityCode" => "sendCityCode" ,

        "sendCityName" => "sendCityName" ,

        "sendCompanyName" => "sendCompanyName" ,

        "sendCountryCode" => "CN" ,

        "sendCountryName" => "CHINA" ,

        "sendDistrictCode" => "sendDistrictCode" ,

        "sendDistrictName" => "sendDistrictName" ,

        "sendMail" => "sendMail" ,

        "sendMobile" => "sendMobile" ,

        "sendName" => "sendName" ,

        "sendPhone" => "sendPhone" ,

        "sendPostCode" => "sendPostCode" ,

        "sendProvinceCode" => "sendProvinceCode" ,

        "sendProvinceName" => "sendProvinceName" ,

        "shippingFee" => 1 ,

     "deliveryType" => "DE01" ,

     "payMethod" => "PA01" ,

  "parcelType" => "PT01" ,

     "shipType" => "ST01" ,

     "transportType" => "TT01" ,

     "platformSource" => "csp" ,

     "smallCode" => "" ,

     "threeSectionsCode" => ""

    ];
        $value_log = $speedaf->InitiateOrder($data);
        
        //Save Order ID
        $ordersD->track_id = $value_log['billCode'];
        
        //Save Biller ID
        $ordersD->bill_id = $value_log['customerOrderNo'];
        
        //Save Status Order
        $ordersD->track_status = $value_log['success'];
        
        $ordersD->save();
        
        $success = "Order was placed successfully, your tracking id is <strong>".$ordersD->track_id."</strong>";
        
        session()->forget('payment_method');
        session()->forget('payment_type');
        session()->forget('route');
        session()->forget('payment_data');
        session()->forget('email');
        session()->forget('order_id');
        
        
        return view('pages.checkout',compact('error', 'success', 'saved' , 'shipping_info'));
    }
}
