<?php

namespace App\Http\Controllers;

use App\Helpers\MimeCheckRules;
use App\User;
use App\BookingClients;
use App\BookingFloor;
use App\BookingReservation;
use App\BookingReservationNight;
use App\BookingReservationPaidService;
use App\BookingReservationTax;
use App\BookingRoom;
use App\BookingRoomType;
use App\BookingRoomTypeImage;
use App\BookingTaxManager;
use App\BookingTransaction;
use App\BookingAppliedCouponCode;
use App\BookingCouponMaster;
use App\BookingPaidService;
use App\BookingPayment;
use App\BookingAmenity;
use App\BookingRegularPrice;
use App\BookingSpecialPrice;
use App\FlightBooking;
use App\FlightPartners;
use App\FlightAvailable;
use Carbon\Carbon;
use Image;
use \Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Session;

class BookingsController extends Controller
{
    /**
     * @var Resarvation
     */
    private $resarvation;
    /**
     * @var User
     */
    private $guests;
    /**
     * @var RoomType
     */
    private $roomType;
    /**
     * @var TaxManager
     */
    private $taxManager;
    /**
     * @var CouponMaster
     */
    private $couponMaster;
    /**
     * @var Reservation
     */
    private $reservation;
    /**
     * @var ReservationNight
     */
    private $night;
    /**
     * @var ReservationTax
     */
    private $reservationTax;
    /**
     * @var ReservationPaidService
     */
    private $res_paid_service;
    /**
     * @var AppliedCouponCode
     */
    private $appliedCouponCode;
    /**
     * @var Payment
     */
    private $payment;
    /**
     * @var PaidService
     */
    private $paidService;
    public function __construct(
                BookingClients $guests,
                BookingRoomType $roomType,
                BookingTaxManager $taxManager,
                BookingCouponMaster $couponMaster,
                BookingReservation $reservation,
                BookingReservationNight $night,
                BookingReservationTax $reservationTax,
                BookingReservationPaidService $res_paid_service,
                BookingAppliedCouponCode $appliedCouponCode,
                BookingPayment $payment, BookingPaidService $paidService
        )
    {
        if(!Auth::check()){
            return redirect('login/booking');
        }
        if(Auth::check() && Auth::user()->bookingclient->client_type ==null){
            return Redirect("user/profile/edit")->with(['error'=>'Opps! Please, complete your profile']);
        }
        
        if(Auth::check() && Auth::user()->bookingclient->client_type ==2){
            return Redirect("create-flight-partner")->with(['error'=>'Opps! Please, register your flight partner']);
        }
        
        $this->guests = $guests;
        $this->roomType = $roomType;
        $this->taxManager = $taxManager;
        $this->couponMaster = $couponMaster;
        $this->reservation = $reservation;
        $this->night = $night;
        $this->reservationTax = $reservationTax;
        $this->res_paid_service = $res_paid_service;
        $this->appliedCouponCode = $appliedCouponCode;
        $this->payment = $payment;
        $this->paidService = $paidService;
    }
    
    //index controller
    public function index(){
        $dd =$this->getRoomByDate(1,Carbon::parse('2019/04/24')->format('Y/m/d'),Carbon::parse('2019/04/27')->subDay()->format('Y/m/d'));

        $data['search'] = [
            'arrival'=>'',
            'departure'=>'',
            'adults'=>'',
            'children'=>'',
            'trip_from'=>'',
            'trip_to'=>'',
            'trip_type'=>'',
        ];
        $data['room_types'] = BookingRoomType::whereStatus(1)->inRandomOrder()->take(3)->paginate(20);
        $data['services'] = BookingPaidService::whereStatus(1)->inRandomOrder()->get();
        $data['flightAvailable'] = FlightAvailable::whereStatus(1)->latest()->paginate(20);
        session()->forget('reservation');
        $data['page_title'] = "Welcome to Ebeano Bookings";
        return view('bookings.welcome', $data);
    }
    
    //filter controller
    public function filterCategory($service){
        if($service =='hotel') {
            echo GetHotelLowestPrice(1);
            /*foreach(DrawHotelsByGroup(2, true, false) as $d){
                echo $d->hdescription->name."<br>";
            }*/
        }
    }
    
    public function dashboard(){
        if(Auth::check() && Auth::user()->bookingclient->client_type ==2 && FlightPartners::where('user_id', Auth::user()->id)->count() < 1){
            return Redirect("booking/agent/create-flight-partner")->with(['error'=>'Opps! Please, register your flight partner']);
        }
        $page_title = 'Booking Agent Dashboard';
        $data['floor_plan'] = BookingFloor::get();
        $data['room_type'] = BookingRoomType::get();
        
        //flight agent
        if(Auth::user()->bookingclient->client_type ==2){
            $data['flights'] = FlightBooking::where('flight_id', FlightPartners::where('user_id', Auth::user()->id)->first()->id)->latest()->paginate(20);
        }
        
        $data['date']=\request()->date?Carbon::parse(\request()->date)->format('Y-m-d'):Carbon::now()->format('Y-m-d');
        $data['current_reservation'] = BookingReservation::whereHas('night',function ($q){
            $q->where('date',Carbon::now()->format('Y-m-d'));
        })->whereNotIn('status',['CANCEL'])->get();

        $data['upcoming_reservation'] = BookingReservation::whereNotIn('status',['CANCEL'])->where('check_in','>',Carbon::now()->format('Y-m-d'))->get();
        $total_chart = $this->chartData();
        return view('bookings.dashboard',compact('data','total_chart','page_title'));
    }
    public function chartData(){
        $subscribe = BookingReservation::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $monthly_chart =collect([]);
        foreach (month_arr() as $key => $value) {
            $monthly_chart->push([
                'month' => Carbon::parse(date('Y').'-'.$key)->format('Y-m'),
                'online' =>$subscribe->has($value)?$subscribe[$value]->where('online',1)->count():0,
                'offline' =>$subscribe->has($value)?$subscribe[$value]->where('online',0)->count():0,
            ]);

        }
        return response()->json($monthly_chart->toArray())->content();
    }
    
    /* Reservation Controller */
    public function reservations($booking_type = null){
        $reservations = $this->reservation;
        if(null !== $booking_type){
            if(!in_array($booking_type,['online','offline']))
                abort(404);
            $reservations=$reservations->where('online',$booking_type=== 'online'?1:0);
        }

        $reservations=BookingReservation::latest()->paginate(20);

        return view('bookings.hotel.reservations.index',compact('reservations'));
    }

    public function create_reservation(){

        $booking_night = [];
        foreach ($this->availableRoom_reservation(1) as $key=>$value){
            if(!$value['available_room']->count()){
                $booking_night[] = $key;
            }
        }
        $tax = BookingtaxManager::whereStatus(1)->get()->map(function ($item, $key) {
            $item['value'] =0;
            return $item;
        });
        $guests = BookingClients::where('status',1)->get();
        $room_types = BookingRoomType::whereStatus(1)->get();
        return view('bookings.hotel.reservations.create',compact('guests','room_types','tax'));
    }
    public function store_reservation(Request $request){
        $this->validate($request,[
            'guest'=>'required|integer',
            'room_type'=>'required|integer',
            'adults'=>'required|integer|min:1',
            'kids'=>'required|integer|min:0',
            'check_in'=>'required|date|after_or_equal:toady',
            'check_out'=>'required|date|after_or_equal:check_in',
            'night_list'=>'required',
            'number_of_room'=>'required'
        ]);
        DB::beginTransaction();
        $i =0;
        try{
            $reservation = new $this->reservation;
            $reservation->uid = rand(1111,9999).'-'.time();
            $reservation->user_id = $request->guest;
            $reservation->room_type_id = $request->room_type;
            $reservation->adults = $request->adults;
            $reservation->kids = $request->kids;
            $reservation->check_in = $request->check_in;
            $reservation->check_out = $request->check_out;
            $reservation->number_of_room = $request->number_of_room;
            $reservation->status = 'SUCCESS';
            $reservation->save();

            foreach ($request->night_list as $v){
                foreach ($v['room'] as $r){
                    $night = new $this->night;
                    $night->reservation_id = $reservation->id;
                    $night->date = $v['date'];
                    $night->check_in = Carbon::parse($v['check_in']['date']);
                    $night->check_out = Carbon::parse($v['check_out']['date']);
                    $night->price = $v['price'];
                    $night->room_id = $r;
                    $night->save();
                }

            }

            foreach ($request->tax as $v){
                $tax = new $this->reservationTax;
                $tax->reservation_id = $reservation->id;
                $tax->tax_id = $v['id'];
                $tax->type = $v['type'];
                $tax->value = $v['rate'];
                $tax->price = $v['value'];
                $tax->save();
            }
            if($request->apply_coupon){
                $appliedCouponCode = new $this->appliedCouponCode;
                $appliedCouponCode->reservation_id = $reservation->id;
                $appliedCouponCode->coupon_id = $request->coupon['id'];
                $appliedCouponCode->user_id = $request->guest;
                $appliedCouponCode->date = Carbon::now();
                $appliedCouponCode->coupon_type = $request->coupon['type'];
                $appliedCouponCode->coupon_rate =  $request->coupon['value'];
                $appliedCouponCode->save();
            }
            $status = true;
            DB::commit();
        }catch (\Exception $e){
            $status = false;
            DB::rollback();
        }
        if($status){
            return response()->json([
                'status'=>'ok',
                'message'=>'Reservation success',
                'url'=>route('bookings.hotel.reservations.view',$reservation->id)
            ]);
        }
        return response()->json([
            'status'=>'error',
            'message'=>$e->getMessage()
        ]);
    }
    public function view_reservation($id){
        $reservation = $this->reservation->findOrFail($id);
        $paid_services = $this->paidService->whereStatus(1)->get();
        $gateways = $this->gateway->whereStatus(1)->where('is_offline',1)->get();
        return view('bookings.hotel.reservations.view',compact('reservation','gateways','paid_services'));
    }
    public function confirm_reservation($id){
        $reservation = $this->reservation->findOrFail($id);
        $night =  $reservation->night->groupBy('date');
        $room_type = RoomType::findOrFail($reservation->room_type_id);
        $night_data = [];
        foreach ($night as $key=>$ngt){
            $night_data[$key] = [];
            foreach ($room_type->room as $rm){
                $isbooked =  ReservationNight::where('room_id',$rm->id)
                    ->whereNotNull('room_id')
                    ->whereHas('reservation',function ($q){
                        $q->whereIn('status',['SUCCESS','PENDING']);
                    })
                    ->where('date',$key)->count();
                if($isbooked==0){
                    $night_data[$key][]=$rm;
                }
            }

        }
        return view('bookings.hotel.reservations.confirm',compact('reservation','night_data'));
    }
    public function confirmPost_reservation(Request $request,$id){
        if(!$request->room){
            return back()->with('error','Room Shortage');
        }
        $reservation = $this->reservation->findOrFail($id);
        $night =  $reservation->night->groupBy('date');
        if($reservation->night->where('room_id',null)->count()){
            foreach ($night as $key=>$ngt){
                if(!array_key_exists($key,$request->room)){
                    return back()->with('error','Properly select room');
                }
                if(count($request->room[$key]) < $reservation->number_of_room){
                    return back()->with('error','Room Shortage');
                }
            }
            foreach ($request->room as $key=>$rn){
                foreach ($rn as $v){
                    if($upd_n = $reservation->night->where('room_id',null)->where('date',$key)->first()){
                        $upd_n->room_id = $v;
                        $upd_n->save();
                    }
                }

            }
        }

        $reservation->status = 'SUCCESS';
        $reservation->save();
        return redirect()->route('bookings.hotel.reservations.view',$id)->with('success','Room Shortage');
    }
    public function changeStatus_reservation ($id,$status){
        $reservation = $this->reservation->findOrFail($id);
        if(!in_array($status,['pending','success','cancel']))
            abort(401);
        $reservation->status = strtoupper($status);
        $reservation->save();
        return back()->with('success','Status change Successful');
    }
    public function payment_reservation(Request $request,$id){
       $this->validate($request,[
          'payment_method'=>'required',
          'amount'=>'required|numeric|min:1'
       ]);
       $reservation = $this->reservation->findOrFail($id);
        $payment = new $this->payment;
        $payment->gateway_id = $request->payment_method;
        $payment->user_id = $reservation->user_id;
        $payment->reservetion_id = $id;
        $payment->amount = $request->amount;
        $payment->trx = time().'-'.rand(1111,9999);
        $payment->status =1;
        $payment->type ='offline';
        $payment->save();
        $tran = new BookingTransaction();
        $tran->user_id = $reservation->user_id;
        $tran->gateway_id = $request->payment_method;
        $tran->amount = $request->amount;
        $tran->remarks = 'Payment for room reservation';
        $tran->trx = $payment->trx;
        $tran->save();
        return back()->with('success','Payment Successful');
    }
    public function addService_reservation(Request $request,$id){
       $this->validate($request,[
          'service'=>'required|integer',
          'qty'=>'required|integer|min:1'
       ]);
       $reservation = $this->reservation->findOrFail($id);
       $paid_service = $this->paidService->findOrFail($request->service);
        $service = new $this->res_paid_service;
        $service->date =Carbon::now();
        $service->reservation_id =$reservation->id;
        $service->pad_service_id = $request->service;
        $service->value = $paid_service->price;
        $service->qty = $request->qty;
        $service->price = $paid_service->price*$request->qty;
        $service->save();
        return back()->with('success','Service added Successful');
    }
    public function removeService_reservation($id){
        $reservation = $this->res_paid_service->findOrFail($id)->delete();
        return back()->with('success','Service remove Successful');
    }
    public function cancelRoom_reservation($id){
        $reservation = $this->night->findOrFail($id)->delete();
        return back()->with('success','Room cancel Successful');
    }
    public function getRoomTypeDetails_reservation(Request $request){
        $paid_service = [];
        if($room_type = $this->roomType
            ->where('id',$request->room_type)->first()){
            $booking_night = [];
            foreach ($this->availableRoom($request->room_type) as $key=>$value){
                if(!$value['available_room']->count()){
                    $booking_night[] = $key;
                }
            }
            return response()->json([
                'status'=>'ok',
                'message'=>'success',
                'room_type'=>$room_type,
                'booking_date'=>$booking_night
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'error',
                'room_type'=>[],
                'paid_service'=>$paid_service
            ]);
        }



    }

    public function getNightCalculation_reservation(Request $request){
        $data =[];
        $night_calculation = $this->nightCalculation([$request->check_in,$request->check_out],['13:30:00','12:00:00']);
        $total_price =0;
        $room_type = BookingRoomType::findOrFail($request->room_type);
        $number_of_room = $request->number_of_room;
        foreach ($night_calculation as $k=>$v){

            $booking_night = $this->availableRoom($request->room_type,$request->check_in);
            $room_option = $room_type->room;
            if(array_key_exists($k,$booking_night)){
                $room_option = $booking_night[$k]['available_room'];
            }
            $price = $this->getPrice($k,$room_type);

            $selected_room = [];
            $r = 0;
            foreach ($room_option as $va){
                $r++;
                $selected_room[] = $va->id;
                if($number_of_room == $r){
                    break;
                }
            }
            $total_price +=$price*$r;
            $data[] = [
                'date'=>$k,
                'check_in'=>$v['start'],
                'check_out'=>$v['end'],
                'price'=>$price,
                'room_option'=>$room_option,
                'room'=>$selected_room,
                'room_qty'=>$r,
                'total_price'=>$total_price
            ];

        }

        $total_night =count($night_calculation);


        return response()->json([
           'status'=>'ok',
           'message'=> $night_calculation,
            'data'=>[
                'night_list'=>$data,
                'total_night'=>$total_night,
                'total_price'=>$total_price,
            ]
        ]);
    }
    public function getCheckOutAvailableDate_reservation(Request $request){
        $date = '';
        foreach ($this->availableRoom($request->room_type,$request->check_in_date) as $key=>$value){
            if(!$value['available_room']->count()){
                $date =Carbon::parse($key)->subDay()->format('Y/m/d') ;
                break;
            }
        }
        return response()->json([
            'status'=>'ok',
            'message'=>'success',
            'check_in_date'=>$request->room_type,
            'max_date'=>$date,
        ]);
    }
    public function applyCoupon_reservation(Request $request){
        $this->validate($request,[
            'coupon_code'=>'required',
            'guest'=>'required|integer'
        ]);
        $response = [];
        if($coupon = $this->couponMaster->where('code',$request->coupon_code)->first()){
            if(!$coupon->hasCoupon($request->guest,$request->amount)){
                throw ValidationException::withMessages([
                    'coupon_code' => [$coupon->getMessage($request->guest,$request->amount)]
                ]);
            }else{
                $response['status']='ok';
                $response['message']='Coupon apply success';
                $response['data']=$coupon;
            }
        }else{
            throw ValidationException::withMessages([
                'coupon_code' => ['Code is invalid']
            ]);
        }
        return response()->json($response);
    }
    /**
     * Trait create
     */
    public function availableRoom_reservation(int $room_type,$afterDate = null){
        $booking_night = BookingReservationNight::whereHas('reservation',function($q) use($afterDate,$room_type) {
                $q->where('room_type_id',$room_type)->whereNotIn('status',['CANCEL','ONLINE_PENDING']);
            })
            ->where('date','>=',$afterDate!==null?$afterDate:date('Y/m/d'))->orderBy('date')->get()->groupBy('date');
        $date =[];
        foreach ($booking_night as $key=>$night){
            $night_booking = $night->pluck('room_id')->toArray();
            $date[date('Y/m/d',strtotime($key))] = [
                'reservation'=>$night,
                'booking_room'=>BookingRoom::find($night_booking),
                'available_room'=>BookingRoom::where('room_type_id',$room_type)->whereNotIn('id', $night_booking)->get()
            ];
        }
        return $date;
    }
    protected function nightCalculation(array $night_range,array $range_setup){

        $result = [];
        $date_range = $this->date_range($night_range[0],$night_range[1]);
        foreach ($date_range as $k=>$v){
            $s = Carbon::parse($v.' '.$range_setup[0]);
            $e = Carbon::parse($v.' '.$range_setup[0])->addHours(24)->format('Y/m/d');
            $result[$v]  = [
                'start'=>$s,
                'end'=>Carbon::parse($e.' '.$range_setup[1])
            ];
        }
        return $result;
    }
   protected function date_range($first, $last, $step = '+1 day', $output_format = 'Y/m/d' ) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
    
    /* Guest Controller */
    public function guest(){
        $guests = BookingClients::paginate(15);
        return view('bookings.hotel.guests.index',compact('guests'));
    }
    public function create_guest(){
        return view('bookings.hotel.guests.create');
    }
    public function store_guest(Request $request){
        $this->validate($request,[
            'username'=>'required|max:191|string|unique:users',
            'first_name'=>'required|max:191|string',
            'last_name'=>'required|max:191|string',
            'phone'=>'required|max:191|string',
            'email'=>'required|max:191|string',
            'address'=>'required|string',
            'sex'=>'required|string',
            'password'=>'required|string',
            'picture'=>['nullable',new MimeCheckRules(['png']),'max:2048','image'],
            'id_card_image'=>['nullable',new MimeCheckRules(['png','jpg']),'max:2048','image'],
        ]);
        
        $user_data = array(
            'name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'referer' => Auth::user()->referer,
            'password' => Hash::make($request->password),
            'user_type' => 'booking_guest',
            
        );

        $check = User::create($user_data);
            
        $guests = new BookingClients;
        $guests->user_id = $check;
        $guests->username = $request->username;
        $guests->first_name = $request->first_name;
        $guests->last_name = $request->last_name;
        $guests->phone = $request->phone;
        $guests->email = $request->email;
        $guests->dob = $request->dob;
        $guests->address = $request->address;
        $guests->sex = $request->sex;
        if($request->has('picture')){
            $path_pic = 'assets/booking/assets/backend/image/guest/pic/';
            $guests->picture = 'pic_'.time().'.png';
            Image::make($request->picture)->save($path_pic.$guests->picture);
        }
        //$guests->password = bcrypt($request->password);
        $guests->id_type = $request->id_type;
        $guests->id_number = $request->id_number;
        if($request->has('id_card_image')){
            $path_card_image = 'assets/booking/assets/backend/image/guest/card_image/';
            $guests->id_card_image = 'id_'.time().'.'.$request->id_card_image->getClientOriginalExtension();
            Image::make($request->id_card_image)->save($path_card_image.$guests->id_card_image);
        }
        $guests->remarks = $request->remarks;
        $guests->vip = $request->has('vip')?1:0;
        $guests->status = $request->has('status')?1:0;
        $guests->save();
        return redirect()->back()->with('success','Guest save successful');
    }
    public function view_guest($id){
        $guest = BookingClients::findOrFail($id);
        return view('bookings.hotel.guests.view',compact('guest'));
    }

    public function update_guest(Request $request,$id){
        $this->validate($request,[
            'first_name'=>'nullable|max:191|string',
            'last_name'=>'nullable|max:191|string',
            'phone'=>'required|max:191|string',
            'email'=>'required|max:191|string',
            'address'=>'nullable|string',
            'sex'=>'required|string',
            'picture'=>['nullable',new MimeCheckRules(['png']),'max:2048','image'],
            'id_card_image'=>['nullable',new MimeCheckRules(['png','jpg']),'max:2048','image'],
        ]);
        
        $guests = BookingClients::findOrFail($id);
        $user = User::findOrFail($guests->user_id);
        
        $guests->first_name = $request->first_name;
        $guests->last_name = $request->last_name;
        $guests->phone = $request->phone;
        $guests->email = $request->email;
        $guests->address = $request->address;
        $guests->sex = $request->sex;
        $guests->dob = $request->dob;
        if($request->has('picture')){
            $path_pic = 'assets/booking/assets/backend/image/guest/pic/';
            @unlink($path_pic.$guests->picture);
            $guests->picture = 'pic_'.time().'.png';
            Image::make($request->picture)->save($path_pic.$guests->picture);
        }
        $user->password = Hash::make($request->password);
        $guests->id_type = $request->id_type;
        $guests->id_number = $request->id_number;
        if($request->has('id_card_image')){
            $path_card_image = 'assets/booking/assets/backend/image/guest/card_image/';
            @unlink($path_card_image.$guests->id_card_image);
            $guests->id_card_image = 'id_'.time().'.'.$request->id_card_image->getClientOriginalExtension();
            Image::make($request->id_card_image)->save($path_card_image.$guests->id_card_image);
        }
        $guests->remarks = $request->remarks;
        $guests->vip = $request->has('vip')?1:0;
        $guests->status = $request->has('status')?1:0;
        $guests->save();
        return redirect()->back()->with('success','Guest update successful');
    }
    
    /* RoomType Controller */
    public function roomtype(){
        $roomTypes = BookingRoomType::get();
        return view('bookings.hotel.roomtype.index',compact('roomTypes'));
    }
    public function create_roomtype(){
        $amenities = BookingAmenity::where('status',1)->get();
        return view('bookings.hotel.roomtype.create',compact('amenities'));
    }

    public function store_roomtype(Request $request){
        $request['slug'] = Str::slug($request->title);
        $this->validate($request,[
            'title'=>'required|max:191|unique:room_types',
            'slug'=>'required|max:191|unique:room_types',
            'short_code'=>'required|max:191|unique:room_types',
            'higher_capacity'=>'required|integer|min:1',
            'kids_capacity'=>'required|integer|min:0',
            'base_price'=>'required|numeric|min:0',
            'amenities'=>'nullable'
        ]);
        $roomType= new BookingRoomType;
        $roomType->title = $request->title;
        $roomType->slug = $request->slug;
        $roomType->short_code = $request->short_code;
        $roomType->description = $request->description;
        $roomType->higher_capacity = $request->higher_capacity;
        $roomType->kids_capacity = $request->kids_capacity;
        $roomType->base_price = $request->base_price;
        $roomType->status = $request->has('status')?1:0;
        $roomType->save();
        if($request->has('amenities')){
            $roomType->amenity()->attach($request->amenities);
        }

        return redirect()->back()->with('success','Save successful');
    }

    public function view_roomtype($id){
        $roomType = BookingRoomType::with('roomTypeImage')->findOrFail($id);
        return view('bookings.hotel.roomtype.view',compact('roomType'));
    }
    public function edit_roomtype($id){
        $roomType = BookingRoomType::findOrFail($id);
        $amenities = BookingAmenity::where('status',1)->get();
        return view('bookings.hotel.roomtype.edit',compact('roomType','amenities'));
    }
    public function update_roomtype(Request $request,$id){
        $request['slug'] = Str::slug($request->title);

        $this->validate($request,[
            'title'=>'required|max:191|unique:room_types,title,'.$id,
            'slug'=>'required|max:191|unique:room_types,slug,'.$id,
            'short_code'=>'required|max:191|unique:room_types,short_code,'.$id,
            'higher_capacity'=>'required|integer|min:1',
            'kids_capacity'=>'required|integer|min:0',
            'base_price'=>'required|numeric|min:0',
            'amenities'=>'nullable'
        ]);
        $roomType = BookingRoomType::findOrFail($id);
        $roomType->title = $request->title;
        $roomType->slug = $request->slug;
        $roomType->short_code = $request->short_code;
        $roomType->description = $request->description;
        $roomType->higher_capacity = $request->higher_capacity;
        $roomType->kids_capacity = $request->kids_capacity;
        $roomType->base_price = $request->base_price;
        $roomType->status = $request->has('status')?1:0;
        $roomType->save();
        if($request->has('amenities')){
            $roomType->amenity()
            ->sync($request->amenities);
        }else{
            $roomType->amenity()
                ->sync([]);
        }
        return redirect()->back()->with('success','Update successful');
    }
    public function delete_roomtype($id){
        BookingAmenity::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }

    /**
     *Upload image
     */
    public function uploadImage_roomtype(Request $request){
        $this->validate($request,[
            'room_type'=>'required|integer',
            'image'=>['required','max:2048','image',new MimeCheckRules(['jpg'])]
        ]);
        if(($featured_image = BookingRoomTypeImage::where('featured',1)->where('room_type_id', $request->room_type)->first()) && $request->has('featured')){
            $featured_image->featured = 0;
            $featured_image->save();
        }
        $roomTypeImage = new BookingRoomTypeImage;
        $roomTypeImage->room_type_id = $request->room_type;
        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/room_type_image/';
            $path_th = 'assets/booking/assets/backend/image/room_type_image_th/';
            $roomTypeImage->image = time().'_'.$request->room_type.'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(350,270)->save($path_th.$roomTypeImage->image);
            Image::make($request->image)->save($path.$roomTypeImage->image);
        }

        $roomTypeImage->featured = $request->has('featured')?1:0;
        $roomTypeImage->save();
        return redirect()->back()->with('success','Upload successful');
    }
    public function deleteImage_roomtype (Request $request){
        $room_type_img = BookingRoomTypeImage::findOrFail($request->id);
        $path = 'assets/booking/assets/backend/image/room_type_image/';
        $path_th = 'assets/booking/assets/backend/image/room_type_image_th/';
        @unlink($path.$room_type_img->image);
        @unlink($path_th.$room_type_img->image);
        $room_type_img->delete();
        return redirect()->back()->with('success','Delete successful');

    }
    public function setAsFeatured_roomtype($room_type_id,$id){
        if($featured_image =BookingRoomTypeImage::where('featured',1)->where('room_type_id', $room_type_id)->first()){
            $featured_image->featured = 0;
            $featured_image->save();
        }
        $roomTypeImage = BookingRoomTypeImage::findOrFail($id);
        $roomTypeImage->featured = 1;
        $roomTypeImage->save();
        return redirect()->back()->with('success','Upload successful');
    }

    public function regularPriceUpdate_roomtype(Request $request,$id){
        $this->validate($request,[
            'day'=>'required'
        ]);
        $roomType = BookRoomType::findOrFail($id);
        if(!$regularPrice =$roomType->regularPrice){
            $regularPrice = new BookingRegularPrice;
            $regularPrice->room_type_id = $id;
        }
        foreach ($request->day as $key=>$value){
            $this->validate($request,[
                'day.1.amount'=>'required|numeric|min:0'
            ],[
                'day.1.amount.required'=>days_arr()[$key].' amount is required',
                'day.1.amount.min'=>days_arr()[$key].' amount must be at last 0',
                'day.1.amount.numeric'=>days_arr()[$key].' amount must be numeric',
            ]);
            $regularPrice['day_'.$key] =$value['amount']?$value['type']:'ADD';

            $regularPrice['day_'.$key.'_amount'] =$value['amount'];
        }
        $regularPrice->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function specialPriceUpdate_roomtype(Request $request,$id){
        $this->validate($request,[
            'day'=>'required',
            'title'=>'required',
            'start_time'=>'required|date|after_or_equal:today',
            'end_time'=>'required|date|after_or_equal:period_start_time',
        ]);
        $roomType = BookingRoomType::findOrFail($id);
        $specialPrice = new BookingSpecialPrice;
        $specialPrice->room_type_id = $id;
        $specialPrice->title =$request->title;
        $specialPrice->start_time =$request->start_time;
        $specialPrice->end_time =$request->end_time;
        foreach ($request->day as $key=>$value){
            $this->validate($request,[
                'day.1.amount'=>'required|numeric|min:0'
            ],[
                'day.1.amount.required'=>days_arr()[$key].' amount is required',
                'day.1.amount.min'=>days_arr()[$key].' amount must be at last 0',
                'day.1.amount.numeric'=>days_arr()[$key].' amount must be numeric',
            ]);
            $regularPrice['day_'.$key] =$value['amount']?$value['type']:'ADD';

            $regularPrice['day_'.$key.'_amount'] =$value['amount'];
        }
        $specialPrice->save();
        return redirect()->back()->with('success','Save successful');
    }
    
    /* Room Controller */
    public function room(){
        $rooms = BookingRoom::paginate(15);
        return view('bookings.hotel.rooms.index',compact('rooms'));
    }
    public function create_room(){
        $floors = BookingFloor::where('status',1)->get();
        $room_types = BookingRoomType::where('status',1)->get();
        return view('bookings.hotel.rooms.create',compact('floors','room_types'));
    }

    public function store_room(Request $request){
        $this->validate($request,[
            'room_type'=>'required|integer',
            'floor'=>'required|integer',
            'number'=>'required|integer|unique:rooms',
            'image'=>[new  MimeCheckRules(['jpg']),'max:2048','image'],
        ]);
        $room = new BookingRoom;
        $room->room_type_id = $request->room_type;
        $room->floor_id = $request->floor;
        $room->number = $request->number;
        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/room/';
            $room->image = time().'.png';
            Image::make($request->image)->save($path.$room->image);
        }
        $room->status = $request->has('status')?1:0;
        $room->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit_room($id){
        $room = BookingRoom::findOrFail($id);
        $floors = BookingFloor::where('status',1)->get();
        $room_types = BookingRoomType::where('status',1)->get();
        return view('bookings.hotel.rooms.edit',compact('room','floors','room_types'));
    }
    public function update_room(Request $request,$id){
        $this->validate($request,[
            'room_type'=>'required|integer',
            'number'=>'required|integer|unique:rooms,number,'.$id,
            'image'=>[new  MimeCheckRules(['jpg']),'max:2048','image'],
        ]);

        $room = BookingRoom::findOrFail($id);
        $room->room_type_id = $request->room_type;
        $room->number = $request->number;
        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/room/';
            @unlink($path.$room->image);
            $room->image = time().'.png';
            Image::make($request->image)->save($path.$room->image);
        }
        $room->status = $request->has('status')?1:0;
        $room->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function delete_room($id){
        BookingRoom::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    
    /* Amenity Controller */
    public function amenities(){
        $amenities = BookingAmenity::get();
        return view('bookings.hotel.amenity.index',compact('amenities'));
    }
    public function create_amenities(){
        return view('bookings.hotel.amenity.create');
    }

    public function store_amenities(Request $request){
        $this->validate($request,[
            'name'=>'required|max:191|unique:amenities',
            'image'=>[new  MimeCheckRules(['png']),'max:2048','image'],
        ]);
        $amenity = new BookingAmenity;
        $amenity->name = $request->name;
        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/amenities/';
            $amenity->image = time().'.png';
            Image::make($request->image)->save($path.$amenity->image);
        }
        $amenity->description = $request->description;
        $amenity->status = $request->has('status')?1:0;
        $amenity->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit_amenities($id){
        $amenity = BookingAmenity::findOrFail($id);
        return view('bookings.hotel.amenity.edit',compact('amenity'));
    }
    public function update_amenities(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|max:191|unique:amenities,name,'.$id,
            'image'=>[new  MimeCheckRules(['png']),'max:2048'],
        ]);
        $amenity = BookingAmenity::findOrFail($id);
        $amenity->name = $request->name;
        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/amenities/';
            $amenity->image = time().'.png';
            Image::make($request->image)->save($path.$amenity->image);
        }
        $amenity->description = $request->description;
        $amenity->status = $request->has('status')?1:0;
        $amenity->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function delete_amenities($id){
        BookingAmenity::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    
    /* Coupon Master Controller */
    public function coupon(){
        $couponMasters = BookingCouponMaster::get();

        return view('bookings.hotel.coupon_master.index',compact('couponMasters'));
    }
    public function create_coupon(){
        $room_types = BookingRoomType::where('status',1)->get();
        $paid_services = BookingPaidService::where('status',1)->get();
        return view('bookings.hotel.coupon_master.create',compact('room_types','paid_services'));
    }

    public function store_coupon(Request $request){
        $this->validate($request,[
            'code'=>'required|max:191|unique:coupon_masters',
            'offer_title'=>'required|max:191',
            'period_start_time'=>'required|date|after_or_equal:today',
            'period_end_time'=>'required|date|after_or_equal:period_start_time',
            'type'=>'required',
            'min_amount'=>'required|numeric|min:0',
            'max_amount'=>'required|numeric|min:0',
            'value'=>'required|numeric|min:0',
            'limit_per_user'=>'required|integer|min:0',
            'limit_per_coupon'=>'required|integer|min:0',
            'room_type'=>'required',
        ]);
        $couponMaster = new BookingCouponMaster;
        $couponMaster->offer_title = $request->offer_title;
        $couponMaster->description = $request->description;

        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/coupon/';
            $couponMaster->image = time().'.png';
            Image::make($request->image)->save($path.$couponMaster->image);
        }
        $couponMaster->period_start_time = $request->period_start_time;
        $couponMaster->period_end_time = $request->period_end_time;
        $couponMaster->code = $request->code;
        $couponMaster->type = $request->type;
        $couponMaster->value = $request->value;
        $couponMaster->min_amount = $request->min_amount;
        $couponMaster->max_amount = $request->max_amount;
        $couponMaster->limit_per_user = $request->limit_per_user;
        $couponMaster->limit_per_coupon = $request->limit_per_coupon;
        $couponMaster->status = $request->has('status')?1:0;
        $couponMaster->save();
        $couponMaster->roomType()->attach($request->room_type);
        if($request->has('paid_service'))
        $couponMaster->paidService()->attach($request->paid_service);
        return redirect()->back()->with('success','Save successful');
    }
    public function edit_coupon($id){
        $couponMaster = BookingCouponMaster::findOrFail($id);
        $room_types = BookingRoomType::where('status',1)->get();
        $paid_services = BookingPaidService::where('status',1)->get();
        return view('bookings.hotel.coupon_master.edit',compact('couponMaster','room_types','paid_services'));
    }
    public function update_coupon(Request $request,$id){
        $this->validate($request,[
            'code'=>'required|max:191|unique:coupon_masters,code,'.$id,
            'offer_title'=>'required|max:191',
            'period_start_time'=>'required|date|after_or_equal:today',
            'period_end_time'=>'required|date|after_or_equal:period_start_time',
            'type'=>'required',
            'min_amount'=>'required|numeric|min:0',
            'max_amount'=>'required|numeric|min:0',
            'value'=>'required|numeric|min:0',
            'limit_per_user'=>'required|integer|min:0',
            'limit_per_coupon'=>'required|integer|min:0',
            'room_type'=>'required',
        ]);
        $couponMaster =BookingCouponMaster::findOrFail($id);
        $couponMaster->offer_title = $request->offer_title;
        $couponMaster->description = $request->description;

        if($request->hasFile('image')){
            $path = 'assets/booking/assets/backend/image/coupon/';
            @unlink($path.$couponMaster->image);
            $couponMaster->image = time().'.png';
            Image::make($request->image)->save($path.$couponMaster->image);
        }
        $couponMaster->period_start_time = $request->period_start_time;
        $couponMaster->period_end_time = $request->period_end_time;
        $couponMaster->code = $request->code;
        $couponMaster->type = $request->type;
        $couponMaster->value = $request->value;
        $couponMaster->min_amount = $request->min_amount;
        $couponMaster->max_amount = $request->max_amount;
        $couponMaster->limit_per_user = $request->limit_per_user;
        $couponMaster->limit_per_coupon = $request->limit_per_coupon;
        $couponMaster->status = $request->has('status')?1:0;
        $couponMaster->save();
        $couponMaster->roomType()->sync($request->room_type);
        if($request->has('paid_service')){
            $couponMaster->paidService()->sync($request->paid_service);
        }else{
            $couponMaster->paidService()->sync([]);
        }

        return redirect()->back()->with('success','Update successful');
    }
    public function delete_coupon($id){
        BookingCouponMaster::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    
    /* Floor Controller */
    public function floor(){
        $floors = BookingFloor::get();
        return view('bookings.hotel.floor.index',compact('floors'));
    }
    public function create_floor(){
        return view('bookings.hotel.floor.create');
    }

    public function store_floor(Request $request){
        $this->validate($request,[
            'name'=>'required|max:191|unique:floors',
            'number'=>'required|integer|unique:floors',
        ]);
        $floor = new BookingFloor;
        $floor->name = $request->name;
        $floor->number = $request->number;
        $floor->description = $request->description;
        $floor->status = $request->has('status')?1:0;
        $floor->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit_floor($id){
        $floor = BookingFloor::findOrFail($id);
        return view('bookings.hotel.floor.edit',compact('floor'));
    }
    public function update_floor(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|max:191|unique:floors,name,'.$id,
            'number'=>'required|integer|unique:floors,number,'.$id,
        ]);
        $floor = BookingFloor::findOrFail($id);
        $floor->name = $request->name;
        $floor->number = $request->number;
        $floor->description = $request->description;
        $floor->status = $request->has('status')?1:0;
        $floor->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function delete_floor($id){
        BookingFloor::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    
    /* Paid Service Controller */
    public function paid_service(){
        $paid_services = BookingPaidService::get();
        return view('bookings.hotel.paid_service.index',compact('paid_services'));
    }
    public function create_paid_service(){
        $room_types = BookingRoomType::where('status',1)->get();
        return view('bookings.hotel.paid_service.create',compact('room_types'));
    }

    public function store_paid_service(Request $request){
        $this->validate($request,[
            'title'=>'required|max:191|unique:paid_services',
            'price'=>'required|numeric'
        ]);
        $paidService = new BookingPaidService;
        $paidService->icon = $request->icon;
        $paidService->title = $request->title;
        $paidService->price = $request->price;
        $paidService->status = $request->has('status')?1:0;
        $paidService->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit_paid_service($id){
        $paidService = BookingPaidService::findOrFail($id);
        $room_types = BookingRoomType::where('status',1)->get();
        return view('bookings.hotel.paid_service.edit',compact('paidService','room_types'));
    }
    public function update_paid_service(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|max:191|unique:paid_services,title,'.$id,
            'price'=>'required|numeric',
        ]);
        $paidService =  BookingPaidService::findOrFail($id);
        $paidService->icon = $request->icon;
        $paidService->title = $request->title;
        $paidService->price = $request->price;
        $paidService->status = $request->has('status')?1:0;
        $paidService->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function delete_paid_service($id){
        BookingPaidService::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    
    /* Tax Controller */
    public function tax(){
        $taxes = BookingtaxManager::get();
        return view('bookings.hotel.tax.index',compact('taxes'));
    }
    public function create_tax(){
        return view('bookings.hotel.tax.create');
    }

    public function store_tax(Request $request){
        $this->validate($request,[
            'name'=>'required|max:191',
            'code'=>'required|max:191',
            'type'=>'required',
            'rate'=>'required|numeric',
        ]);
        $tax = new BookingtaxManager;
        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->type = $request->type;
        $tax->rate = $request->rate;
        $tax->status = $request->has('status')?1:0;
        $tax->save();
        return redirect()->back()->with('success','Save successful');
    }
    public function edit_tax($id){
        $tax = BookingtaxManager::findOrFail($id);
        return view('bookings.hotel.tax.edit',compact('tax'));
    }
    public function update_tax(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|max:191',
            'code'=>'required|max:191',
            'type'=>'required',
            'rate'=>'required|numeric',
        ]);
        $tax = BookingtaxManager::findOrFail($id);
        $tax->name = $request->name;
        $tax->code = $request->code;
        $tax->type = $request->type;
        $tax->rate = $request->rate;
        $tax->status = $request->has('status')?1:0;
        $tax->save();
        return redirect()->back()->with('success','Update successful');
    }
    
    /* Payment History */
    public function paymentLog($id=null){
        $logs = BookingPayment::whereStatus(1);
        $gateway = null;
        if($id !== null){
            $gateway = 'Wallet';
            //$logs=$logs->where('gateway_id',$id);

        }

           $logs=$logs->latest()->paginate(20);
        return view('bookings.payment-history', compact('logs','gateway'));
    }
    
    
    /* The Booking Controller */
    public function roomList (Request $request){
        $search = [
            'arrival'=>'',
            'departure'=>'',
            'adults'=>'',
            'children'=>'',
            'trip_from'=>'',
            'trip_to'=>'',
            'trip_type'=>'',
        ];
        $room_types = BookingRoomType::whereStatus(1);
            if($request->search){
                $this->validate($request,[
                    'search.arrival'=>'required|date',
                    'search.departure'=>'required|date',
                    'search.adults'=>'required|integer',
                    'search.children'=>'nullable|integer',
                ],[
                    'search.arrival.required'=>'Arrival is required',
                    'search.arrival.date'=>'Arrival must be date',
                    'search.departure.required'=>'Departure is required',
                    'search.departure.date'=>'Departure must be date',
                    'search.adults.required'=>'Adults is required',
                    'search.adults.integer'=>'Adults must be integer',
                    'search.children.integer'=>'Children must be integer',
                ]);
                $room_types=  $room_types->get();

                $arr=[];
                foreach ($room_types as $room_v){
                    if($result = $this->getRoomByDate($room_v->id,Carbon::parse($request->search['arrival'])->format('Y/m/d'),Carbon::parse($request->search['departure'])->subDay()->format('Y/m/d'))){
                        $arr[] = $room_v->id;
                    }
                }
                $room_types = BookingRoomType::whereIn('id',$arr);
                $search = [
                    'arrival'=>$request->search['arrival'],
                    'departure'=>$request->search['departure'],
                    'adults'=>$request->search['adults'],
                    'children'=>$request->search['children'],
                ];
            }

        $room_types=$room_types->paginate(9);
        session()->forget('reservation');
        $page_title = 'Welcome to Ebeano Bookings';
        return view('bookings.hotel.room-list',compact('room_types','search', 'page_title'));
    }
    public function calculateNoOfRoom(){

    }
    public function roomDetails ($id){
        $room_type = BookingRoomType::findOrFail($id);
        $search = [
            'arrival'=>\request()->arrival,
            'departure'=>\request()->departure,
            'adults'=>\request()->adults,
            'children'=>\request()->children,
            'trip_from'=>'',
            'trip_to'=>'',
            'trip_type'=>'',
        ];
        if(!$room_type->status)
        return view('frontend.error');
        $reletade_rooms = BookingRoomType::whereStatus(1)->latest()->take(3)->get();
        $page_title = 'Welcome to Ebeano Bookings';
        return view('bookings.hotel.room-details',compact('room_type','search','reletade_rooms','page_title'));
    }
    
    
    public function reservationSuccess(){
            if(!session()->has('reservation_confirm')){
                return view('frontend.error');
            }
             $reservation = BookingReservation::findOrFail(session()->get('reservation_confirm'));
        return view('frontend.reservation_confirmation',compact('reservation'));
    }



    public function booking(Request $request,$id){

            $this->validate($request,[
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required',
                'adult'=>'required|integer',
                'children'=>'nullable|integer',
                'arrival'=>'required|date',
                'departure'=>'required|date',
            ]);
        $room_type = BookingRoomType::findOrFail($id);
        $required_room = $this->roomCalculate($id,$request->adult,$request->children);
        $err = 0;
        $night =$this->nightCalculation([$request->arrival,Carbon::parse($request->departure)->subDay()->format('Y/m/d')],['13:30:00','12:00:00']);
        foreach ($night as $key=>$ngt){
        $avl = 0;
            foreach ($room_type->room as $rm){
              $isbooked =  BookingReservationNight::where('room_id',$rm->id)->where('date',$key)
                  ->whereHas('reservation',function ($q) {
                      $q->whereNotIn('status',['CANCEL','ONLINE_PENDING']);
                  })
                  ->count();
              if($isbooked==0){
                  $avl++;
              }
            }
            if($avl<$required_room){
                $err++;
                break;
            }

         }
        if($err){
            return back()->with('error','Not available room for your selected booking duration.');
        }

        $sub_total=0;
        $payable_amount =0;
       $night_list = $this->getNightCalculation($room_type,$night,$required_room);
        $sub_total += $night_list['total_price'];
        $payable_amount = $sub_total;
        $tex_list = BookingTaxManager::whereStatus(1)->get();
       if($tex_list->count()){
           $tex_list->map(function ($item,$key) use($request,$sub_total){
               $cal_price = 0;
               switch ($item->type){
                   case 'PERCENTAGE':
                       $cal_price = $item->rate * $sub_total/100;
                       break;
                   case 'FIXED':
                       $cal_price = $item->rate;
                       break;
               }
               $item['cal_price']=$cal_price;
               return $item;
           });
           $payable_amount += $tex_list->sum('cal_price');
       }else{
           $tex_list =null;
       }
      $reservation_data = collect([
            'room_type'=>$id,
            'user'=>null,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'adult'=>$request->adult,
            'children'=>$request->children,
            'arrival'=>$request->arrival,
            'departure'=>$request->departure,
            'rooms_per_night'=>$required_room,
            'gateway'=>null,
            'night_list'=>$night_list,
            'tax_list'=>$tex_list,
            'payable_amount'=>$payable_amount,
            'sub_total'=>$sub_total,
            'coupon'=>null
        ]);
        session()->put('reservation',$reservation_data);
        return redirect()->route('checkout');

    }
    public function getNightCalculation($room_type,$night_calculation,$requir_room = 1){
        $data =[];
       $total_price =0;
        foreach ($night_calculation as $k=>$v){
            $price = $this->getPrice($k,$room_type);

            $data[] = [
                'date'=>$k,
                'check_in'=>$v['start'],
                'check_out'=>$v['end'],
                'price'=>$price,
                'sub_total'=>$price*$requir_room,
            ];
            $total_price +=$price*$requir_room;
        }

        $total_night =count($night_calculation);


       return [
           'night_list'=>$data,
           'total_night'=>$total_night,
           'total_price'=>$total_price,
       ];
    }
    protected function getPrice($date,RoomType $room_type){
        $day = Carbon::parse($date)->dayOfWeek+1;
        return $room_type->getDayByCurrentPrice($day);
    }
    public function applyCoupon(Request $request){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $this->validate($request,[
            'code'=>'required'
        ]);
        $reservation_data = session()->get('reservation');
        $response = [];
        if($reservation_data['user'] === null){
            $user_data = array(
                'name' => $reservation_data['name'],
                'email' => $reservation_data['email'],
                'phone' => $reservation_data['phone'],
                'referer' => 'admin',
                'password' => Hash::make(123456),
                'user_type' => 'booking_guest',
                
            );
            // add to user
            $check = User::create($user_data);
            
            $user = new BookingClients();
            $user->first_name = $reservation_data['name'];
            $user->username = Str::random(6);
            $user->email = $reservation_data['email'];
            $user->phone = $reservation_data['phone'];
            $user->user_id = $check;
            $user->save();
            $reservation_data['user'] = $user;
        }
        if($coupon = BookingCouponMaster::where('code',$request->code)->first()){
            if(!$coupon->hasCoupon($reservation_data['user']->id,$reservation_data['sub_total'])){
                throw ValidationException::withMessages([
                    'code' => [$coupon->getMessage($reservation_data['user']->id,$reservation_data['sub_total'])]
                ]);
            }else{
                $response['status']='ok';
                $response['message']='Coupon apply success';
                $response['data']=$coupon;
            }
        }else{
            throw ValidationException::withMessages([
                'code' => ['Code is invalid']
            ]);
        }
        if($coupon->type === 'PERCENTAGE'){
            $coupon['cal_price'] = $coupon->value * $reservation_data['sub_total']/100;
        }else{
            $coupon['cal_price'] = $coupon->value;
        }
        $sub_total = $reservation_data['sub_total']-$coupon['cal_price'];

        $tex_list = BookingTaxManager::whereStatus(1)->get();
        if($tex_list->count()){
            $tex_list->map(function ($item,$key) use($request,$sub_total){
                $cal_price = 0;
                switch ($item->type){
                    case 'PERCENTAGE':
                        $cal_price = $item->rate * $sub_total/100;
                        break;
                    case 'FIXED':
                        $cal_price = $item->rate;
                        break;
                }
                $item['cal_price']=$cal_price;
                return $item;
            });
            $reservation_data['payable_amount'] = $tex_list->sum('cal_price')+$sub_total;
        }else{
            $reservation_data['payable_amount'] = $sub_total;
            $tex_list =null;
        }
        $reservation_data['sub_total'] = $sub_total;
        $reservation_data['tax_list']=$tex_list;
        $reservation_data['coupon']=$response['data'];
        session()->put('reservation',$reservation_data);
        return back()->with('success',$response['message']);
    }
    public function checkout(){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $reservation_data = session()->get('reservation');
        $room_type = BookingRoomType::findOrFail($reservation_data['room_type']);
        return view('frontend.checkout',compact('reservation_data','room_type'));
    }
    public function confirmCheckout(){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        return redirect()->route('select_gateway');
    }
    public function selectGateway(Request $request){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $gateway = true;
        return view('frontend.select_gateway',compact('gateway'));
    }
    public function insertReservation($gateway_id){

        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $reservation_data = session()->get('reservation');
        if($reservation_data['user'] === null){
            $user_data = array(
                'name' => $reservation_data['name'],
                'email' => $reservation_data['email'],
                'phone' => $reservation_data['phone'],
                'referer' => 'admin',
                'password' => Hash::make(123456),
                'user_type' => 'booking_guest',
                
            );
            // add to user
            $check = User::create($user_data);
            
            $user = new BookingClients();
            $user->first_name = $reservation_data['name'];
            $user->username = Str::random(6);
            $user->email = $reservation_data['email'];
            $user->phone = $reservation_data['phone'];
            $user->user_id = $check;
            $user->save();
            $reservation_data['user'] = $user;
        }

        $reservation_data['gateway'] = $gateway_id;
        session()->put('reservation',$reservation_data);



        $amount = $reservation_data['payable_amount'];
        if($amount<=0)
        {
            return back()->with('error', 'Invalid Amount');
        }
        else
        {

            $gate = true;

            if(isset($gate))
            {
                if(1000 <= $amount || 10000000000000 >= $amount)
                {
                    $charge = 0;
                    $usdamo = ($amount + $charge)/80; // rate

                    $payment = new BookingPayment();
                    $payment->user_id = $reservation_data['user']->id;
                    $payment->gateway_id = $gate->id;
                    $payment->amount = $amount;
                    $payment->usd_amo = $usdamo;
                    $payment->trx = time().'-'.rand(1111,9999);
                    $payment->save();

                    session()->put($this->session_name,$payment->trx);

                    return redirect()->route('payment.preview');

                }
                else
                {
                    return back()->with('error', 'Please Follow Payment Limit');
                }
            }
            else
            {
                return back()->with('error', 'Please Select Payment gateway');
            }
        }
    }
    public function paymentPreview(){
        if(!session()->has('reservation')){
            return view('frontend.error');
        }
        $track = session()->get('Track');
        $data = BookingPayment::where('status',0)->where('trx',$track)->first();
        $pt = 'Payment Preview';

        return view('frontend.users.payment.preview',compact('pt','data'));
    }
    public function checkAvailableRoom(Request $request,$id){
        if($request->ajax()){

            $arrival = Carbon::parse($request->arrival)->format('Y/m/d');
            $departure = Carbon::parse($request->departure)->subDay()->format('Y/m/d');
            $adult = $request->adult;
            $children = $request->children;

            $data['number_of_room'] = $this->roomCalculate($id,$adult,$children);
            $getRoomByDate = $this->getRoomByDate($id,$arrival,$departure);
            $data['total_night'] = count($getRoomByDate['night']);
            $data['available'] = $getRoomByDate['available'];
            return response()->json([
                'status'=>'success',
                'class'=>'text-success',
                'message'=>'Available room for your selected booking duration.',
                'data'=>$data
            ]);
        }
    }
    public function roomCalculate(int $room_type,$adults,$kids){
        $room_type = BookingRoomType::find($room_type);

         $adults_room =ceil( $adults/$room_type->higher_capacity);
        $adults_room = $adults_room>0?$adults_room:1;
        $kids_room = @ceil( $kids/$room_type->kids_capacity);
        $kids_room = $kids_room>0?$kids_room:1;
        if($adults_room > $kids_room){
          return  $adults_room;
        }else{
            return $kids_room;
        }
    }
    public function getRoomByDate(int $room_type,$arrival,$departure){
        $night =$this->nightCalculation([$arrival,$departure],['13:30:00','12:00:00']);

        $arr_key = array_keys($night);
        $data['night'] = $arr_key;
        $data['available'] = 1;
        return $data;
    }
    /*protected function nightCalculation(array $night_range,array $range_setup){

        $result = [];
        $date_range = $this->date_range($night_range[0],$night_range[1]);
        foreach ($date_range as $k=>$v){
            $s = Carbon::parse($v.' '.$range_setup[0]);
            $e = Carbon::parse($v.' '.$range_setup[0])->addHours(24)->format('Y/m/d');
            $result[$v]  = [
                'start'=>$s,
                'end'=>Carbon::parse($e.' '.$range_setup[1])
            ];
        }
        return $result;
    }
    protected function date_range($first, $last, $step = '+1 day', $output_format = 'Y/m/d' ) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }*/





    public function userDataUpdate($data)
    {
        $i=0;
        if($data->status==0 && session()->has('reservation')){
            $booking_data = session()->get('reservation');

            DB::beginTransaction();
            try{
                $room_type = BookingRoomType::findOrFail($booking_data['room_type']);
                $reservation = new BookingReservation();
                $reservation->uid = rand(1111,9999).'-'.time();
                $reservation->user_id = $booking_data['user']->id;
                $reservation->room_type_id = $room_type->id;
                $reservation->online = 1;
                $reservation->adults = $booking_data['adult'];
                $reservation->kids = $booking_data['children'];
                $reservation->check_in = $booking_data['arrival'];
                $reservation->check_out = $booking_data['departure'];
                $reservation->number_of_room = $booking_data['rooms_per_night'];
                $reservation->status = 'ONLINE_PENDING';
                $reservation->save();
                $data['reservetion_id'] = $reservation->id;
                $data['status'] = 1;
                $data->update();
                foreach ($booking_data['night_list']['night_list'] as $v){
                    for($i=1;$i<= $reservation->number_of_room;$i++){
                        $night = new BookingReservationNight();
                        $night->reservation_id = $reservation->id;
                        $night->date = $v['date'];
                        $night->check_in = $v['check_in'];
                        $night->check_out =  $v['check_out'];
                        $night->price = $v['price'];
                        $night->save();
                    }
                }


                if(null !== $booking_data['tax_list']){
                    foreach ($booking_data['tax_list'] as $v){
                        $tax = new BookingReservationTax();
                        $tax->reservation_id = $reservation->id;
                        $tax->tax_id = $v->id;
                        $tax->type = $v->type;
                        $tax->value = $v->rate;
                        $tax->price = $v->cal_price;
                        $tax->save();
                    }
                }


                if(null !== $booking_data['coupon']){
                    $appliedCouponCode = new BookingAppliedCouponCode();
                    $appliedCouponCode->reservation_id = $reservation->id;
                    $appliedCouponCode->coupon_id = $booking_data['coupon']->id;
                    $appliedCouponCode->user_id = $booking_data['user']->id;
                    $appliedCouponCode->date = Carbon::now();
                    $appliedCouponCode->coupon_type = $booking_data['coupon']->type;
                    $appliedCouponCode->coupon_rate =  $booking_data['coupon']->value;
                    $appliedCouponCode->save();
                }
                $tran = new BookingTransaction();
                $tran->user_id = $booking_data['user']->id;
                $tran->gateway_id = $data->gateway_id;
                $tran->amount = $data->amount;
                $tran->remarks = 'Payment for room reservation';
                $tran->trx = $data->trx;
                $tran->save();
                $msg =  "Successful your reservation.Your reservation no <b>#".$reservation->uid."</b>";
                $user = $booking_data['user'];

                $this->sendEmail($user->email, $user->username, 'Reservation Successful', $msg);
                $sms =  "Successful your reservation.Your reservation no #".$reservation->uid;
                $this->sendSms($user->mobile, $sms);
                $status = true;
                DB::commit();
            }catch (\Exception $e){
                $status = false;
                DB::rollback();
                dd($e->getMessage());
            }

        }
        session()->put('reservation_confirm',$reservation->id);
        session()->forget('reservation');
    }


    public function cancelUrl()
    {
        session()->forget('reservation');
        return route('home');
    }

    public function successUrl()
    {
        session()->forget('reservation');
        $this->success_message = 'Reservation Successful';
        return route('reservation.success');
    }

    public function viewPath()
    {
        return 'frontend.users.payment';
    }
    
    // Flight Controller
    public function create_flight_partner()
    {
        $data['page_title'] = "Create Flight Partner";
        return view('bookings.flight.partners.create', $data);
    }
    
    public function create_flight_post(Request $request)
    {
        $this->validate($request,[
            'name'=>'nullable|max:191|string',
            'description'=>'nullable|max:300|string',
            'number'=>'required|max:191|string',
            'logo_image'=>['nullable',new MimeCheckRules(['png','jpg']),'max:2048','image'],
        ]);
        $flight = new FlightPartners;
        $flight->user_id = Auth::user()->id;
        $flight->name = $request->name;
        $flight->content = $request->description;
        $flight->track_no = $request->number;
        if($request->has('logo_image')){
            $path_card_image = 'assets/booking/assets/backend/image/flight/';
            $flight->img = 'partner_'.time().'.'.$request->logo_image->getClientOriginalExtension();
            Image::make($request->logo_image)->save($path_card_image.$flight->img);
        }
        
        $flight->status = 1;
        $flight->save();
        return redirect()->back()->with('success','Successfully registered');
    }
    
    public function create_flight_available(){

        $flights = FlightPartners::where(['status'=>1, 'user_id'=>Auth::user()->id])->get();
        return view('bookings.flight.available.create',compact('flights'));
    }
    
    public function available_flight_post(Request $request)
    {
        $this->validate($request,[
            'name'=>'nullable|max:191|string',
            'description'=>'nullable|max:300|string',
            'flight'=>'required|max:191|string',
            'trip_type'=>'nullable|max:191|string',
            'trip_from'=>'nullable|max:300|string',
            'trip_to'=>'required|max:191|string'
        ]);
        $flight = new FlightAvailable;
        $flight->user_id = Auth::user()->id;
        $flight->flight_id = $request->flight;
        $flight->title = $request->name;
        $flight->content = $request->description;
        $flight->from = $request->trip_from;
        $flight->to = $request->trip_to;
        $flight->trip_type = $request->trip_type;
        $flight->flight_takeoff = $request->takeoff;
        $flight->available_seats = $request->available_seat;
        $flight->price_per_seat = $request->price_seat;
        $flight->status = 1;
        $flight->save();
        return redirect()->back()->with('success','Successfully created');
    }
    
    public function flight_available(){

        $flights = FlightAvailable::where(['status'=>1, 'user_id'=>Auth::user()->id])->latest()->paginate(20);
        return view('bookings.flight.available.index',compact('flights'));
    }
    
    public function flight_view_booked($id){
        $flights = FlightBooking::where('flight_available_id', $id)->latest()->paginate(20);
        return view('bookings.flight.available.view',compact('flights'));
    }
    
    public function flight_booked(){
        $data['flights'] = FlightBooking::where('flight_id', FlightPartners::where('user_id', Auth::user()->id)->first()->id)->latest()->paginate(20);
        return view('bookings.flight.booked.index',compact('data'));
    }
    
    public function flight_edit_available($id){
        $flight = FlightAvailable::findOrFail($id);
        $flights = FlightPartners::where(['status'=>1, 'user_id'=>Auth::user()->id])->get();
        return view('bookings.flight.available.edit',compact('flight', 'flights'));
    }
    public function flight_edit_available_post(Request $request,$id){
        $this->validate($request,[
            'name'=>'nullable|max:191|string',
            'description'=>'nullable|max:300|string',
            'flight'=>'required|max:191|string',
            'trip_type'=>'nullable|max:191|string',
            'trip_from'=>'nullable|max:300|string',
            'trip_to'=>'required|max:191|string'
        ]);
        $flight = new FlightAvailable;
        $flight->flight_id = $request->flight;
        $flight->title = $request->name;
        $flight->content = $request->description;
        $flight->from = $request->trip_from;
        $flight->to = $request->trip_to;
        $flight->trip_type = $request->trip_type;
        $flight->flight_takeoff = $request->takeoff;
        $flight->available_seats = $request->available_seat;
        $flight->price_per_seat = $request->price_seat;
        $flight->status = 1;
        $flight->save();
        return redirect()->back()->with('success','Update successful');
    }
    public function flight_delete_available($id){
        FlightAvailable::findOrFail($id)->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    
    public function flightList (Request $request){
        $search = [
            'arrival'=>'',
            'departure'=>'',
            'adults'=>'',
            'children'=>'',
            'trip_from'=>'',
            'trip_to'=>'',
            'trip_type'=>'',
        ];
        $flightAvailable = FlightAvailable::whereStatus(1);
            if($request->search){
                $this->validate($request,[
                    'search.trip_from'=>'required|string',
                    'search.trip_to'=>'required|string',
                    'search.trip_type'=>'required|string',
                ],[
                    'search.trip_from.required'=>'Trip from is required',
                    'search.trip_to.required'=>'Trip to is required',
                    'search.trip_type.required'=>'Trip type is required',
                ]);
                
                $flightAvailable = FlightAvailable::where('from', 'LIKE', "%".$request->search['trip_from']."%")->orWhere('to', 'LIKE', "%".$request->search['trip_to']."%")->orWhere('trip_type', 'LIKE', "%".$request->search['trip_type']."%");
                $search = [
                    'arrival'=>'',
                    'departure'=>'',
                    'adults'=>'',
                    'children'=>'',
                    'trip_from'=>$request->search['trip_from'],
                    'trip_to'=>$request->search['trip_to'],
                    'trip_type'=>$request->search['trip_type'],
                ];
            }

        $flightAvailable=$flightAvailable->paginate(9);
        
        $page_title = 'Welcome to Ebeano Bookings';
        return view('bookings.flight.flight-list',compact('flightAvailable','search', 'page_title'));
    }
    
    public function flightDetails ($id){
        $flight = FlightAvailable::findOrFail($id);
        $search = [
            'trip_from'=>\request()->trip_from,
            'trip_to'=>\request()->trip_to,
            'trip_type'=>\request()->trip_type,
            'arrival'=>'',
            'departure'=>'',
            'adults'=>'',
            'children'=>'',
        ];
        if(!$flight->status)
        return view('frontend.error');
        $related_flight = FlightAvailable::whereStatus(1)->latest()->take(3)->get();
        $page_title = 'Welcome to Ebeano Bookings';
        return view('bookings.flight.flight-details',compact('flight','search','related_flight','page_title'));
    }
    
    public function bookFlight(Request $request, $id) {
        $flight = FlightAvailable::findOrFail($id);
        $this->validate($request,[
            'name'=>'nullable|max:191|string',
            'email'=>'nullable|max:300|string',
            'phone'=>'required|max:191|string'
        ]);
        // get the total amount of money required to be paid
        $per_seat = $flight->price_per_seat;
        $booked_seat = $per_seat * $request->travellers;
        // check if the user balance is sufficient
        if($booked_seat > Auth::user()->balance) {
            return redirect()->back()->with('error','Your balance was not sufficient. Please, fund up!');
        }
        
        if($flight->booked_seats == $flight->available_seats) {
            return redirect()->back()->with('error','There no more seats available!');
        }
        
        if($request->travellers > ($flight->available_seats - $flight->booked_seats)) {
            return redirect()->back()->with('error','Travellers more than available seats!');
        }
        
        // generate ticket id
        $cur_date = date('d').date('m').date('y');
        $ticketno = 'EBNAIR'.$cur_date;
        $c_id = rand(00000 , 99999).FlightBooking::whereStatus(1)->count()+1;
        $ticketno = $ticketno.'-'.$c_id;
        
        // since everything is okay
        $book = User::findOrFail(Auth::user()->id);
        $book -= $booked_seat;
        if($book->save()){
            
            // create a booked ticket
            $ticket = new FlightBooking;
            $ticket->user_id = Auth::user()->id;
            $ticket->flight_id = $flight->flight_id;
            $ticket->flight_available_id = $flight->id;
            $ticket->booking_id = $ticketno;
            $ticket->booked_seats = $request->travellers;
            $ticket->price = $booked_seat;
            $ticket->guest_details = json_encode(['name'=>$request->name, 'email'=>$request->email, 'phone'=>$request->phone]);
            $ticket->status = 0;
            $ticket->save();
            
            // credit the booking agent
            $agent = User::findOrFail(FlightPartners::where('id', $flight->flight_id)->first()->user_id);
            $agent +=$booked_seat;
            $agent->save();
            
            // register booking
            $flight->booked_seats += $request->travellers;
            $flight->save();
            
            // now lets save transactions
            $tran = new BookingTransaction();
            $tran->user_id = Auth::user()->id;
            $tran->gateway_id = 'Wallet';
            $tran->amount = $booked_seat;
            $tran->remarks = 'Payment of flight booking for '.$request->travellers.' Travellers';
            $tran->trx = time().'-'.rand(1111,9999);
            $tran->save();
            return back()->with('success','Payment Successful. Your Ticket ID is '.$ticketno);
            
        }
        
        return redirect()->back()->with('error','Could not charge your account. No booking occurred');
        
    }
    
}