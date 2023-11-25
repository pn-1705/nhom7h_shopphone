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
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code--}}
{{--                    </h6>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="checkout__form">
                <h4>Chi tiết thanh toán</h4>
                <form action="#">
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
                                        @if($value->matp == $nguoi_dung->id_tinh)
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
                                        @if($value->maqh == $nguoi_dung->id_tinh)
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
                                        @if($value->xaid == $nguoi_dung->id_tinh)
                                            <option value="{{ $value->xaid }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->xaid }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Tên đường, số nhà <span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Nhận hàng tại quán?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span>*</span></p>
                                <input type="text"
                                       placeholder="Notes about your order, e.g. special notes for delivery.">
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
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__order__total">Total <span id="tong_cong">{{number_format($gia-$km+35000, 0, ',', '.')}}</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
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
        function updateSelect(stt) {

            id_tinh = document.getElementById('id_tinh').value;
            if(id_tinh != 15) {
                van_chuyen = 35000;
            } else {
                van_chuyen = 20000;
            }
            document.getElementById('ship').innerHTML = van_chuyen.toLocaleString('vi-VN')+' VNĐ';

            gia = document.getElementById('tong_tien_hang').textContent.replace(/\./g, '');
            km = document.getElementById('km').textContent.replace(/\./g, '');
            console.log(gia,km,van_chuyen);
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
                        dataa=parsedData.data;
                        console.log(dataa);
                        id_huyen.innerHTML = '';
                        console.log(dataa.huyen);
                        var arr=dataa.huyen;
                        for(var k in arr) {
                            console.log(k, arr[k]);
                        }
                        // data.huyen.forEach(option => {
                        //     var optionElement = document.createElement('option');
                        //     optionElement.value = option.value;
                        //     optionElement.textContent = option.text;
                        //     targetSelect.appendChild(optionElement);
                        // });
                        // data.xa.forEach(option => {
                        //     var optionElement = document.createElement('option');
                        //     optionElement.value = option.value;
                        //     optionElement.textContent = option.text;
                        //     targetSelect.appendChild(optionElement);
                        // });
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
