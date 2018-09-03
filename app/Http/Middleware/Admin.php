<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use User;
/*
* klasa dzialajaca jako prosty ACL - kontroluje dostep użytkownika, ktory jest adminem do okreslonej sciezki
*
*/

class Admin
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
        if(!Auth::user()->admin)
        {
            Session::flash('info', 'Nie masz uprawnień do wykonania tego działania.');
            return redirect()->back();
        }
        return $next($request);
    }
}
