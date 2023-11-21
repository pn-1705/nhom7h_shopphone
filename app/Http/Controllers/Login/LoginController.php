<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()){
            if (Auth::user()->Quyen_id==1){
                return redirect()->route('viewHome');
            }elseif (Auth::user()->Quyen_id==2){
                return redirect()->route('admin');
            }elseif (Auth::user()->Quyen_id==3){
                return redirect()->route('CTV');
            }
        }
        return  view('User.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'name'=> 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmpassword'=>'required_with:password'
        ]);
        DB::table('nguoidung')->insert(
            [
                'Ten'=> $request->input('tenNguoiDung'),
                'username'=> $request->input('email'),
                'email'=>$request->input('email'),
                'password'=> bcrypt($request->input('password')),
                'Quyen_id'=>'1',
            ]);
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user =DB::table('nguoidung')
            ->where('email', $request->email)
            ->where('password',md5($request->password))
            ->first();

        if ($user!=null){
            if (Auth::loginUsingId($user->id)) {
                // Authentication was successful
                return redirect()->route('viewHome');
            } else {
                // Authentication failed
                return back()->withErrors(['email' => 'Invalid credentials']);
            }
        }else{
            Session::flash('error', 'Sai thông tin!');
            return back()->withErrors(['email' => 'Invalid credentials']);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('viewHome');
    }
}
