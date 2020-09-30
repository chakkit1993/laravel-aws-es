<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class VerifyIsAdmin
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
        if(!auth()->user()->IsAdmin() ){
            Session()->flash('error','ไม่ใช่ผู้ดูแลระบบ');

            return redirect(route('home'));
        }

        return $next($request);
    }
}
