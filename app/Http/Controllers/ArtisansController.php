<?php

namespace App\Http\Controllers;

use App\User;
use App\Slider;
use App\ArtisanBitJob;
use App\ArtisanCategory;
use App\ArtisanProject;
use App\Artisans;
use App\ArtisanAssignJob;
use App\ArtisanWithdrawLog;
use App\ArtisanTrx;
use App\Bank;
use App\KYCVerification;
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

class ArtisansController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect('login/artisan');
        }
        if(Auth::check() && Auth::user()->artisan->category_id ==null){
            return Redirect("user/profile/edit")->with(['error'=>'Opps! Please, complete your profile']);
        }
        if(Auth::check() && Auth::user()->subscribed ==0){
            return Redirect("login/artisan")->with(['error'=>'Opps! Please, subcribe']);
        }
    }
    //index controller
    public function index(){
        $data['sliders'] =  Slider::latest()->get();
        $data['page_title'] = "home_page";
        $data['projects'] = ArtisanProject::where('approve', 1)->where('deadline', '>=', Carbon::today())->latest()->paginate(20);
        
        //dd($data['projects']);
        return view('artisans.welcome', $data);
    }
    
    // all artisans
    public function AllArtisans(){
        $data['artisans'] = Artisans::where('category_id', '!=', null)->latest()->paginate(20);
        return view('artisans.all-artisans', $data);
    }
    
    //recent job controller
    public function recentJob(){
        $data['projects'] = ArtisanProject::where('approve', 1)->where('deadline', '>=', Carbon::today())->latest()->get();
        $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
        return view('artisans.recent-job', $data);
    }
    
    // create job
    public function createJob(){
        $artisan = Artisans::where('user_id', auth()->user()->id)->first();
        $page_title = "Create a Job";
        $category = ArtisanCategory::whereStatus(1)->get();
        $user = Auth::user();
        return view('artisans.create-job', compact('page_title', 'category', 'user', 'artisan'));
        
    }
    
    public function createJobPost(Request $request)
    {
        $post_approve = 0;
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'keywords' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ],
            [
                'category_id.required' => "Job Category must be selected",
                'description.required' => "Project Description must be fill up",
            ]);
        $in = $request->all();
        //Input::except('_method', '_token');
        $in['user_id'] = Auth::user()->id;
        $in['deadline'] = Carbon::parse($request->deadline);

        if($post_approve == 1)
        {
            $in['approve'] = 1;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/artisan/images/project/' . $filename;
            $in['image'] = $filename;
            Image::make($image)->save($location);
        }
        if(ArtisanProject::create($in)){
            return back()->withSuccess('Successfully created, waiting for Approval!');
        }
        abort(404);

    }
    
    public function myJob()
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
            //if ($data['artisan']->type == 2) {
                $data['projects'] = ArtisanProject::latest()->where('user_id', auth()->user()->id)->paginate(20);
                $data['page_title'] = "My Jobs";
                return view('artisans.my-job', $data);
            //}
            //abort(404);
        }
        return Redirect("login/artisan")->with(['error'=>'Opps! You do not have access']);
    }
    
    public function editJob($id)
    {
        $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
        $data['page_title'] = "Edit Job";
        $data['category'] = ArtisanCategory::whereStatus(1)->get();
        $user = auth()->user();
        $data['project'] = ArtisanProject::whereId($id)->where('user_id', $user->id)->first();
        if (isset($data['project'])) {
            return view('artisans.edit-job', $data);
        }
        abort(404);
    }
    
    public function updateJob(Request $request)
    {
        $data = ArtisanProject::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'keywords' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ],
            [
                'category_id.required' => "Job Category must be selected",
                'description.required' => "Project Description must be fill up",
            ]);
        $in = $request->except(['_method', '_token', 'id']);
        $in['deadline'] = Carbon::parse($request->deadline);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/artisan/images/project/' . $filename;
            $in['image'] = $filename;

            $path = './assets/artisan/images/project/';
            $link = $path . $data->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            Image::make($image)->save($location);
        }
        $data->fill($in)->save();

        return back()->withSuccess('Successfully edited!');
    }


    public function deleteJob(Request $request)
    {
        $data = ArtisanProject::find($request->id);
        $path = './assets/artisan/images/project/';
        $link = $path . $data->image;
        if (file_exists($link)) {
            @unlink($link);
        }
        $data->delete();

        $Deleted_data = ArtisanProject::find($request->id);
        if ($Deleted_data) {
            $status = 1;
        } else {
            $status = 0;
        }
        return $status;
    }
    
    public function detailsJob($id)
    {
        $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
        $data['project'] = $pro = ArtisanProject::find($id);
        $data['page_title'] = "$pro->title";
        return view('artisans.job-details', $data);
    }


    public function bidProjectUserlist($id)
    {
        $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
        $data['page_title'] = "Bid Project List";
        $data['bitJobs'] = ArtisanBitJob::where('project_id', $id)->where('author_id', Auth::user()->id)->orderBy('offer', 'desc')->paginate(15);
        return view('artisans.bid-project-userlist', $data);
    }
    
    public function bitJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'message' => 'required',
            //'offer' => 'required|numeric|min:0',
            'project_id' => 'required',
            'author_id' => 'required'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $checkBit = ArtisanBitJob::where('project_id', $request->project_id)->where('user_id', Auth::user()->id)->count();
        if ($checkBit > 0) {
            return "no_success";
        } else {
            $data['project_id'] = $request->project_id;
            $data['author_id'] = $request->author_id;
            $data['user_id'] = Auth::user()->id;
            $data['offer'] = $request->offer;
            //$data['message'] = $request->message;
            $data['code'] = Str::random(20);
            ArtisanBitJob::create($data);
            return "success";
        }
    }

    public function bitJobHomePage(Request $request)
    {
        $request->validate([
            //'message' => 'required',
            //'offer' => 'required|numeric|min:0',
            'project_id' => 'required',
            'author_id' => 'required'
        ]);

        $checkBit = ArtisanBitJob::where('project_id', $request->project_id)->where('user_id', Auth::user()->id)->count();
        if($request->author_id == Auth::user()->id){
            return back()->with('error', 'You cannot offer the job you created');
            
        }elseif ($checkBit > 0) {
            return back()->with('error', 'You have already Bidded for the job');

        } else {
            $data['project_id'] = $request->project_id;
            $data['author_id'] = $request->author_id;
            $data['user_id'] = Auth::user()->id;
            $data['offer'] = $request->offer;
            //$data['message'] = $request->message;
            $data['code'] = Str::random(20);
            ArtisanBitJob::create($data);

            return back()->with('success', 'Bid Successfully.');
        }
    }
    
    public function biography($id)
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', $id)->first();
            $user = User::whereId($id)->first();
            $data['page_title'] = "Artisan Profile";
            $data['user'] = $user;
            return view('artisans.artisan-biography', $data);
        }
        
        $data['artisan'] = Artisans::where('user_id', $id)->first();
        $data['page_title'] = "Artisan Profile";
        return view('artisans.artisan-profile', $data);
    }
    
    public function Assignbiography(Request $request)
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', $request->user_id)->first();
            $user = User::whereId($request->user_id)->first();
            $data['page_title'] = "Artisan Profile";
            $data['user'] = $user;
            $data['assign_request'] = $request;
            return view('artisans.artisan-profile', $data);
        }
        
        return  redirect('login/artisan');
    }
    
    public function assignJob(Request $request)
    {
        $auth = Auth::user();
        $pro = ArtisanProject::find($request->project_id);
        if($pro->salary > $auth->balance){
            
            return redirect()->route('wallet.index');
            //return Redirect("user/wallet")->with('error', 'Balance is too low !! Please, deposit exact or more money in your wallet');
        }
        $checkAssign = ArtisanAssignJob::where('user_id', $request->user_id)->where('project_id', $request->project_id)->count();
        if ($checkAssign > 0) {
            $slug = Str::slug($pro->title, '-');
            return redirect()->route('bid.Userlist',[$request->project_id, $slug])->with('alert', 'Already assign job this user !!');
        } else {
            $in = $request->except(['_token']);
            $in['deadline'] = Carbon::parse($request->deadline);
            $in['author_id'] = $auth->id;
            ArtisanAssignJob::create($in);
            $slug = Str::slug($pro->title, '-');
            return redirect()->route('bid.Userlist',[$request->project_id, $slug])->with('success', 'This job assign for the user!');
        }
    }

    public function assignList()
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
            $data['projects'] = ArtisanAssignJob::where('author_id', auth()->user()->id)->latest()->paginate(15);
            $data['page_title'] = "Awarded  Job List";
            return view('artisans.assign-list', $data);
        }
        abort(404);
    }
    
    public function acquiredList()
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
            $data['projects'] = ArtisanAssignJob::where('user_id', auth()->user()->id)->where('reject', 0)->latest()->paginate(15);
            $data['page_title'] = "Acquired Jobs List";
            return view('artisans.acquired-list', $data);
        }
        abort(404);
    }
    
    public function withdrawLog()
    {
        //->where('status', '!=', 0) {{ ucfirst(str_replace('_', ' ', $wallet ->payment_method)) }}
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
            $data['wallets'] = ArtisanWithdrawLog::whereUser_id(auth()->user()->id)->latest()->paginate(20);
            $data['page_title'] = "Withdraw Log";
            return view('artisans.withdrawal', $data);
        }
        abort(404);
    }
    
    public function PaymentHistory()
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
            $data['trx'] = ArtisanTrx::whereUser_id(auth()->user()->id)->latest()->paginate(20);
            $data['page_title'] = "Payment History";
            return view('artisans.payment-history', $data);
        }
        abort(404);
    }
    
    public function kycUpload()
    {
        if(Auth::check()){
            $data['artisan'] = Artisans::where('user_id', auth()->user()->id)->first();
            $data['kyc'] = KYCVerification::where('user_id', auth()->user()->id)->latest()->paginate(20);
            $data['page_title'] = "KYC Upload & Verification";
            return view('artisans.kyc-upload', $data);
        }
        abort(404);
    }
    
    public function kycUploadProcess(Request $request) {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . '.jpg';
            $location = 'assets/artisan/kycdocument/' . $filename;
            $in['image'] = $filename;
            Image::make($image)->save($location);
            
            KYCVerification::create([
                'user_id' => auth()->user()->id,
                'id_document' => $filename,
                'doc_type' => $request->doc_type,
            ]);
            return back()->with('success', 'Uploaded Successfully');
        }
        return back()->with('error', 'Could not Uploaded');    
    }
    
    public function removeAssignList(Request $request)
    {
        $data = ArtisanAssignJob::find($request->id);
        // $data->status = -1;
        // $data->deleted_at = Carbon::now();
        $data->delete();

        //$txt = 'Your project removed  by ' . $data->author->name;
        //send_email($data->user->email, $data->user->username, 'Cancel Project ', $txt);
        return back()->with('success', 'Removed Successfully');
    }
    
    public function rejectAssignList(Request $request)
    {
        $data = ArtisanAssignJob::find($request->id);
        $data->reject = 1;
        $data->save();
        //$txt = 'Your project removed  by ' . $data->author->name;
        //send_email($data->user->email, $data->user->username, 'Cancel Project ', $txt);
        return back()->with('success', 'Rejected Successfully');
    }
    
    public function ApproveJobPayment(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $data = ArtisanAssignJob::find($request->id);
        $project = ArtisanProject::find($data->project_id);
        $contractor = User::find($data->author_id);
        $artisan = User::find($data->user_id);
        if($project->salary > $contractor->balance){
            return redirect()->route('wallet.index');
        }
        // debit contractor
        $contractor->balance -= $project->salary;
        if($contractor->save()){
            // credit artisan
            $artisan->balance += $project->salary;
            $artisan->save();
        }
        //  complete assignment
         $data->status = 1;
        if($data->save()){
            // create trx record
            ArtisanTrx::create([
                'user_id' => $artisan->id,
                'amount' => $project->salary,
                'main_amo' => $artisan->balance,
                'project_submit' => $project->id,
                'charge' => 0,
                'type' => '+',
                'title' => 'Project Name:  ' . $data->project->title ,
                'trx' => Str::random(16)
            ]);

            ArtisanTrx::create([
                'user_id' => $contractor->id,
                'amount' => $project->salary,
                'main_amo' => $contractor->balance,
                'project_submit' => $project->id,
                'charge' => 0,
                'type' => '-',
                'title' => 'Project Name:  ' . $data->project->title,
                'trx' => Str::random(16)
            ]);
            
            //update project 
            $project->approve = 2;
            $project->save();
        }
        //$txt = 'Your project removed  by ' . $data->author->name;
        //send_email($data->user->email, $data->user->username, 'Cancel Project ', $txt);
        return back()->with('success', 'Payment released Successfully');
    }
    
    public function requestSubmit(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
        $artisan = Artisans::find(auth()->user()->id);
        $user = User::find(auth()->user()->id);
        if($request->amount > $user->balance){
            return redirect()->route('wallet.index');
        }
        // debit user
        $user->balance -= $request->amount;
        if($user->save()){
            // create a transaction withdrawal log
            ArtisanWithdrawLog::create([
                'user_id' => $user->id,
                'method_id' => 1,
                'transaction_id' => Str::random(3).$request->orderID,
                'amount' => $request->amount,
                'net_amount' => $request->amount,
                'send_details' => 'Acc Name: '.$artisan["bank_acc_name"].' Bank Acc No: '.$artisan["bank_acc_no"].' Bank Name: '.Bank::where('id', $artisan["bank_id"])->first()["name"],
                'charge' => 0
            ]);
        }
        return back()->with('success', 'Withdrawal request Successfully');
    }
    
}
