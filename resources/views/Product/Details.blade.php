@extends('User.master')
@section('head')
    <style>
        .product{
            display: flex;
            padding-left: 20px;
            background-color: #e9edf0;
        }
        .slider-container{
            height: 400px;
            width: 300px;
            position: relative;
            margin-top: 20px;
            overflow: hidden;
            text-align: center;
        }
        .menu {
            z-index: 900;
            margin: 20px 50px;
            width: 100%;
            bottom: 0;
            align-items: center;
        }
        .menu label {
            cursor: pointer;
            display: inline-block;
            width: 50px;
            height: 50px;
            margin: 0 .2em 1em;
            transition: all .3s ease;
            background-position: 50% 50%;
            border: 0.8px solid var(--color2);
        }

        .menu label:hover {
            background: red;
        }
        input[type=radio]{
            display: none;
        }

        .slide {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 100%;
            z-index: 10;
            padding: 8em 1em 0;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: 50% 50%;
            transition: left 0s .3s;
        }

        [id^="slide"]:checked + .slide {
            left: 0;
            z-index: 100;
            transition: left .5s ease-out;
        }
        .thongtin{
            margin-left: 30px;
            background-color: #fff;
            padding: 30px;
            width: 100%;

        }
        .product_name{
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
        }
        .mo_ta>p, .mo_ta>blockquote{
            margin-top: 30px;
        }
        .buttons{
            height: 50px;
            margin-top: 30px;
            margin-right: 30px;
            padding: 10px;
            border: none;
            color: grey;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
        }
        .buttons:hover{
            background-color: rgb(255, 75, 75);
            color: #fff;
        }
        #chi_tiet{
            padding: 50px;
            background-color: #fff;
        }
        #chi_tiet .thso_dgia{
            margin-right: 30px;
            color: grey;
            font-weight: bold;
            cursor: pointer;
            padding: 5px;
        }
        #chi_tiet .thong_so, #chi_tiet .danh_gia{
            display: none;
            margin-top: 50px;
        }
        #thso:checked ~ .thso, #dgia:checked ~ .dgia{
            color: #000;
            border-bottom: 3px solid red;
        }
        #thso:checked ~ .thong_so, #dgia:checked ~ .danh_gia{
            display: block;
        }
        table{
            margin-top: 10px;
            width: 100%;
        }
        table td{
            margin-left: 0;
            padding: 10px;
            border-top: 1px solid #acaaaa;
            border-collapse: collapse;
        }
        .so_luong{
            margin-top: 30px;
        }
        .so_luong input[type=number] {
            height: 30px;
            width: 55px;
            padding: 5px 5px;
            outline: none;
            margin-right: 20px;
        }
        .so_luong span{
            color: grey;
            cursor: default;
        }
        .danh_gia .gui{
            justify-content: flex-start;
            margin-bottom: 30px;
        }
        .danh_gia textarea{
            width: 90%;
            margin-right: 50px;
            height: 50px;
            padding: 10px;
        }
        .danh_gia button{
            margin: 0;
            background-color: var(--main-color);
            border: none;
            color: #fff;
            width: 50px;
            height: 50px;
        }
        .danh_gia button:hover{
            background-color: var(--color2);
        }
        .danh_gia .danh_gia_cha{
            margin-top: 30px;
            background-color: #f8f8f8;
            padding: 10px;
        }
        .danh_gia .avata{
            display: inline-block;
            background-color: #C2C2C2;
            width: 25px;
            height: 25px;
            text-align: center;
            margin-right: 10px;
            margin-bottom: 5px;
        }
        .danh_gia .avata_admin{
            background-color: transparent;
        }
        .danh_gia .quyen{
            margin-left: 30px;
            background-color: var(--main-color);
            color: white;
            padding: 5px;
            cursor: default;
            font-size: 13px;
        }
        .danh_gia .ten_nd{
            font-weight: bold;
            font-size: 18px;
        }
        .danh_gia .noi_dung{
            font-size: 15px;
        }
        .danh_gia .danh_gia_cha>button{
            border: none;
            color: blue;
            background-color: transparent;
            margin-left: 10px;
        }
        .danh_gia .danh_gia_con{
            margin-top: 20px;
            margin-left: 50px;
        }
        .toanf{
            cursor: default;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            padding: 20px;
            background-color: var(--color2);
            color: #fff;
            text-align: center;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            z-index: 1000;
        }
    </style>
@endsection
@section('content')
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                 src="storage/{{$sanpham->HinhAnh1}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="storage/{{$sanpham->HinhAnh1}}"
                                 src="storage/{{$sanpham->HinhAnh1}}" alt="">
                            <img data-imgbigurl="storage/{{$sanpham->HinhAnh2}}"
                                 src="storage/{{$sanpham->HinhAnh2}}" alt="">
                            <img data-imgbigurl="storage/{{$sanpham->HinhAnh3}}"
                                 src="storage/{{$sanpham->HinhAnh3}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$sanpham->TenSP}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        @if($sanpham->DonGia != $sanpham->giatrithuc)
                            <strike>{{ number_format($sanpham->DonGia, 0, ',', '.') }} VNĐ</strike>
                            <div class="product__details__price">{{ number_format($sanpham->giatrithuc, 0, ',', '.') }} VNĐ</div>
                        @else
                            <div class="product__details__price">{{ number_format($sanpham->giatrithuc, 0, ',', '.') }} VNĐ</div>
                        @endif

                        <p>{!!$sanpham->MoTa!!}</p>
                        <div id="alert_container" style="height: 20px;max-height: 20px;margin-bottom: 40px"></div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty" data-limit="{{$sanpham->SoLuong}}" data-key="{{$sanpham->id}}">
                                    <input id="isoluong" data-key="{{$sanpham->id}}" type="text" value="1/{{$sanpham->SoLuong}}">
                                </div>
                            </div>
                        </div>
                        <button onclick="addToCart()" class="primary-btn">ADD TO CARD</button>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                   aria-selected="true">THÔNG SỐ KỸ THUẬT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                   aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                   aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>THÔNG SỐ KỸ THUẬT</h6>
                                    <table>
                                        <tr>
                                            <td>Màn Hình</td>
                                            <td>{{ $sanpham->ManHinh }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hệ điều hành</td>
                                            <td>{{ $sanpham->HDH }}</td>
                                        </tr>
                                        <tr>
                                            <td>Camera sau</td>
                                            <td>{{ $sanpham->CamSau }}</td>
                                        </tr>
                                        <tr>
                                            <td>Camera trước</td>
                                            <td>{{ $sanpham->CamTruoc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Chip</td>
                                            <td>{{ $sanpham->CPU }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ram</td>
                                            <td>{{ $sanpham->Ram }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rom</td>
                                            <td>{{ $sanpham->Rom }}</td>
                                        </tr>
                                        @if($sanpham->SDCard != '')
                                            <tr>
                                                <td>Bộ nhớ</td>
                                                <td>{{ $sanpham->SDCard }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Pin</td>
                                            <td>{{ $sanpham->Pin }}</td>
                                        </tr>
                                        <?php echo $sanpham->thong_so_khac ?>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Đánh giá</h6>
                                    <div class="flex gui">
                                        @csrf
                                        <textarea id="viet_danh_gia" placeholder="Viết đánh giá..." onkeyup="kt_dang_nhap('{{ Session()->get('id') }}')"></textarea>
                                        <button onclick="danh_gia('{{ Session()->get('id') }}', {{ $sanpham->id }})">Gửi</button>
                                    </div>
                                    <div id="vung_danh_gia">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = $input.val();
            var limit = parseInt($button.parent().data('limit'));

            // Tách giá trị thành mảng và lấy phần tử đầu tiên
            var oldValueArray = oldValue.split('/');
            var oldNumericValue = parseFloat(oldValueArray[0]);

            if ($button.hasClass('inc')) {
                var newVal = (oldNumericValue + 1 <= limit) ? oldNumericValue + 1 : oldNumericValue;
            } else {
                // Không cho phép giảm dưới 0
                var newVal = (oldNumericValue - 1 >= 0) ? oldNumericValue - 1 : oldNumericValue;
            }
            // Gán giá trị mới với phần tử đầu tiên và thêm phần tử thứ hai
            $input.val(newVal + "/" + limit);
        });
        function addToCart() {
            var txt_search = document.getElementById("isoluong").value;
            var oldNumericValue = parseFloat(txt_search.split('/')[0]);
            var key = parseInt(document.getElementById("isoluong").getAttribute("data-key"));
            var url = "addtocart?idsp=" + key + "&sl=" + oldNumericValue;
            console.log(url);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                success: function (data) {
                    var alertDiv = $('<div class="alert alert-success alert-dismissible fade show" role="alert">');
                    alertDiv.html('<strong>Success!</strong> Thêm thành công.');

                    // Add a close button to the alert

                    // Append the alert to a container (e.g., a div with the ID "alert-container")
                    $('#alert_container').append(alertDiv);
                    setTimeout(function() {
                        var successAlerts = document.getElementsByClassName('alert');

                        for (var i = 0; i < successAlerts.length; i++) {
                            successAlerts[i].remove();
                        }
                    }, 2000);// 5000 milliseconds = 5 seconds

                },
                error: function () {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
    </script>
@endsection

