@extends('admin.layout', ['title' => 'Nạp tiền'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h1 class="font-weight-bold">Quản lí</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-block">
                <div>
                    <h3 class="font-weight-bold card-title">Tất cả</h3>
                </div>
            </div>
            <div>
                @if(session('updated'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('updated')}}
                    </div>
                @endif
                @if(session('confirm'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('del')}}
                    </div>
                @endif
                @if(session('cancel'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                        {{session('updated')}}
                    </div>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã KH</th>
                        <th>Nội dung</th>
                        <th>Giá trị</th>
                        <th>
                            <select class="bg-dark form-control-sm font-weight-bold border-0" name="" id="sortStatus"
                                    onchange="sortStatus_naptien()">
                                <option value="" selected>Trạng thái</option>
                                <option class="" value="Chờ xác nhận">Chờ xác nhận</option>
                                <option class="" value="Thành công">Thành công</option>
                                <option class="" value="Đã hủy">Đã hủy</option>
                            </select>
                        </th>
                        <th>Xử lý</th>
                        <th>Thời gian</th>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tbOrder">
                    @foreach($list_order as $key => $value)
                        <tr>
                            <td>{{ $value -> id }}</td>
                            <td>{{ $value -> idnd }}</td>
                            <td>{{ $value -> ndck }}</td>
                            <td>{{ $value -> giatri }}</td>
                            <td>
                                @if($value -> trangthai== 0)
                                    <small class="text-danger spkey" value="0">Chờ xác nhận</small>
                                @elseif($value -> trangthai== 1)
                                    <small class="text-warning spkey" value="1">Thành công</small>
                                @elseif($value -> trangthai== 2)
                                    <small class="text-primary spkey" value="2">Đã hủy</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.naptien.activate', $value -> id) }}">
                                    <span class="badge badge-info">Xác nhận</span>
                                </a>
                                <a href="{{ route('admin.naptien.cancel', $value -> id) }}">
                                    <span class="badge badge-danger">Hủy</span>
                                </a>
                            </td>
                            <td>
                                {{date_format(new DateTime($value->ngay), 'H:i:s d/m/Y ')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        {{--        Xem chi tiết đơn hàng--}}
        <div id="detailOrder" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
             aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div>
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title text-uppercase font-weight-bold" id="exampleModalLabel">Thêm sinh
                                viên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="bg-dark" aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div>
                            <table class="table">
                                <tr>
                                    <th>Mã sinh viên:</th>
                                    <td><input required maxlength="13" placeholder="Mã sinh viên"
                                               class="form-control" name="masv" type="text"></td>
                                </tr>
                                <tr>
                                    <th>Họ sinh viên:</th>
                                    <td><input required placeholder="Họ" class="form-control" name="hosv"
                                               type="text"></td>
                                </tr>
                                <tr>
                                    <th>Tên sinh viên:</th>
                                    <td><input required placeholder="Tên" class="form-control" name="tensv"
                                               type="text"></td>
                                </tr>
                                <tr>
                                    <th>Giới tính:</th>
                                    <td>
                                        <select required class="form-control" name="gioitinh">
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><input maxlength="10" required placeholder="Số điện thoại"
                                               class="form-control" name="phone" type="text"></td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh:</th>
                                    <td><input required placeholder="Ngày sinh" class="form-control"
                                               name="ngaysinh" type="date"></td>
                                </tr>
                                <tr>
                                    <th>Quê quán:</th>
                                    <td><input required placeholder="Tỉnh/Thành phố" class="form-control"
                                               name="quequan" type="text"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class=" d-inline d-flex">
                                        <button type="button" class="font-weight-bold btn btn-secondary"
                                                data-dismiss="modal">HỦY
                                        </button>
                                        <input class="font-weight-bold btn btn-primary" type="submit"
                                               value="THÊM">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- /.card -->
    </section>
@endsection
