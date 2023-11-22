<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        $search = $request->search;
        if ($search!=null){
            $sanpham = DB::table('sanpham')
                ->where('TenSP', 'like', '%' . $search . '%')
                ->orderBy('id', 'asc')
                ->paginate(16)
                ->withQueryString();
        }else{
            $sanpham = DB::table('sanpham')
                ->orderBy('id', 'asc')
                ->paginate(16)->withQueryString();
        }

        $danhmuc = DB::table('danhmuc')
            ->get();
//        if ($request->ajax()) {
//            // Trả về dữ liệu JSON
//            return view("User.pavpage",
//                [
//                    'sanpham'=> $sanpham,
//                    'danhmuc'=>$danhmuc,
//                ]);
//        }
        return view("User.master",
            [
                'cart'=>$cart,
                'yeuthich'=>$yeuthich,
                'sanpham'=> $sanpham,
                'danhmuc'=>$danhmuc,
            ]);
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
    public function testmail()
    {
        //
        $name = 'test';

        Mail::send('MailTo.xacthuc', compact('name'), function ($email) {
            $email->subject('DEMO');
            $email->to('2002long2906@gmail.com', 'Test Mail 1');
        });
    }
}
