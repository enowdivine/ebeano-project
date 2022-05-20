<?php

namespace App\Http\Controllers;
use App\Subscription;
use App\User;
use App\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class SubscriptionController extends Controller
{
    //
    public function index(){
        return view('admin.subscription.index');
    }
    
    public function subscribeVendor(){
        return view('admin.subscription.subscribe_vendor');
    }
    
    public function storeSubscription(Request $request){
        $request->validate([
            'user' => 'required',
            'plan' => 'required',
        ]);
        $plan = SubscriptionPlan::find($request->plan);
        $user = User::where('email',$request->user)->first();
        $subscription = new Subscription;
        $subscription->subscription_plan_id = $request->plan;
        $subscription->user_id = $user->id;
        $subscription->active = 1;
        $subscription->expiration = strtotime(date('d-m-Y',strtotime
        ($request->sub_date))) + ($plan['duration'] * 24 * 60 * 60);
        if($subscription->save()){
            
            $user->subscribed = 1;
            if ($user->save()){
               return back()->with(['success'=>'User Subscribed successfully']); 
            }else{
                return back()->with(['error'=>'Error subscribing user']); 
            }
        }
    }
    
    public function upgradeSubscription(Request $request, $id){
        $request->validate([
            'user' => 'required',
            'plan' => 'required',
        ]);
        $plan = SubscriptionPlan::find($request->plan);
        $user = User::where('email',$request->user)->first();
        $subscription = Subscription::find(decrypt($id));
        $subscription->subscription_plan_id = $request->plan;
        $subscription->user_id = $user->id;
        $subscription->active = 1;
        $subscription->expiration = strtotime(date('d-m-Y',strtotime
        ($request->sub_date))) + ($plan->duration * 24 * 60 * 60);
        if($subscription->save()){
            
            $user->subscribed = 1;
            if ($user->save()){
               return back()->with(['success'=>'Upgraded successfully']); 
            }else{
                return back()->with(['error'=>'Error Upgrading Subscription']); 
            }
        }
    }
    
    public function renewSubscription($id){
        
        $subscription = Subscription::findOrFail(decrypt($id));
        $plan = SubscriptionPlan::find($subscription->subscription_plan_id);
        $subscription->active = 1;
        $subscription->expiration = strtotime(date('d-m-Y',strtotime($time()))) + ($plan->duration * 24 * 60 * 60);
        if($subscription->save()){
            $user = User::find($subscription->user_id);
            $user->subscribed = 1;
            if ($user->save()){
               return back()->with(['success'=>'User Subscription Renewed successfully']); 
            }else{
                return back()->with(['error'=>'Failed to renew user subscription']); 
            }
        }
    }
    
    public function deleteSubscription($id){
        
        if (Subscription::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error: Something went wrong');
        }
    }
    public function activateSubscription($id){
        $subscription = Subscription::findOrFail(decrypt($id));
        $subscription->active = 1;
         if ($subscription->save()){
            return back()->withSuccess('Activated successfully');
        }else{
            return back()->withError('Error: Something went wrong');
        }
    
    }
    
    public function cancelSubscription($id){
        $subscription = Subscription::findOrFail(decrypt($id));
        $subscription->active = 0;
         if ($subscription->save()){
            return back()->withSuccess('Deactivated successfully');
        }else{
            return back()->withError('Error: Something went wrong');
        }
    }
    
    public function subscriptionPlan(){
        return view('admin.subscription.plans');
    }
    
    public function subscriptionCreatePlan(){
        return view('admin.subscription.form');
    }
    
    public function subscriptionEditPlan($id){
        
        $edit = SubscriptionPlan::findOrFail(decrypt($id));
        return view('admin.subscription.form',['edit'=>$edit]);
    }
    
    public function subscriptionStorePlan(Request $request){
         $request->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category' => 'required',
        ]);
        $data = $request->all();
        $sub_plan = new SubscriptionPlan;
        $sub_plan->name = $data['name'];
        $sub_plan->price = $data['price'];
        $sub_plan->code = $data['code'];
        $sub_plan->category = $data['category'];
        $sub_plan->duration = $data['duration'];
        $sub_plan->special_offer =[];
        if (!empty($data['special_offers'])){
        $sub_plan->special_offer = json_encode($data['special_offers']);
        }
        
        // $sub_plan = array_filter($sub_plan);
        
        if ($sub_plan->save()){
            return back()->withSuccess('Plan Created successfully');
        }else{
            return back()->withError('Error: Something went wrong');
        }
        
    }
    
    public function subscriptionUpdatePlan(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category' => 'required',
        ]);
        $data = $request->all();
        $sub_plan = SubscriptionPlan::findOrFail(decrypt($id));
        $sub_plan->name = $data['name'];
        $sub_plan->price = $data['price'];
        $sub_plan->code = $data['code'];
        $sub_plan->category = $data['category'];
        $sub_plan->duration = $data['duration'];
        $sub_plan->special_offer =[];
        if (!empty($data['special_offers'])){
        $sub_plan->special_offer = json_encode($data['special_offers']);
        }
        // $sub_plan = array_filter($sub_plan);
        
        if ($sub_plan->save()){
            return back()->withSuccess('Plan Updated successfully');
        }else{
            return back()->withError('Error: Something went wrong');
        }
    }
    
    public function subscriptionDeletePlan($id){
        if (SuscriptionPlan::destroy(decrypt($id))){
            return back()->withSuccess('Deleted successfully');
        }else{
            return back()->withError('Error: Something went wrong');
        }
    }
}
