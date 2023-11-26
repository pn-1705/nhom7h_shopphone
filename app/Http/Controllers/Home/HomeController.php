<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $search = $request->search;
        $dm = $request->danhmuc;
        $sanpham = DB::table('sanpham')
            ->where('trangthai', '=', 1)
            ->orderBy('id', 'asc')
            ->paginate(16)->withQueryString();
        if ($search!=null){
            $sanpham = DB::table('sanpham')
                ->where('TenSP', 'like', '%' . $search . '%')
                ->where('trangthai', '=', 1)
                ->orderBy('id', 'asc')
                ->paginate(16)
                ->withQueryString();
        }
        if ($dm!=null) {
            $sanpham = DB::table('sanpham')
                ->where('DM_id', '=', $dm)
                ->where('trangthai', '=', 1)
                ->orderBy('id', 'asc')
                ->paginate(16)
                ->withQueryString();
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
        return view("User.pages.index",
            [
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
