<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
Use App\User;
Use App\Role;
Use App\Staff;
Use App\Permissions;
use Closure;

class hasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permissions)
    {
        if (Auth::check()) {

            if (Auth::user()->user_type === 'admin'){
                return $next($request);
            }elseif (Auth::user()->user_type === 'staff') {
                $user_id = Auth::user()->id;

            $staff = Staff::where('user_id',$user_id)->first();
            $permission_codes = $staff->role->permissions;

            $permission_array = json_decode($permission_codes);

                if (($role == 'all' && in_array($permissions,$permission_array)) || ($role == strtolower($staff->role->name) && in_array($permissions,$permission_array) )){
                    return $next($request);
                }else{
                    abort(404);
                }

            }else{
                abort(404);
            }
            
        }
        
        
    }
}
