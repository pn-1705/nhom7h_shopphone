<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $list = DB::table('sanpham')
            ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
            ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
            ->join('khuyenmai', 'sanpham.KM_id', '=', 'khuyenmai.id')
            ->select('sanpham.*', 'danhmuc.TenDM', 'loaisanpham.TenLSP', 'khuyenmai.TenKM')
            ->orderBy('danhmuc.id')
            ->get();
        if ($id = request()->product) {
            $list = DB::table('sanpham')
                ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
                ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
                ->join('khuyenmai', 'sanpham.KM_id', '=', 'khuyenmai.id')
                ->orderBy('danhmuc.id')
                ->where('sanpham.TenSP', 'like', '%' . $id . '%')
                ->select('sanpham.*', 'danhmuc.TenDM', 'loaisanpham.TenLSP', 'khuyenmai.TenKM')
                ->get();
        }
        $list_cate = Category::get();
        $data['list_cate'] = $list_cate;
        $list_brand = Brand::get();
        $data['list_brand'] = $list_brand;
        $data['list_product'] = $list;
        return view('admin.pages.product.index', $data);
    }

    public function addProduct()
    {
        $cate = DB::table('danhmuc')->get();
        $br = DB::table('loaisanpham')->get();
        $km = DB::table('khuyenmai')->get();
        $data['title'] = "Thêm sản phẩm";
        $data['cate'] = $cate;
        $data['br'] = $br;
        $data['km'] = $km;
        return view('admin.pages.product.add', $data);
    }

    public function addProductPost(Request $request)
    {
        $data = $request->all();
        $new = new Product();
        $new->TH_id = $request->TH_id;
        $new->DM_id = $request->DM_id;
        $new->MoTa = $request->MoTa;
        $new->TenSP = $request->TenSP;
        $new->DonGia = $request->DonGia;
        $new->SoLuong = $request->SoLuong;
        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('HinhAnh1')) {
            $fileName1 = $request->file('HinhAnh1')->getClientOriginalName();
            $fileName1 = time() . '_1' . $fileName1;
            $request->file('HinhAnh1')->storeAs('public/img/products', $fileName1);
            $new->HinhAnh1 = 'img/products/'.$fileName1;
        }
        if ($request->hasFile('HinhAnh2')) {
            $fileName2 = $request->file('HinhAnh2')->getClientOriginalName();
            $fileName2 = time() . '_2' . $fileName2;
            $request->file('HinhAnh2')->storeAs('public/img/products', $fileName2);
            $new->HinhAnh2 = 'img/products/'.$fileName2;
        }
        if ($request->hasFile('HinhAnh3')) {
            $fileName3 = $request->file('HinhAnh3')->getClientOriginalName();
            $fileName3 = time() . '_3' . $fileName3;
            $request->file('HinhAnh3')->storeAs('public/img/products', $fileName3);
            $new->HinhAnh3 = 'img/products/'.$fileName3;
        }

        $new->KM_id = $request->KM_id;
        $new->TrangThai = $request->TrangThai;
        $new->save();

        return redirect()->route("admin.product.index")->with('add', 'Sửa thành công');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cate = DB::table('danhmuc')->get();
        $br = DB::table('loaisanpham')->get();
        $km = DB::table('khuyenmai')->get();
        $data['product'] = $product;
        $data['cate'] = $cate;
        $data['br'] = $br;
        $data['km'] = $km;
        return view('admin.pages.product.edit', $data);
    }

    public function update($id, Request $request)
    {

        $new = Product::find($id);
        $new->TH_id = $request->TH_id;
        $new->DM_id = $request->DM_id;
        $new->MoTa = $request->MoTa;
        $new->TenSP = $request->TenSP;
        $new->DonGia = $request->DonGia;
        $new->SoLuong = $request->SoLuong;
        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->has('HinhAnh1')) {
            $fileName1 = $request->file('HinhAnh1')->getClientOriginalName();
            $fileName1 = time() . '_1' . $fileName1;
            $request->file('HinhAnh1')->storeAs('public/img/products', $fileName1);
            $new->HinhAnh1 = 'img/products/'.$fileName1;
        }
        if ($request->has('HinhAnh2')) {
            $fileName2 = $request->file('HinhAnh2')->getClientOriginalName();
            $fileName2 = time() . '_2' . $fileName2;
            $request->file('HinhAnh2')->storeAs('public/img/products', $fileName2);
            $new->HinhAnh2 = 'img/products/'.$fileName2;
        }
        if ($request->has('HinhAnh3')) {
            $fileName3 = $request->file('HinhAnh3')->getClientOriginalName();
            $fileName3 = time() . '_3' . $fileName3;
            $request->file('HinhAnh3')->storeAs('public/img/products', $fileName3);
            $new->HinhAnh3 = 'img/products/'.$fileName3;
        }

        $new->KM_id = $request->KM_id;
        $new->TrangThai = $request->TrangThai;
        $new->save();
        return redirect()->route("admin.product.index")->with('updated', 'Data updated thành công');
    }

    public function destroy($id)
    {
        DB::table('sanpham')->where('id', $id)->delete();
        return redirect()->route("admin.product.index")->with('del', 'Data deleted thành công');
    }

    public function active($id)
    {
        $pr = Product::find($id);
        $product = Product::find($id);
        if ($pr->TrangThai == 1) {
            $product->TrangThai = 0;
        } else {
            $product->TrangThai = 1;
        }
        $product->save();
        return redirect()->back()->with('active', 'Đã chuyển trạng thái SP' . $id);

    }

}
