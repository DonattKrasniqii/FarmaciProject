<?php

namespace App\Http\Middleware;

use Closure;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PreventNotActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = \App\Models\User::where('email',$request->get('email'))->first();

        if($user && $user->is_active) {
            return $next($request);
        }
        else if(!$user){
            return redirect()->back()->with('error', 'Kredencialet gabim !');

        }
        return redirect()->back()->with('errorMessage', ' Llogaria juaj eshte deaktivizuar!');
    }
}
