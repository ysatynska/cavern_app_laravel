<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use RCAuth;
use Redirect;

class ForceSecretAgent
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
        $returnRoute = Redirect::to('login')->with('returnURL', $request->fullUrl());

        if (self::isAdmin()) {
            // $rcid = RCAuth::user()->rcid;

            // // $user = User::where('RCID', $rcid)->first();

            // if ($rcid==='1285521') {
                $returnRoute = $next($request);
            // }
        }

        return $returnRoute;
    }

    public static function isAdmin (){

        if (RCAuth::check() || RCAuth::attempt()){
            return (RCAuth::user()->rcid ==='1285521');
        }
        return false;
    }
}
