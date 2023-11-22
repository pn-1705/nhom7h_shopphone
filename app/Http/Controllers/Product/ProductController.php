<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

        $id = $request->id;
        $sanpham = DB::table('sanpham')
            ->where('id','=',$id)
            ->first();
//        dd($sanpham);
        $danhmuc = DB::table('danhmuc')
            ->get();
        if (Auth::check()) {
            $cart = DB::table('giohang')
                ->join('sanpham', 'sanpham.id', '=', 'id_sp')
                ->where('id_nd', '=', Auth::user()->id)
                ->get();
            $yeuthich = DB::table('yeuthich')
                ->join('sanpham', 'sanpham.id', '=', 'idSP')
                ->where('idND', '=', Auth::user()->id)
                ->get();
        }else{
            $cart = null;
            $yeuthich=null;
        }
        return view("Product.Details",
            [
                'cart'=>$cart,
                'yeuthich'=>$yeuthich,
                'sanpham'=> $sanpham,
                'danhmuc'=>$danhmuc,
            ]);
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
}
