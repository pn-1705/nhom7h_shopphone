@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="#" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Tên sản phẩm</label>
                                <input name="TenSP" type="text" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Mô tả</label>
                                <textarea name="MoTa" id="inputDescription" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="">
                                    <label for="inputStatus">Danh mục</label>
                                    <select name="DM_id" id="inputStatus" class="form-control custom-select">
                                        @foreach($cate as  $key => $vl)
                                            <option value="{{ $vl->id }}">{{ $vl->TenDM }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="inputStatus">Thương hiệu</label>
                                    <select name="TH_id" id="inputStatus" class="form-control custom-select">
                                        @foreach($br as  $key => $vl)
                                            <option value="{{ $vl->id }}">{{ $vl->TenLSP }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="inputStatus">Số lượng</label>
                                    <input name="SoLuong" type="number" class="form-control">
                                </div>
                                <div class="">
                                    <label for="inputStatus">Đơn giá</label>
                                    <input name="DonGia" type="number" class="form-control">
                                </div>
                                <div>
                                    <div class="">
                                        <label for="inputStatus">Hình ảnh 1</label>
                                        <input name="HinhAnh1" type="file">
                                    </div>
                                    <div class="">
                                        <label for="inputStatus">Hình Ảnh 2</label>
                                        <input name="HinhAnh2" type="file">
                                    </div>
                                    <div class="">
                                        <label for="HinhAnh3">Hình Ảnh 3</label>
                                        <input name="HinhAnh3" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Mã Khuyến Mãi</label>
                                <select name="KM_id" id="inputStatus" class="form-control custom-select">
                                    @foreach($km as  $key => $vl)
                                        <option value="{{ $vl->id }}">{{ $vl->TenKM }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tt">Trạng thái</label>
                                <select class="form-control" name="TrangThai" id="tt">
                                    <option selected value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Hủy</a>
                    <input type="submit" value="Thêm" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('ghiChu');
    </script>
@endsection
