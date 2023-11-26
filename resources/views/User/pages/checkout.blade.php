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
    <style>
        .checkout__input input{
            color:black;
        }
        .thanh_toan input, select, textarea {
            width: 100%;
            height: 30px;
            border: 1px solid #dcdddd;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
            padding: 0px 20px;
            margin-bottom: 20px;
        }
        .thanh_toan select{
            text-align: left;
            width: 100%;
        }

    </style>
@endsection
@section('content')

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Chi tiết thanh toán</h4>
                <form action="{{route('user.thanh_toan_p')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ<span>*</span></p>
                                        <input type="text" name="Ho" value="{{\Illuminate\Support\Facades\Auth::user()->Ho}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input type="text" name="Ten" value="{{\Illuminate\Support\Facades\Auth::user()->Ten}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="SDT" value="{{\Illuminate\Support\Facades\Auth::user()->SDT}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Quốc gia<span>*</span></p>
                                <select name="id_nuoc" id="id_nuoc">
                                    <option value="VN" selected>Việt Nam</option>
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Tỉnh/Thành phố <span>*</span></p>
                                <select name="id_tinh" id="id_tinh" onchange="updateSelect(0);">
                                    @foreach($tinhthanh as $value)
                                        @if($value->matp == $nguoi_dung->ma_tinh)
                                            <option value="{{ $value->matp }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->matp }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Quận/Huyện<span>*</span></p>
                                <select name="id_huyen" id="id_huyen" onchange="updateSelect(1)">
                                    @foreach($quanhuyen as $value)
                                        @if($value->maqh == $nguoi_dung->ma_huyen)
                                            <option value="{{ $value->maqh }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->maqh }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Phường/Xã <span>*</span></p>
                                <select name="id_xa" id="id_xa">
                                    @foreach($xaphuong as $value)
                                        @if($value->xaid == $nguoi_dung->ma_xa)
                                            <option value="{{ $value->xaid }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->xaid }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Tên đường, số nhà <span>*</span></p>
                                <input type="text" name="diachi" value="{{\Illuminate\Support\Facades\Auth::user()->DiaChi}}" placeholder="Street Address" class="checkout__input__add">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Nhận hàng tại quán?
                                    <input type="checkbox" id="diff-acc" name="nhantaiquan">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <input type="text" name="ghichu"
                                       placeholder="Ghi chú thêm cho quán.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                                <ul>
                                    @foreach($cart as $c)
                                        <li>{{$c->TenSP}} x {{$c->so_luong}} <span>{{number_format($c->DonGia*$c->so_luong, 0, ',', '.')}}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">
                                    <div class="checkout__order__products">Tổng cộng</div>
                                    Giá <span id="tong_tien_hang">{{number_format($gia, 0, ',', '.')}}</span></div>
                                <div class="checkout__order__total" style="tab-size: 10">Vận chuyển <span id="ship" style="color: black">{{number_format(35000, 0, ',', '.')}}</span></div>
                                <div class="checkout__order__total">Chương trình khuyến mãi <span id="km" style="color: black">{{number_format($km, 0, ',', '.')}}</span></div>
                                <div class="checkout__input__add">
                                    <input type="text" name="magiamgia" id="magiamgia" style="width: 100%" placeholder="Enter your coupon code">
                                    <button id="btn_applyCoupon" href="" style="background : #2d698c" class="site-btn" onclick="applyCoupon()">APPLY COUPON</button>
                                </div>
                                <p id="inforpgg" style="color: red"></p>
                                <div class="checkout__order__total">Mã giảm giá <span id="mgg" style="color: black">0</span></div>
                                <div class="checkout__order__total">Total <span id="tong_cong" data-key="$gia-$km">{{number_format($gia-$km+35000, 0, ',', '.')}}</span></div>
                                <select name="pttt" id="changePTTT" >
                                    <option value="">Thanh toán khi nhận hàng</option>
                                    <option value="Banking">Banking</option>
                                </select>
                                <p id="inforpttt" style="color: red"></p>
                                <a href="/naptien" id="naptien" style="display: none">Nạp tiền tại đây</a>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
@section('footer')
    <script>
        function applyCoupon(){
            var magiamgia =document.getElementById('magiamgia').value;
            var tong_cong =document.getElementById('tong_cong');
            var mgg =document.getElementById('mgg');
            var tc = tong_cong.textContent.replace(/\./g, '');
            var in4 = document.getElementById('inforpgg');
            var tth =parseInt(document.getElementById('tong_tien_hang').textContent.replace(/\./g, ''));
            var km =parseInt(document.getElementById('km').textContent.replace(/\./g, ''));
            var ship =parseInt(document.getElementById('ship').textContent.replace(/\./g, ''));
            $.ajax({
                url: "addcoupon?magiamgia="+magiamgia,
                type: "GET",
                dataType: "html",
                success: function(data) {
                    console.log(data);
                    if (JSON.parse(data).data!=null){
                        var parsedData = JSON.parse(data).data;
                        console.log(parsedData);
                        var giam=0;
                        if(parsedData.loai==1){
                            giam = Math.min(parsedData.giatri*tc.value,parsedData.giatri);
                        }else{
                            giam= parsedData.giatri;
                        }
                        if (parsedData.toithieu<tc){
                            tong_cong.innerHTML=(tc-giam).toLocaleString('vi-VN');
                            mgg.innerHTML=giam.toLocaleString('vi-VN');
                            in4.innerHTML="Bạn vừa nhập mã: "+ parsedData.magiamgia +":"+parsedData.mota;
                        }else{
                            tong_cong.innerHTML=(tth-km+ship).toLocaleString('vi-VN');
                            in4.innerHTML="Bạn vừa nhập mã: "+ parsedData.magiamgia +". "+parsedData.mota+". Nhưng bạn không đủ điều kiện sử dụng mã giảm giá này";
                            mgg.innerHTML="0";
                        }

                    }else{
                        tong_cong.innerHTML=(tth-km+ship).toLocaleString('vi-VN');
                        in4.innerHTML="Mã giảm giá không tồn tại hoặc đã hết lượt sử dụng";
                        mgg.innerHTML="0";
                    }

                },
                error: function() {
                    console.log(url);
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
        function updateSelect(stt) {
            id_tinh = document.getElementById('id_tinh').value;
            if(id_tinh != 15) {
                van_chuyen = 35000;
            } else {
                van_chuyen = 20000;
            }
            document.getElementById('ship').innerHTML = van_chuyen.toLocaleString('vi-VN');

            gia = document.getElementById('tong_tien_hang').textContent.replace(/\./g, '');
            km = document.getElementById('km').textContent.replace(/\./g, '');
            document.getElementById('tong_cong').innerHTML= (gia - km + van_chuyen).toLocaleString('vi-VN');
            // document.getElementById('tong_cong_view').innerHTML = (gia - km + van_chuyen).toLocaleString('vi-VN')+' VNĐ';

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
            var submitButton = document.getElementById('btn_applyCoupon');
            submitButton.addEventListener('click', function(event) {
                // Ngăn chặn sự kiện mặc định của button
                event.preventDefault();
            });
            var $select = document.getElementById('changePTTT');
            var naptien=document.getElementById('naptien');
            $select.addEventListener('change',function (event){
                var pttt=$select.selectedIndex;
                var in4 = document.getElementById('inforpttt');
                var tong_cong =document.getElementById('tong_cong').textContent.replace(/\./g, '');
                if (pttt==1 && (parseInt({{\Illuminate\Support\Facades\Auth::user()->sodu}})< parseInt(tong_cong))){
                    in4.innerHTML= "Số dư tài khoản bạn không đủ để thực hiện thanh toán";
                    naptien.style.display = "block";
                    console.log(naptien);
                }else{
                    in4.innerHTML= "";
                    naptien.style.display = "none";
                }
            });
            updateSelect(-1);
        });
    </script>
@endsection
