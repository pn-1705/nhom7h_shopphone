<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function back;
use function redirect;
use function view;
use PDF;

class UserController extends Controller
{
    public function quen_mk_view()
    {
    	if(Session('id')==null) {
    		return view('user.pages.quen_mk');
    	} else {
    		return redirect()->intended('/');
    	}
    }

    public function doi_mk_view()
    {
    	if(Auth::check()==false) {
    		return redirect()->intended('/login');
    	} else {
    		$result = DB::table('nguoidung')->where('id', Auth::user()->id)->first();
    		return view('user.pages.doi_mk', ['email'=>$result->email]);
    	}
    }

    public function doi_mk(Request $rq)
    {
        // kiểm tra mật khẩu cũ
        if(Auth::check()==true) {
            $result = DB::table('nguoidung')->where('email', $rq->email)->first();
            if(!Hash::check($rq->input('password_old'), $result->password)) {
                return view('user.pages.doi_mk', ['error'=>'Mật khẩu cũ không đúng', 'email'=>$rq->email]);
            }
        }
        // kiểm tra mật khẩu mới
        if($rq->password != $rq->password_kt) {
            return view('user.pages.doi_mk', ['error'=>'Mật khẩu xác nhận không đúng', 'email'=>$rq->email]);
        } else {
            $password = Hash::make($rq->input('password'));
            DB::update('update nguoidung set password = ? where email = ?', [$password, $rq->email]);
            Auth::logout();
            Session::flash('logout_success', 'Đổi mật khẩu thành công');
            return redirect()->route('login');
        }
    }

    public function user_inf()
    {
        if(Auth::check()== false)
//            dd(Session());
            return redirect()->intended('/login');
        else {
            $result = DB::table('nguoidung')->where('id', Auth::user()->id)->first();
            return view('user.pages.profile', ['user'=>$result]);
        }
    }

    public function user_inf_edid(Request $rq)
    {
        $rq->validate([
                'Ho'=>'required',
                'Ten'=> 'required',
                'SDT' => 'required',
            ]);

        DB::table('nguoidung')
                ->where('id', Auth::user()->id)
                ->update([  'Ho' => $rq->Ho,
                            'Ten' => $rq->Ten,
                            'SDT' => $rq->SDT,
                            'GioiTinh' => $rq->GioiTinh,
                            'ma_tinh' => $rq->ma_tinh,
                            'ma_huyen' => $rq->ma_huyen,
                            'ma_xa' => $rq->ma_xa,
                            'DiaChi' => $rq->dia_chi
                        ]);
        return back()->with('success', 'Sửa đổi thông tin thành công');
    }

    public function don_mua()
    {
        if(Auth::check() == false)
            return redirect()->intended('/login');
        else {
            $result = DB::table('hoadon')
                        ->where('MaND', Auth::user()->id)
                        ->orderBy('id', 'desc')
                        ->get();
            return view('user.pages.don_mua', ['don_mua'=>$result]);
        }
    }
    public function locdonmua(Request $request)
    {
        if(Auth::check() == false)
            return redirect()->intended('/login');
        else {
            $result = DB::table('hoadon')
                ->where('MaND', Auth::user()->id)
                ->where('TrangThai','=',$request->trangthai)
                ->orderBy('id', 'desc')
                ->get();
            return view('user.ajax.don_mua_fil', ['don_mua'=>$result]);
        }
    }

    public function in_don_hang($id_hd)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->in_don_hang_noi_dung($id_hd));
        return $pdf->stream();
    }

    public function in_don_hang_noi_dung($id_hd)
    {
        $nguoi_dung = DB::table('hoadon')->where('id', $id_hd)->first();
        $van_chuyen = $nguoi_dung->ma_tinh = 15 ? 20000 : 35000;

        $sp_thanh_toan = DB::table('chitiethoadon')->where('MaHD', $id_hd)->get();
        $san_pham=array();
        $gia = 0;
        $i = 0;
        foreach ($sp_thanh_toan as $value) {
            $sp = DB::table('sanpham')->where('id', $value->MaSP)->first();
            $khuyen_mai = DB::table('khuyenmai')->where('id', $sp->KM_id)->first();
            $sl = $value->SoLuong;
            $gia += $sp->DonGia*$sl;


            $san_pham[$i]['ten'] = $sp->TenSP;
            $san_pham[$i]['DonGia'] = $sp->DonGia;
            $san_pham[$i]['so_luong'] = $sl;
            if($khuyen_mai->don_vi == 'VNĐ') {
                $san_pham[$i]['khuyen_mai'] = $khuyen_mai->GiaTriKM*$sl;
            } else {
                $san_pham[$i]['khuyen_mai'] = ($sp->DonGia*$khuyen_mai->GiaTriKM/100)*$sl;
            }
            $i++;
        }
        return view('user.pages.xuat_hoa_don', ['id_hd'=>$id_hd, 'nguoi_dung'=>$nguoi_dung, 'san_pham'=>$san_pham, 'gia'=>$gia, 'van_chuyen'=>$van_chuyen]);
    }
    public function naptien(Request $request)
    {
            return view('user.pages.naptien');
    }
    public function xacnhannap(Request $request)
    {
//        dd($request);
        $request->validate([
            'username'=>'required',
            'bank'=> 'required',
            'amonut' => 'required',
            'ndck' => 'required',
        ]);
        DB::table('lichsunap')
            ->insert([
                'idnd'=>$request->username,
                'ndck'=>$request->ndck,
                'giatri'=>$request->amonut,
                'ngay'=>now(),
                'trangthai'=>0,
        ]);
        Session::flash("success","Gửi thành công. Vui lòng xác nhận");
        return back();
    }


}
