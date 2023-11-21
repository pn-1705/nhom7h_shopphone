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
            return redirect()->route('login')->withErrors([
                'message' => 'Bạn phải đăng nhập để truy cập trang này.'
            ]);
        }
        $userRole = Auth::user()->Quyen_id;
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request);
            }
        }
        if (Auth::check()){
            Session::flash("error",'Bạn không có quyền truy cập vào trang này.');
            return redirect()->route('login')->withErrors([
                'message' => 'Bạn không có quyền truy cập vào trang này.'
            ]);
        }
        else{
            return redirect()->route('login')->withErrors([
                'message' => 'Bạn phải đăng nhập để truy cập trang này.'
            ]);
        }
        return $next($request);
    }
}
