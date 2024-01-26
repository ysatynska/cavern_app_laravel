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

        if (RCAuth::check() || RCAuth::attempt()) {
            $rcid = RCAuth::user()->rcid;

            // $user = User::where('RCID', $rcid)->first();

            if ($rcid='1285521') {
                $returnRoute = $next($request);
            }
        }

        return $returnRoute;
    }
}
