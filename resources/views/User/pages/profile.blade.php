<?php
if (Auth::check()) {
    $tinhthanh = DB::table('devvn_tinhthanhpho')
        ->get();
    $quanhuyen = DB::table('devvn_quanhuyen')
        ->get();
    $xaphuong = DB::table('devvn_xaphuongthitran')
        ->get();
}else{
    $cart = null;
    $yeuthich=null;
}
?>
@extends('User.master')
@section('head')
    <style type="text/css">
        .info-box{
            width: 100%;
            padding: 30px;
            position: relative;
        }
        .info-box table{
            width: 100%;
        }
        .info-box table tr td{
            padding: 10px 0px;
        }
        .info-box table tr td:first-child {
            width: 200px;
            text-align: right;
            padding-right: 50px;
        }
        .info-box input[type=text], select, textarea {
            width: 50%;
            outline: none;
            padding: 0 10px;
            height: 30px;
        }
        .info-box input[type=submit] {
            width: 80px;
            height: 50px;
            margin-top: 30px;
            position: absolute;
            left: 25%;
            background-color: var(--main-color);
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <section class="featured spad">
        <div class="container">
           <div class="info-box">
                <h5>HỒ SƠ CỦA TÔI</h5>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                <hr>
                <form action="/saveprofile" method="POST">
                    @csrf
                    <table>
                        <tr>
                            <td>Họ</td>
                            <td>
                                <input type="text" name="Ho" value="{{ $user->Ho }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Tên</td>
                            <td>
                                <input type="text" name="Ten" value="{{ $user->Ten }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Số Điện thoại</td>
                            <td>
                                <input type="text" name="SDT" value="{{ $user->SDT }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Giới tính</td>
                            <td>
                                <select name="GioiTinh">
                                    <option value="Nam" @if($user->GioiTinh == 'Nam') selected @endif>Nam</option>
                                    <option value="Nữ" @if($user->GioiTinh == 'Nữ') selected @endif>Nữ</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tỉnh/Thành phố</td>
                            <td>
                                <select name="ma_tinh" id="id_tinh" onclick="updateSelect(0)">
                                    @foreach($tinhthanh as $value)
                                        @if($value->matp == $user->ma_tinh)
                                            <option value="{{ $value->matp }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->matp }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Quận/Huyện </td>
                            <td>
                                <select name="ma_huyen" id="id_huyen" onclick="updateSelect(1)">
                                    @foreach($quanhuyen as $value)
                                        @if($value->maqh == $user->ma_huyen)
                                            <option value="{{ $value->maqh }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->maqh }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Phường/Xã</td>
                            <td>
                                <select name="ma_xa" id="id_xa">
                                    @foreach($xaphuong as $value)
                                        @if($value->xaid == $user->ma_xa)
                                            <option value="{{ $value->xaid }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->xaid }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>
                                <input type="text" name="dia_chi" value="{{ $user->DiaChi }}">
                            </td>
                        </tr>
                    </table>
                    <button type="submit">Lưu</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        function updateSelect(stt) {
            if(stt!=-1){
                var id_tinh = document.getElementById("id_tinh");
                var id_huyen = document.getElementById("id_huyen");
                var id_xa = document.getElementById("id_xa");

                var data={
                    stt: stt,
                    id_tinh: id_tinh.value,
                    id_huyen: id_huyen.value,
                }
                var url = "{{route('user.get_data_location')}}";
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "html",
                    data: data,
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        jsonData=parsedData.data;
                        if (stt==0){
                            id_huyen.innerHTML = '';
                            for (var i = 0; i < jsonData.length; i++) {
                                var option = document.createElement('option');
                                option.value = jsonData[i].maqh;
                                option.text = jsonData[i].name;
                                id_huyen.add(option);

                            }
                        }else{
                            id_xa.innerHTML = '';
                            for (var i = 0; i < jsonData.length; i++) {
                                var option = document.createElement('option');
                                option.value = jsonData[i].xaid;
                                option.text = jsonData[i].name;
                                id_xa.add(option);
                            }
                        }

                    },
                    error: function() {
                        alert("Lỗi khi tải dữ liệu.");
                    }
                });
            }
        }
        window.addEventListener('load', function() {
            updateSelect(-1);
        });


    </script>
@endsection
