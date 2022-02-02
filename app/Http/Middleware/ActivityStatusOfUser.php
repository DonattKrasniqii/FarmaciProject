<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityStatusOfUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $expires = Carbon::now()->addMinute(2);
            \Illuminate\Support\Facades\Cache::put('user-is-online-' . Auth::user()->id, true, $expires);

//            User::where('id', Auth::user()->id)->update(['last_seen' =>'0030430']);

        }

        return $next($request);
    }
}


