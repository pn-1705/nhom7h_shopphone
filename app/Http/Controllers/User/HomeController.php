<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function back;
use function redirect;
use function view;

session_start();

class HomeController extends Controller
{
    public function index()
    {
        $sp_noi_bat = DB::select('SELECT sanpham.id, TenSP, DonGia, HinhAnh1, KM_id, TenDM, TenLSP
                                FROM sanpham, danhmuc, loaisanpham
                                where sanpham.DM_id=danhmuc.id and sanpham.TH_id=loaisanpham.id and sanpham.TrangThai != 0
                                ORDER by DonGia desc
                                LIMIT 3');
        $sp_khuyen_mai = DB::select('SELECT sanpham.id, TenSP, DonGia, HinhAnh1, KM_id, TenDM, TenLSP
                                    FROM khuyenmai, sanpham, danhmuc, loaisanpham
                                    where sanpham.KM_id=khuyenmai.id and sanpham.DM_id=danhmuc.id and sanpham.TH_id=loaisanpham.id
                                    and khuyenmai.id!=1
                                    and ((CURDATE() BETWEEN NgayBD and NgayKT) or (NgayKT is NULL))
                                    and sanpham.TrangThai != 0
                                    ORDER by DonGia desc
                                    limit 3');
        $sp_moi = DB::select('SELECT sanpham.id, TenSP, DonGia, HinhAnh1, KM_id, TenDM, TenLSP
                                FROM sanpham, danhmuc, loaisanpham
                                where sanpham.DM_id=danhmuc.id and sanpham.TH_id=loaisanpham.id and sanpham.TrangThai != 0
                                ORDER by sanpham.id desc
                                LIMIT 6');
        return view('user.pages.index', ['sp_noi_bat'=>$sp_noi_bat, 'sp_khuyen_mai'=>$sp_khuyen_mai, 'sp_moi'=>$sp_moi]);
    }

    public function cart()
    {
        if(session()->get('id') != null) {
            while(true) {
                $result = DB::table('giohang')
                        ->join('sanpham', 'sanpham.id', '=', 'giohang.id_sp')
                        ->where('id_nd', Session()->get('id'))
                        ->whereColumn('so_luong', '>', 'SoLuong')
                        ->first();
                if($result) {
                    DB::table('giohang')
                        ->where('id_nd', $result->id_nd)
                        ->where('id_sp', $result->id_sp)
                        ->update(['so_luong' => $result->SoLuong]);
                } else {
                    $result = DB::table('giohang')
                            ->join('sanpham', 'sanpham.id', '=', 'giohang.id_sp')
                            ->where('id_nd', Session()->get('id'))
                            ->orderBy('ngay_tao', 'desc')
                            ->get();
                    return view('user.pages.cart', ['list_cart' => $result]);
                }
            }
        }
        else {
            $link1 = 'http://localhost:8080/phonestore/cart/';
            Session::put('link', $link1);
            return redirect()->route("login");
        }
    }

    public function thanh_toan_view(Request $request)
    {
        $cart = DB::table('giohang')
            ->join('sanpham','sanpham.id','=','giohang.id_sp')
            ->where('id_nd','=',Auth::user()->id)
            ->where('giohang.trangthai','=','1')
            ->get();
        $nguoi_dung = DB::table('nguoidung')->where('id', Auth::user()->id)->first();
        $tinh_thanh = DB::table('tinhthanh')->get();
        $subtotal=0;
        $total=0;
        foreach($cart as $c){
            if($c->trangthai==1){
                $subtotal += $c->so_luong*$c->DonGia;
                $total +=$c->so_luong*$c->giatrithuc;
            }
        }
        $gia=$subtotal;
        $km=$subtotal-$total;
//        return view('user.pages.thanh_toan', ['cart'=>$cart, 'nguoi_dung'=>$nguoi_dung, 'tinh_thanh'=>$tinh_thanh,'km'=>$km,'gia'=>$gia]);
        return view('user.pages.checkout', ['cart'=>$cart, 'nguoi_dung'=>$nguoi_dung, 'tinh_thanh'=>$tinh_thanh,'km'=>$km,'gia'=>$gia]);
    }

    public function thanh_toan(Request $rq)
    {
        $rq->validate([
            'id_tinh'=>'required',
            'id_huyen'=> 'required',
            'id_xa' => 'required',
            'diachi' => 'required',
        ]);
        $nguoi_nhan = $rq->Ho.' '.$rq->Ten;
        $tinhthanh = DB::table('devvn_tinhthanhpho')
            ->where('matp','=',$rq->id_tinh)
            ->first();
        $quanhuyen = DB::table('devvn_quanhuyen')
            ->where('maqh','=',$rq->id_huyen)
            ->first();
        $xaphuong = DB::table('devvn_xaphuongthitran')
            ->where('xaid','=',$rq->id_xa)
            ->first();
        $diachi=$rq->diachi.' - '.$xaphuong->name.' - '.$quanhuyen->name.' - '.$tinhthanh->name.' - Việt Nam';
        $cart = DB::table('giohang')
            ->join('sanpham','sanpham.id','=','giohang.id_sp')
            ->where('id_nd','=',Auth::user()->id)
            ->where('giohang.trangthai','=','1')
            ->get();
        $total=0;
        foreach($cart as $c){
            if($c->trangthai==1){
                $total +=$c->so_luong*$c->giatrithuc;
            }
        }
        $tinhthanh->matp!=15?$total+=35000:$total+=20000;
        $magiamgia=$rq->magiamgia;
        if($magiamgia!=null){
            $data=DB::table('magiamgia')
                ->where('magiamgia','like',$magiamgia)
                ->where('trangthai','>',0)
                ->where('soluongcon','>',0)
                ->where('toithieu','<',$total)
                ->first();
            if ($data!=null){
                if($data->loai==1){
                    $giam = min($data->giatri*$total,$data->giatri);
                }else{
                    $giam= $data->giatri;
                }
                $total=$total-$giam;
            }
        }
        if($rq->pttt != '') {
            if (Auth::user()->sodu<$total){
                Session::flash('error','Số tiền của bạn không đủ. Vui lòng nạp thêm ít nhất '.number_format($total-Auth::user()->sodu, 0, ',', '.').' VNĐ hoặc chọn phương thức thanh toán khác để tiếp tục giao dịch');
                return back();
            }
        }
        $id_hd = DB::table('hoadon')->max('id') + 1;
        DB::insert('insert into hoadon (MaND, NguoiNhan, SDT, DiaChi, TongTien, TrangThai) values ( ?, ?, ?, ?, ?, ?)', [Auth::user()->id, $nguoi_nhan, $rq->SDT, $diachi, $total, 0]);
        if($rq->pttt != '') {
            DB::table('hoadon')
                ->where('id', $id_hd)
                ->update(['PhuongThucTT'=>$rq->pttt]);
        }
        foreach ($cart as $dm) {
            $DonGia = $dm->giatrithuc;
            $sl = $dm->so_luong;
            DB::insert('insert into chitiethoadon (MaHD, MaSP, SoLuong, DonGia) values (?, ?, ?, ?)', [$id_hd, $dm->id_sp, $sl, $DonGia]);
            DB::table('giohang')
                ->where('id_nd', Auth::user()->id)
                ->where('id_sp',  $dm->id_sp)
                ->delete();
            DB::table('sanpham')
                ->where('id',  $dm->id_sp)
                ->update(['SoLuong'=> $dm->SoLuong-$sl]);
        }
        return redirect()->intended('/quanlydonhang');
    }

    public function search(Request $rq)
    {
        $input = $rq->search;
        $result = DB::table('sanpham')
                    ->where('TenSP', 'like', '%'.$input.'%')
                    ->where('TrangThai', '!=', 0)
                    ->orderBy('id', 'desc')
                    ->get();
        return view('user.pages.search', ['sp_tim_kiem'=>$result, 'tu_khoa'=>$input]);
    }
    public function get_data_location(Request $request)
    {
        $idt = $request->id_tinh;
        $idh = $request->id_huyen;
        if ($request->stt==null){
        }else{
            if($request->stt==0){
                $data=    DB::table('devvn_quanhuyen')
                    ->select("devvn_quanhuyen.*")
                    ->join('devvn_tinhthanhpho','devvn_quanhuyen.matp','=','devvn_tinhthanhpho.matp')
                    ->where('devvn_quanhuyen.matp', '=', $idt)
                    ->get();
            }
            if($request->stt==1){
                $data= DB::table('devvn_xaphuongthitran')
                    ->select('devvn_xaphuongthitran.*')
                    ->join('devvn_quanhuyen','devvn_quanhuyen.maqh','=','devvn_xaphuongthitran.maqh')
                    ->where('devvn_xaphuongthitran.maqh', '=', $idh)
                    ->get();
            }
        }
        \Illuminate\Support\Facades\Session::flash('success', 'Chỉnh sửa thành công');

        return response()->json(['stt' => $request->stt, 'data' => $data]);
    }
    public function addcoupon(Request $request)
    {
        $mgg = $request->magiamgia;
        $data=null;
        if($mgg!=null){
            $data=DB::table('magiamgia')
                ->where('magiamgia','like',$mgg)
                ->where('trangthai','>',0)
                ->where('soluongcon','>',0)
                ->first();
        }

        \Illuminate\Support\Facades\Session::flash('success', 'Thêm mã giảm giá thành công');
        return response()->json(['data' => $data]);
    }
}
