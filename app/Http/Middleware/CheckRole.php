<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        
         if($request->user()===null)
        {
            return redirect('/')->withErrors([
        'message'=>'Sorry , You don\'t have Permission to access this data \n You Should login First !! ']);
        }
        $action=$request->route()->getAction();
        $roles= isset($action['roles'])?$action['roles']:null;
        if($request->user()->hasAnyRoles($roles)|| !$roles){
            return $next($request); 
           // return redirect('/');
        }
        else{
          return redirect('/accessDenied');
         // return redirect('/');
        }
    }
}
