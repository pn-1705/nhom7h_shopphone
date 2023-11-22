<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Psy\Util\Str;

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
        $token = strtoupper(\Illuminate\Support\Str::random(15));
        $data=$request->only('name','email','password');
        $data['token']=$token;

        $checkmail = DB::table('nguoidung')
            ->where('email','=',$request->input('email'))
            ->get();
        if ($checkmail->isEmpty()){
            DB::table('nguoidung')->insert(
                [
                    'Ten'=> $request->input('name'),
                    'username'=> $request->input('email'),
                    'email'=>$request->input('email'),
                    'password'=> bcrypt($request->input('password')),
                    'Quyen_id'=>'1',
                    'google_token'=>$token,
                ]);
            $customer = DB::table('nguoidung')
                ->where('email','=',$request->input('email'))
                ->first();
            Mail::send('MailTo.xacthuc', compact('customer'), function ($email) use ($customer) {
                $email->subject('Email kích hoạt tài khoản');
                $email->to($customer->email, $customer->Ten);
            });
        }
        Session::flash('success','Bạn đã đăng ký thành công. Vui lòng kiểm tra Email để kích hoạt tài khoản');
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
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            if (Auth::user()->google_stt==0) {

                Auth::logout();
                Session::flash("error",'Bạn chưa kích hoạt tài khoản');
                return redirect()->route('login');
            }
            Session::flash('message', 'Đăng nhập thành công');
            return redirect()->route('viewHome');
        }else{
            dd("11");
            return back()->with('error','Sai thông tin');
        }
//        if ($user!=null){
//            if (Auth::loginUsingId($user->id)) {
//                // Authentication was successful
//                Session::flash('message', 'Đăng nhập thành công');
//                return redirect()->route('viewHome');
//            } else {
//                // Authentication failed
//                Session::flash('error', 'Có lỗi xảy ra!');
//                return back();
//            }
//        }else{
//            Session::flash('error', 'Sai thông tin!');
//            return back()->with('message','Sai thông tin');
//        }
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
    public function activate()
    {
        Auth::logout();
        return redirect()->route('viewHome');
    }
    public function forget()
    {
        Auth::logout();
        return redirect()->route('viewHome');
    }
}
