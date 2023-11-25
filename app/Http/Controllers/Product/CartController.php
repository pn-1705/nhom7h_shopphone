<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmuc = DB::table('danhmuc')
            ->get();
        if (Auth::check()){
            $sanpham = DB::table('giohang')
                ->join('sanpham','sanpham.id','=','id_sp')
                ->where('id_nd','=',Auth::user()->id)
                ->get();

            return view('User.pages.cart',[
                'cart'=> $sanpham,
                'danhmuc' => $danhmuc,
            ]);
        }else{
            Session::flash('error','Bạn cần đăng nhập trước');
            return redirect('login');
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $idsp = $request->idsp;
        $sl = $request->sl;
        $idND = Auth::user()->id;
        $cart = DB::table('giohang')
            ->where('id_sp','=',$idsp)
            ->where('id_nd','=',$idND)
            ->first();
        if ($cart!=null){
            DB::table('giohang')
                ->where('id_sp','=',$idsp)
                ->where('id_nd','=',$idND)
                ->update([
                    'so_luong'=>$cart->so_luong+($sl==null?1:$sl)
                ]);
        }else{
            DB::table('giohang')
                ->insert([
                    'id_nd' => $idND,
                    'id_sp' => $idsp,
                    'so_luong'=>($sl==null?1:$sl),
                ]);
        }

        \Illuminate\Support\Facades\Session::flash('success','Thêm thành công');
        return redirect()->back();
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
    public function update(Request $request)
    {
        $idSPs = $request->id;
        $sls = $request->soluong;
        $idND = Auth::user()->id;
        $tts= $request->trangthai;
        for ($i = 0; $i < count($idSPs); $i++) {
            $idsp = $idSPs[$i];
            $sl = explode("/", $sls[$i])[0];
            $tt= $tts[$i];
            if ($sl>0){
                DB::table('giohang')
                    ->where('id_sp','=',$idsp)
                    ->where('id_nd','=',$idND)
                    ->update(['so_luong'=>$sl,'trangthai'=>$tt]);
            }else{
                DB::table('giohang')
                    ->where('id_sp','=',$idsp)
                    ->where('id_nd','=',$idND)
                    ->delete();
            }

        }
        \Illuminate\Support\Facades\Session::flash('success','Chỉnh sửa thành công');
        return redirect('cart');
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
    public function updatecart(Request $request)
    {
        $idsp = $request->id;
        $sl = $request->soluong;
        $idND = Auth::user()->id;
        $tt= $request->trangthai;
        if ($sl>0){
            DB::table('giohang')
                ->where('id_sp','=',$idsp)
                ->where('id_nd','=',$idND)
                ->update(['so_luong'=>$sl,'trangthai'=>$tt]);
        }else{
            DB::table('giohang')
                ->where('id_sp','=',$idsp)
                ->where('id_nd','=',$idND)
                ->delete();
        }
        $updatedCart = DB::table('giohang')
            ->join('sanpham','sanpham.id','=','id_sp')
            ->where('id_nd','=',Auth::user()->id)
            ->where('giohang.trangthai','=',1)
            ->get();

        $totalValue = $updatedCart->sum(function ($item) {
            return $item->giatrithuc * $item->so_luong;
        });

        $SubtotalValue = $updatedCart->sum(function ($item) {
            return $item->DonGia * $item->so_luong;
        });

        \Illuminate\Support\Facades\Session::flash('success','Chỉnh sửa thành công');

        return response()->json(['totalValue' => $totalValue, 'SubtotalValue' => $SubtotalValue]);
        //

    }
}
