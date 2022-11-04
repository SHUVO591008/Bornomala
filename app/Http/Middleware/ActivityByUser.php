<?php

namespace App\Http\Middleware;

use Closure;

use App\Model\Admin;
use Auth;
use Cache;
use Carbon\Carbon;

class ActivityByUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     

            if (Auth::guard('webadmin')->check()) {
                
                $expiresAt = Carbon::now()->addMinutes(1); // keep online for 1 min
            
                Cache::put('user-is-online-' . Auth::guard('webadmin')->id(), true, $expiresAt);
                // last seen
                Admin::where('id', Auth::guard('webadmin')->id())->update(['last_login' => (new \DateTime())->format("Y-m-d H:i:s")]);
            }

        
        return $next($request);


    }
}
