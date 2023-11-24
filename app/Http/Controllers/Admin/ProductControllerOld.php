<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductControllerOld extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
//        $menus = DB::table('sanpham')
//            ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
//            ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
//            ->select('sanpham.*', 'loaisanpham.TenLSP', 'danhmuc.TenDM')
//            ->orderBy('sanpham.id', 'asc');
//        $menus= $menus->paginate(6)->withQueryString();
//
//        $loai = DB::table('loaisanpham')
//            ->get();
//        $dm = DB::table('danhmuc')
//            ->get();
//        return view('admin/Product/listProduct',[
//            'title'=>'Quản lý sản phẩm',
//            'menus'=>$menus,
//            'loais'=>$loai,
//            'danhmuc'=>$dm,
//        ]);
        $idDM = $request->input('idDM');
        $idNCC = $request->input('idNCC');
        $sort = $request->input('sortby');
        $stt = $request->input('stt');
        if ($idDM == null) $idDM=-1;
        if ($idNCC == null) $idNCC=-1;
        if($idDM==-1 and $idNCC==-1){
            $menus = DB::table('sanpham')
                ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
                ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
                ->select('sanpham.*', 'loaisanpham.TenLSP', 'danhmuc.TenDM')
                ->orderBy('sanpham.id', 'asc')
                ->paginate(6)->withQueryString();
        }elseif ($idNCC!=-1 and $idDM==-1){
            $menus = DB::table('sanpham')
                ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
                ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
                ->select('sanpham.*', 'loaisanpham.TenLSP', 'danhmuc.TenDM')
                ->where('loaisanpham.id', $idNCC)
                ->orderBy('sanpham.id', 'asc')
                ->paginate(6)->withQueryString();
        }elseif ($idNCC==-1 and $idDM!=-1){
            $menus = DB::table('sanpham')
                ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
                ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
                ->select('sanpham.*', 'loaisanpham.TenLSP', 'danhmuc.TenDM')
                ->where('danhmuc.id', $idDM)
                ->orderBy('sanpham.id', 'asc')
                ->paginate(6)->withQueryString();
        }else{
            $menus = DB::table('sanpham')
                ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
                ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
                ->select('sanpham.*', 'loaisanpham.TenLSP', 'danhmuc.TenDM')
                ->where('danhmuc.id', $idDM)
                ->where('loaisanpham.id', $idNCC)
                ->orderBy('sanpham.id', 'asc')
                ->paginate(6)->withQueryString();
        }
        $loai = DB::table('loaisanpham')
            ->get();
        $dm = DB::table('danhmuc')
            ->get();

        return view('admin/Product/listproduct',[
            'title'=>'Quản lý sản phẩm',
            'menus'=>$menus,
            'loais'=>$loai,
            'danhmuc'=>$dm,
            'idDM' =>$idDM,
            'idNCC' => $idNCC
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
        $cate = DB::table('danhmuc')->get();
        $br = DB::table('loaisanpham')->get();
        $km = DB::table('khuyenmai')->get();
        $data['title'] = "Thêm sản phẩm";
        $data['cate'] = $cate;
        $data['br'] = $br;
        $data['km'] = $km;
        return  view('Admin/Product/addProduct',$data);
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
    public function filter(Request $request)
    {

    }
}
