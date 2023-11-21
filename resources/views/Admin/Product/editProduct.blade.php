@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form enctype="multipart/form-data" action="" method="POST" >
        <div class="card-body">
            <div class="form-group">
                <label for="">Mã hộ</label>
                <input type="text" name="idHoGiaDinh" class="form-control" id="" value="{{$menu->idHoGiaDinh}}" readonly placeholder="">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Số lượng thành viên</label>
                        <input type="text" name="soLuongThanhVien" class="form-control" id="" placeholder="Tên hàng hóa" value="{{$menu->soLuongThanhVien}}">
                    </div>
                    <div class="form-group">
                        <label for="">Thuộc loại hộ</label>
                        <select class="form-control" name="idLoaiHoGD" id="idLoaiHoGD" >
                            @foreach($dlls as $dll)
                                <option value="{{ $dll->idLoaiHoGD }}" {{ $menu->idLoaiHoGD == $dll->idLoaiHoGD ? 'selected' : '' }}>
                                    {{ $dll->LoaiHoGD }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="diaChi" class="form-control" id="" value="{{$menu->diaChi}}">
                    </div>
                    <div class="form-group">
                        <label for="idDanhMuc">Xã</label>
                        <select class="form-control" id="" name="idXa">
                            <option value="-1">Tất cả</option>
                            @foreach ($xas as $id)
                                <option value="{{ $id->idXa }}"  {{ $id->idXa == $menu->idXa ? 'selected' : ''}}>{{$id->tenXa}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
    </form>

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('ghiChu');
    </script>

@endsection
