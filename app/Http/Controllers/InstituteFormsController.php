<?php

namespace App\Http\Controllers;
use App\Helpers\MimeCheckRules;
use App\InstituteSoldForms;
use App\InstituteForms;
use App\InstituteList;
use App\InstituteRegistrars;
use App\State;
use App\Country;
use App\User;
use Carbon\Carbon;
use Image;
use \Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Session;


class InstituteFormsController extends Controller
{

    public function __construct()
    {
        if(!Auth::check()){
            return redirect('login/eforms');
        }
        if(Auth::check() && Auth::user()->registrar->status ==0){
            return Redirect("login/eforms")->with(['error'=>'Account is inactive or awaiting approval']);
        }
        if(Auth::check() && InstituteList::where('registrar_id', Auth::user()->registrar->id)->count() ==0){
            return Redirect("create/institute")->with(['error'=>'Opps! Please, register your institution or organization']);
        }
    }
    
    //index controller
    public function index()
    {
        $data['page_title'] = 'Buy Your Forms on Ebeano';
        // fetch out all institutes on the ebeano portal
        $data['all_institutes'] = InstituteList::where('status', 1)->latest()->paginate(20);
        
        // fetch out all forms on the ebeano portal
        $data['on_sale'] = InstituteForms::where('status', 1)->where('form_close', '>=', Carbon::today())->latest()->get();
        
        return view('eforms.welcome', $data);
    }
    
    //dashboard controller
    public function dashboard()
    {
        if(Auth::check() && InstituteList::where('registrar_id', Auth::user()->registrar->id)->count() ==0){
            return redirect()->route('registrar.create.institute')->with(['error'=>'Opps! Please, register your institution or organization']);
        }
        $data['page_title'] = 'Registrar Dashboard';
        // fetch out all forms on the ebeano portal
        $data['eforms'] = InstituteForms::where('status', 1)->where('registrar_id', Auth::user()->registrar->id)->latest()->paginate(20);
        
        return view('eforms.registrar.dashboard', $data);
    }
    
    // create institute
    public function registrarCreate()
    {
        $data['page_title'] = 'Create Institute';
        $data['types'] = (object)[1=>'Primary', 2=>'Secondary', 3=>'Tertiary', 4=>'Other'];
        $data['states'] = State::all();
        
        return view('eforms.registrar.institute.create', $data);
    }
    
    public function registrarCreateProcess(Request $request)
    {
        $approve = 1;
        $check = DB::table('institute_list');
        $in = [
            'name'=> $request->name,
            'school_description'=> $request->school_description,
            'institute_tagline'=> $request->name,
            'address'=>$request->address,
            'state'=>$request->state,
            'country'=>$request->country,
            'type'=>$request->type,
            'web'=>$request->web,
            'fb'=>$request->fb,
            'slug'=>Str::slug($request->name, '-'),
            'twitter'=>$request->twitter,
            'address'=>$request->address,
            
        ];
        if($check->where('name', 'LIKE', '%' . $request->name . '%')->count() > 0) {
            return back()->with('error', 'This institute is already created by another registrar');
        }
        $in['registrar_id'] = Auth::user()->registrar->id;
        
        if($approve == 1)
        {
            $in['status'] = 1;
        }
        if ($request->hasFile('institute_logo')) {
            $image = $request->file('institute_logo');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/eforms/institute/logo/' . $filename;
            $in['institute_logo'] = $filename;
            Image::make($image)->save($location);
        }
        
        if($check->insert($in)){
            return redirect()->route('registrar.show.institute')->withSuccess('Successfully created, waiting for Approval!');
        }
        return back()->withError('Unable to create');
        
    }
    
    
    public function registrarEdit($slug)
    {
        $check = InstituteList::where(['slug'=>$slug, 'registrar_id'=>Auth::user()->registrar->id])->first();
        if(!$check) {
            return back()->with('error', 'Form does not exist');
        }
        $data['page_title'] = 'Edit Institute';
        $data['institute'] = $check;
        $data['types'] = (object)[1=>'Primary', 2=>'Secondary', 3=>'Tertiary', 4=>'Other'];
        $data['states'] = State::all();
        return view('eforms.registrar.institute.edit', $data);
        
    }
    
    public function registrarEditProcess(Request $request, $slug)
    {
        $check = InstituteList::where(['slug'=>$slug, 'registrar_id'=>Auth::user()->registrar->id]);
        $in = [
            'name'=> $request->name,
            'school_description'=> $request->school_description,
            'institute_tagline'=> $request->name,
            'address'=>$request->address,
            'state'=>$request->state,
            'country'=>$request->country,
            'type'=>$request->type,
            'web'=>$request->web,
            'fb'=>$request->fb,
            'twitter'=>$request->twitter,
            'address'=>$request->address,
            
        ];
        if(!$check->first()) {
            return back()->with('error', 'Institute does not exist');
        }
        
        if ($request->hasFile('institute_logo')) {
            $image = $request->file('institute_logo');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/eforms/institute/logo/' . $filename;
            $in['institute_logo'] = $filename;
            Image::make($image)->save($location);
        }
        
        if($check->update($in)){
            return redirect()->route('registrar.show.institute')->withSuccess('Successfully edited!');
        }
        return back()->withError('Unable to edit');
        
    }
    
    
    public function registrarDeleteProcess(Request $request){
        $data['institute'] = InstituteList::where(['registrar_id'=>Auth::user()->registrar->id, 'id'=>$request->id])->first();
        if($data['institute']) {
            return true;
        }
       return false;
    }
     
     
    public function showInstitute()
    {
        $data['page_title'] = 'My Institutes';
        $data['institutes'] = InstituteList::where('registrar_id', Auth::user()->registrar->id)->latest()->paginate(20);
        
        return view('eforms.registrar.institute.view', $data);
    }
    
    // create eforms
    public function createEform()
    {
        $data['page_title'] = 'Create Eforms';
        $data['institutes'] = InstituteList::where('registrar_id', Auth::user()->registrar->id)->get();
        
        return view('eforms.registrar.eforms.create', $data);
    }
    
    // edit eforms
    public function editEform($ref)
    {
        $check = InstituteForms::where(['reference'=>$ref])->first();
        if(!$check) {
            return back()->with('error', 'Form does not exist');
        }
        $data['institutes'] = InstituteList::where('registrar_id', Auth::user()->registrar->id)->get();
        $data['page_title'] = 'Edit Eforms';
        $data['form'] = $check;
        return view('eforms.registrar.eforms.edit', $data);
    }
    
    public function editEformProcess(Request $request)
    {
        if ($request->ajax()){
            $check = InstituteForms::where(['reference'=>$request->reference, 'institute_id'=>$request->institute])->first();
            if(!$check) {
                return response()->json([
                    'status' => 'error',
                    'message'=>'Form does not exist'
                ]);
            
            }
            $check->title = $request->title;
            $check->amount = $request->amount;
            $check->general_instruction = $request->description;
            $check->required_sales = $request->sales;
            $check->form_open = $request->form_open;
            $check->form_close = $request->form_close;
            $check->form_content = $request->ebform;
            if($check->save()){
                return response()->json([
                    'status' => 'success',
                    'message'=>'Successfully edited'
                ]);
            }
            return response()->json([
                'status' => 'error',
                'message'=>'Unable to edit your form'
            ]);
        }
        
        return response('Not allowed!', 404);
        
    }
    
    public function finalEform($ref)
    {
        $data['page_title'] = 'Finalize Your Form';
        $data['eform'] = InstituteForms::where(['reference'=>$ref, 'title'=>null])->first();
        if($data['eform']){
            return view('eforms.registrar.eforms.final', $data);
        }
        return redirect()->route('registrar.show.eforms')->withSuccess('Form already completed!');
    }
    
    public function createEformProcess(Request $request)
    {
        if ($request->ajax()){
            
            $approve = 0;
            $reference = 'EB-FORM'.rand(1111111111,9999999999);
            
            $check = DB::table('institute_forms');
            $in = [
                'reference'=>$reference,
                'form_content'=>$request->input('ebform'),
                'status'=>$approve,
                'registrar_id' =>Auth::user()->registrar->id,
                'institute_id' =>$request->input('institute'),
            ];
            
            if($check->insert($in)){
                return response()->json([
                    'status' => 'success',
                    'id'=>$reference,
                    'message'=>'Almost complete your form'
                ]);
            }
            
            return response()->json([
                'status' => 'error',
                'message'=>'Unable to create your form'
            ]);
        }

        return response('Not allowed!', 404);
        
    }
    
    public function finalEformProcess(Request $request, $ref)
    {
        $approve = 1;
        $check = InstituteForms::where(['reference'=>$ref])->first();
        if(!$check) {
            return back()->with('error', 'Form does not exist');
        }
        $check->title = $request->name;
        $check->amount = $request->amount;
        $check->general_instruction = $request->general_instruction;
        $check->required_sales = $request->required_sales;
        $check->form_open = $request->open_date;
        $check->form_close = $request->close_date;
        $check->status = $approve;
        if($check->save()){
            return redirect()->route('registrar.show.eforms')->withSuccess('Successfully created!');
        }
        return back()->withError('Unable to complete');
        
    }
    
    public function deleteEformProcess(Request $request){
        $data['form'] = InstituteForms::where(['registrar_id'=>Auth::user()->registrar->id, 'reference'=>$request->id])->first();
        if($data['form']) {
            return true;
        }
       return false;
    }
    
    public function presentEform($ref){
        $data['page_title'] = 'Present Forms';
        $data['form'] = InstituteForms::where(['registrar_id'=>Auth::user()->registrar->id, 'reference'=>$ref])->first();
        if($data['form']) {
            return view('eforms.registrar.eforms.view', $data);
        }
       abort(404);
    }
    
    public function showEform()
    {
        $data['page_title'] = 'Manage Forms';
        $data['forms'] = InstituteForms::where('registrar_id', Auth::user()->registrar->id)->latest()->paginate(20);
       
        return view('eforms.registrar.eforms.manage', $data);
    }
    
    public function allApplyEform(Request $request)
    {
        $data['filter'] = false;
        $data['page_title'] = 'Manage Applications';
        $data['institutes'] = InstituteList::where('registrar_id', Auth::user()->registrar->id)->latest()->paginate(20);
        if($request->institute_id){
            $data['filter'] = true;
            $data['solds'] = InstituteSoldForms::where('institute_id', $request->institute_id)->latest()->paginate(20);
        }else{
            $data['solds'] = (object)[];
        }
        return view('eforms.registrar.application.manage', $data);
    }
    
    public function createTranxProcessEform(Request $request)
    {
        $data = InstituteForms::where(['reference'=>$request->reference])->first();
        if($data) {
            return view('eforms.ajax.payment', compact('data'));
        }
        return view('eforms.ajax.error');
        
    }
    
    public function createTranxPayment(Request $request)
    {
        $data = InstituteForms::where(['reference'=>$request->reference])->first();
        if($data) {
            
            // create tranx
            $client = ['firstname'=> $request->first_name, 'lastname'=>$request->last_name, 'email'=> $request->email, 'phone'=> $request->phone];
            $cjson = json_encode($client);
            
            $form = [
                'form_id' => $request->reference,
                'institute_id' => $data->institute_id,
                'amount_paid' => $data->amount,
                'customer_details' => $cjson,
                'txn_code' => 'EB-FORM-ORD'.rand(1111111111,9999999999),
            ];
            
            $create_trx = InstituteSoldForms::create($form);
            if($create_trx){
                $form['status'] = 'success';
                return response()->json($form);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message'=>'Unable to create your form'
                ]);
            }
            
            return response('Not allowed!', 404);
            
        }
    }
    
    public function sendFormPurchaseRequest(Request $request)
    {
        // check transaction referrence
        $result = self::CheckTransactionReference($request->ref_code);
        if($result['status']=='success'){
            $purchase = json_decode($request->data);
            //approve tranz
            $trx = InstituteSoldForms::where(['txn_code'=>$purchase->txn_code, 'form_id'=>$purchase->form_id])->first();
            if($trx){
                $trx->approved = 1;
                $trx->payment_method ='paystack';
                $trx->payment_details = $request->data;
                $trx->gateway_details = json_encode($result['response']);
                $trx->paid_reference = $request->ref_code;
                
                if($trx->save()){
                    // 
                    $form = InstituteForms::where(['reference'=>$trx->form_id])->first();
                    $customer = json_decode($trx->customer_details);
                    // update registrar's balance
                    $registrar = User::where(['id'=>$form->registrar->user_id])->first();
                    $newbal = $registrar->balance+$form->amount_paid;
                    $update_bal = User::find($registrar->id)->update(
                        ['balance'=>$newbal]);
                    InstituteRegistrars::find($form->registrar->id)->update(
                        ['balance'=>$newbal]);
                    
                    if($update_bal){
                        // notify registrar 
                        $to_reg = $registrar->email;
                        $name_reg = $registrar->name;
                        $subject_reg = 'EForms Payment Order Alert';
                        $message_reg = $form->title." Payment Transaction Order <br><br>";
                        $message_reg .= '<table width="100%">
                        <tbody>
                        <tr>
                          <th>Institution</th>
                          <td><span>'.$form->institute->name.'</span></td>
                        </tr>
                        <tr>
                          <th>Form</th>
                          <td><span>'.$form->title.'</span></td>
                        </tr>
                        <tr>
                          <th>Form ID</th>
                          <td><span>'.$form->reference.'</span></td>
                        </tr>
                        <tr>
                          <th>ORDER ID</th>
                          <td><span>'.$trx->txn_code.'</span></td>
                        </tr>
                        <tr>
                          <th>Amount (₦)</th>
                          <td><span>'.$form->amount.'</span></td>
                        </tr>
                        <tr>
                          <th>Customer Name</th>
                          <td><span>'.$customer->firstname.'</span></td>
                        </tr>
                        <tr>
                          <th>Customer Email Address</th>
                          <td><span>'.$customer->email.'</span></td>
                        </tr>
                        <tr>
                          <th>Payment method</th>
                          <td>Paystack Gateway</td>
                        </tr>
                      </tbody> <br><br>';
                        // send email to registrar
                        send_email($to_reg,  $name_reg, $subject_reg, $message_reg);
                    }
                    
                    // send transaction receipt by email
                    $to = $customer->email;
                    $name = $customer->firstname;
                    $link = route('registrar.start-complete.eforms', ['reference'=>$trx->form_id, 'orderID'=>$trx->txn_code, 'hash'=>md5(base64_encode($request->ref_code))]);
                    $subject = 'EForms Payment Receipt';
                    $message = $form->title." Payment Transaction Receipt <br><br>";
                    $message .= '<table width="100%">
                    <tbody>
                    <tr>
                      <th>Institution</th>
                      <td><span>'.$form->institute->name.'</span></td>
                    </tr>
                    <tr>
                      <th>Form</th>
                      <td><span>'.$form->title.'</span></td>
                    </tr>
                    <tr>
                      <th>Form ID</th>
                      <td><span>'.$form->reference.'</span></td>
                    </tr>
                    <tr>
                      <th>ORDER ID</th>
                      <td><span>'.$trx->txn_code.'</span></td>
                    </tr>
                    <tr>
                      <th>Amount (₦)</th>
                      <td><span>'.$form->amount.'</span></td>
                    </tr>
                    <tr>
                      <th>Email Address</th>
                      <td><span>'.$customer->email.'</span></td>
                    </tr>
                    <tr>
                      <th>Payment method</th>
                      <td>Paystack Gateway</td>
                    </tr>
                  </tbody> <br><br>';
                    $message .= "<a style='background: #eb790f; color: #fff; text-align: center; text-decoration: none; padding-top:10px; padding-bottom:10px; padding-left: 16px; padding-right: 16px; border-radius: 5px; margin-bottom: 10px;' href='".$link."'>Let's Go!</a>";
                    
                    send_email($to,  $name, $subject,$message);
                    
                    return redirect()->route('registrar.thank-you.eforms', ['reference'=>$trx->form_id, 'orderID'=>$trx->txn_code, 'hash'=>md5(base64_encode($request->ref_code))])->withSuccess('Successfully paid!');
                    
                }else{
                    return back()->withError('Unable to complete');
                }
                
            }else{
                return back()->withError('Unable to complete');
            }
            
        }else{
            return back()->withError('Unable to complete');
        }
        
    }
    
    
    public function startFillingEform(Request $request, $reference, $orderID, $hash)
    {
        //check sum
        $check = InstituteSoldForms::where(['txn_code'=>$orderID, 'form_id'=>$reference])->first();
        if($check){
            $form = InstituteForms::where(['reference'=>$check->form_id])->first();
            if($form) {
                
                $sum_hash = md5(base64_encode($check->paid_reference));
                
                if($sum_hash == $hash){
                    $data['page_title'] = $form->title. ' - '.$orderID;
                    $data['form'] = $form;
                    $data['order'] = $check;
                    $data['hash'] = $sum_hash;
                    
                    return view('eforms.complete-form', $data);
                }
                
            }
            
        }
        
        abort(404);
        
    }
    
    public function viewEform($ref)
    {
        function single_price($price)
        {
            return number_format($price,2);
        }
        $detailedForm  = InstituteForms::where('reference', $ref)->first();
        if($detailedForm!=null && $detailedForm->status==1){
            $data['page_title'] = $detailedForm->title;
            $data['form'] = $detailedForm;
            return view('eforms.preview-form', $data);
        }
        abort(404);
    }
    
    
    public function startFillingEformPost(Request $request, $reference, $orderID, $hash)
    {
        $status = false;
        //check sum
        $check = InstituteSoldForms::where(['txn_code'=>$orderID, 'form_id'=>$reference])->first();
        if($check){
            $form = InstituteForms::where(['reference'=>$check->form_id])->first();
            if($form) {
                $sum_hash = md5(base64_encode($check->paid_reference));
                if($sum_hash == $hash){
                    $in = $request->except(['_method', '_token']);
                    $check->completed_form = json_encode($in);
                    $check->save();
                    $status = true;
                }
            }
        }
        
        if($status == true){
            return redirect()->route('registrar.preview-complete.eforms', ['reference'=>$check->form_id, 'orderID'=>$check->txn_code, 'hash'=>md5(base64_encode($check->paid_reference))])->withSuccess('Successfully submited!');
        }
        abort(404);
    }
    
    
    public function thankYouEform(Request $request, $reference, $orderID, $hash)
    {
        //check sum
        $check = InstituteSoldForms::where(['txn_code'=>$orderID, 'form_id'=>$reference])->first();
        if($check && $check->thank_you == 0){
            $form = InstituteForms::where(['reference'=>$check->form_id])->first();
            if($form) {
                $sum_hash = md5(base64_encode($check->paid_reference));
                if($sum_hash == $hash){
                    $check->thank_you = 1;
                    $check->save();
                    $data['page_title'] = 'Thank you '.$form->title. ' - '.$orderID;
                    $data['form'] = $form;
                    $data['order'] = $check;
                    $data['hash'] = $sum_hash;
                    return view('eforms.thank-you', $data);
                }
            }
        }
        
        abort(404);
        
    }
    
    public function previewSubmittedEform(Request $request, $reference, $orderID, $hash)
    {
        //check sum
        $check = InstituteSoldForms::where(['txn_code'=>$orderID, 'form_id'=>$reference])->first();
        if($check){
            $form = InstituteForms::where(['reference'=>$check->form_id])->first();
            if($form) {
                
                $sum_hash = md5(base64_encode($check->paid_reference));
                
                if($sum_hash == $hash){
                    $data['page_title'] = 'Preview '.$form->title. ' - '.$orderID;
                    $data['form'] = $form;
                    $data['order'] = $check;
                    $data['hash'] = $sum_hash;
                    return view('eforms.print-preview', $data);
                }
                
            }
            
        }
        
        abort(404);
        
    }
    
    public function filterForm(Request $request, $slug=null)
    {
        if($slug){
            $data['institute'] = InstituteList::where(['slug'=>$slug])->first();
            if(!$data['institute']){
                abort(404);
            }
        }
        $data['page_title'] = 'Available Forms';
        $data['Allinstitutes'] = InstituteList::where(['status'=>1])->get();
        
        $data['institute'] = InstituteList::where(['slug'=>$slug])->first();
        $data['forms'] = (object)[];
        if($slug && $request->filter ==false && $data['institute']){
            $data['forms'] = InstituteForms::where(['status'=>1, 'institute_id'=>$data['institute']->id])->latest()->paginate(20);
        }
        
        if(!$slug && $request->filter ==true && !$data['institute']){
            $data['institute'] = InstituteList::where(['id'=>$request->institute])->first();
            $data['forms'] = InstituteForms::where(['status'=>1, 'institute_id'=>$request->institute])->latest()->paginate(20);
        }
        
        if(!$slug && $request->filter ==false && !$data['institute']){
            $data['forms'] = InstituteForms::where(['status'=>1])->latest()->paginate(20);
        }
        
        return view('eforms.all-forms', $data);
    }
    
    
    
    private function CheckTransactionReference($id)
    {
        
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer sk_test_4dbd1957a2b11072ecb5a0ff2ace86b919447a67",
              "Cache-Control: no-cache",
            ),
          ));
      
        $result = curl_exec($curl);
        $response = json_decode($result, true);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            return ['status'=>'error', 'error'=>$err];
        } else {
        
            if($response['data']['status'] == 'success'){
                return ['status'=>'success', 'response'=>$response['data']];
            }else{
                return ['status'=>'error', 'error'=>'Transaction failed'];
            }
        }
        
        return false;
    }
}