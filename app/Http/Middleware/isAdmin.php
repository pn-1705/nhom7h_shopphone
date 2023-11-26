<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        if (!Auth::check()) {
            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
            return redirect()->route('login');
        }
//        if(Auth::user()->password==null){
//            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
//            return redirect()->route('login');
//        }
//        if(Auth::user()->password==null){
//            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
//            return redirect()->route('login');
//        }
        $userRole = Auth::user()->Quyen_id;
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request);
            }
        }
        if (Auth::check()){
            Session::flash("error",'Bạn không có quyền truy cập vào trang này.');
            return redirect()->route('login')->withErrors([
                'error' => 'Bạn không có quyền truy cập vào trang này.'
            ]);
        }
        else{
            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
