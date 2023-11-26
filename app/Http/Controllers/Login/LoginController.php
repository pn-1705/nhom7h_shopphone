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
use function PHPUnit\Framework\isEmpty;

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
            if (Auth::user()->google_stt==0) {
                Session::flash("error",'Bạn chưa kích hoạt tài khoản. <a href="/kichhoatlai?email="'.Auth::user()->email.'">Ấn vào đây để nhận lại email</a>');
                Auth::logout();
                return redirect()->route('login');
            }
            return redirect()->route('viewHome');
        }
        return  view('User.pages.login');
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
            'Ho'=>'required',
            'Ten'=> 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmpassword'=>'required_with:password'
        ]);
        $token = strtoupper(\Illuminate\Support\Str::random(15));
        $data=$request->only('Ho','Ten','email','password');
        $data['token']=$token;

        $checkmail = DB::table('nguoidung')
            ->where('email','=',$request->input('email'))
            ->get();
        if ($checkmail->isEmpty()){
            DB::table('nguoidung')->insert(
                [
                    'Ho'=> $request->input('Ho'),
                    'Ten'=> $request->input('Ten'),
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
                Session::flash("error",'Bạn chưa kích hoạt tài khoản. <a href="/kichhoatlai?email='.Auth::user()->email.'">Ấn vào đây để nhận lại email</a>');
                Auth::logout();
//                Session::flash("error",'Bạn chưa kích hoạt tài khoản');
                return redirect()->route('login');
            }
            Session::flash('message', 'Đăng nhập thành công');
            return redirect()->route('viewHome');
        }else{
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
    public function activate(Request $request)
    {
        $customer = DB::table('nguoidung')
            ->where('id' ,'=', $request->customer)
            ->where('google_token','=',$request->token)
            ->first();
        if($customer == null){
            Session::flash('error','Mã xác thực không hợp lệ');
            return redirect()->route('login');
        }else{
            DB::table('nguoidung')
                ->where('id', '=', $request->customer)
                ->where('google_token', '=', $request->token)
                ->update([
                    'google_token' => null,
                    'google_stt' => 1,
                ]);
            Session::flash('success','Xác thực thành công.');
            return redirect()->route('login');
        }
    }
    public function forget(Request $request)
    {
        if ($request->token!=null){
            $customer = DB::table('nguoidung')
                ->where('id' ,'=', $request->customer)
                ->where('maXN','=',$request->token)
                ->first();
            if($customer == null){
                Session::flash('error','Xác thực thất bại');
                return redirect()->route('login');
            }else{
                DB::table('nguoidung')
                    ->where('id', '=', $request->customer)
                    ->where('maXN', '=', $request->token)
                    ->update([
                        'password' => bcrypt($request->token),
                        'maXN'=>null,
                    ]);
                Session::flash('success','Kích hoạt mật khẩu mới thành công.');
                return redirect()->route('login');
            }
        }
    }
    public function quenmk()
    {
        return view('User.pages.quen_mk');
    }
    public function kichhoatlai(Request $request){
        $request->only('email');
        $token = strtoupper(\Illuminate\Support\Str::random(15));
        DB::table('nguoidung')
            ->where('email','=',$request->input('email'))
            ->update([
                'google_token'=>$token,
            ]);
        $customer = DB::table('nguoidung')
            ->where('email','=',$request->input('email'))
            ->first();
        $email=$customer->email;
        Mail::send('MailTo.xacthuc', compact('customer'), function ($email) use ($customer) {
            $email->subject('Email kích hoạt tài khoản');
            $email->to($customer->email, $customer->Ten);
        });
        Session::flash('success','Gửi email kích hoạt thành công');
        return redirect()->route('login');
    }
}
