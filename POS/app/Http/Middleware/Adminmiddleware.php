<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function Symfony\Component\String\b;

class Adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      if(Auth::user()){
                //when user login
                if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' ){
                    //user current login
                      //dd($request->route()->getName());
                      if( $request->route()->getName() =='login' || $request->route()->getName() =='register' ){

                        return back();

                    }     return $next($request);


                } return back();


        }else{
           return $next($request);
        }


    }
}
