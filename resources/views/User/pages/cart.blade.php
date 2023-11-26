@extends('User.master')
@section('content')
    <section class="shoping-cart spad">
        <div class="container">
            <div class="spinner" style="display: none;">
                Đang xử lý...
            </div>
            <div class="row">
                <form method="POST" action="updatecart">
                    @csrf
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table id="cartTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $sp)
                                    <tr id="product_{{$sp->id}}">
                                        <td>
                                            <input type="hidden" name="trangthai[]" value="{{$sp->trangthai}}"/>
                                            <input type="checkbox" data-key="{{$sp->id}}" {{$sp->trangthai == 1 ? 'checked' : ''}}/>
                                        </td>
                                        <input type="hidden" name="id[]" value="{{$sp->id}}"/>
                                        <td class="shoping__cart__item">
                                            <a href="/productdetails?id={{$sp->id}}" style="color: black">
                                            <img style="max-height: 10%;max-width: 10%" src="{{ asset('storage/' .$sp->HinhAnh1)}}" alt="">
                                            <h5> {{$sp->TenSP}}</h5>
                                            </a>
                                        </td>
                                        @if($sp->DonGia!=$sp->giatrithuc)
                                            <td class="shoping__cart__price" data-gia="{{$sp->giatrithuc}}">
                                                <strike style="font-weight: 300">{{ number_format($sp->DonGia, 0, ',', '.') }}</strike>
                                                {{ number_format($sp->giatrithuc, 0, ',', '.') }} VNĐ
                                            </td>
                                        @else
                                            <td class="shoping__cart__price" data-gia="{{$sp->giatrithuc}}">
                                                {{ number_format($sp->giatrithuc, 0, ',', '.') }} VNĐ
                                            </td>
                                        @endif

                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty" data-limit="{{$sp->SoLuong}}" data-key="{{$sp->id}}">
                                                    <input class= "quantity_input" name="soluong[]" type="text" value="{{$sp->so_luong}}/{{$sp->SoLuong}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{number_format($sp->giatrithuc*$sp->so_luong, 0, ',', '.') }} VNĐ
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                            <button id="UpdateCart" class="primary-btn cart-btn cart-btn-right" type="submit"><span class="icon_loading"></span>
                                Upadate Cart</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
{{--                            <h5>Discount Codes</h5>--}}
{{--                            <form action="#">--}}
{{--                                <input type="text" placeholder="Enter your coupon code">--}}
{{--                                <button type="submit" class="site-btn">APPLY COUPON</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
                    <div class="col-lg-6">
{{--                        <form action="/thanhtoan" method="post">--}}
{{--                            @csrf--}}
                            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <?php $subtotal=0;
                                    $total=0;?>
                                    @foreach($cart as $c)
                                            <?php
                                                if($c->trangthai==1){
                                                    $subtotal += $c->so_luong*$c->DonGia;
                                                    $total +=$c->so_luong*$c->giatrithuc;
                                                }
                                            ?>
                                    @endforeach
                                    <li class="ul_li_subtotal">Subtotal <span class="ul_li_span_subtotal">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span></li>
                                    <li class="ul_li_total">Total <span class="ul_li_span_total">{{ number_format($total, 0, ',', '.') }} VNĐ</span></li>
                                </ul>
                                <a href="/thanhtoan" type="submit" class="primary-btn">Thanh toán</a>
                            </div>
{{--                        </form>--}}
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
            var key = parseInt($button.parent().data('key'));
            var hiddenInputValue = $button.closest('tr').find('input[name="trangthai[]"]').val();
            var gia= $('#product_' + key + ' .shoping__cart__price').data('gia');
            var oldValueArray = oldValue.split('/');
            var oldNumericValue = parseFloat(oldValueArray[0]);

            if ($button.hasClass('inc')) {
                var newVal = (oldNumericValue + 1 <= limit) ? oldNumericValue + 1 : oldNumericValue;
            } else {
                var newVal = (oldNumericValue - 1 >= 0) ? oldNumericValue - 1 : oldNumericValue;
            }
            $('.spinner').show();
            var url = "{{route('user.updatecart')}}";
            var data = {
                id: key,
                soluong: newVal,
                trangthai: hiddenInputValue,
            };
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: data,
                success: function(data) {
                    $('.spinner').hide();
                    $('#product_' + key + ' .shoping__cart__total').text((newVal * gia).toLocaleString('vi-VN')+ " VNĐ");
                    $input.val(newVal + "/" + limit);
                    var parsedData = JSON.parse(data);
                    $('.shoping__checkout .ul_li_subtotal .ul_li_span_subtotal').text(parseInt(parsedData.SubtotalValue).toLocaleString('vi-VN')+" VNĐ");
                    $('.shoping__checkout .ul_li_total .ul_li_span_total').text(parseInt(parsedData.totalValue).toLocaleString('vi-VN')+" VNĐ");
                },
                error: function() {
                    $('.spinner').hide();
                    alert("Lỗi khi tải dữ liệu.");
                }
            });

        });
        document.addEventListener("DOMContentLoaded", function () {
            // Get all elements with the class 'close-icon'
            var closeIcons = document.querySelectorAll('.icon_close');

            // Loop through each close icon and attach a click event listener
            closeIcons.forEach(function (closeIcon) {
                closeIcon.addEventListener('click', function () {
                    // Get the closest 'tr' element (table row) to the clicked icon
                    var row = this.closest('tr');
                    row.querySelector('.quantity_input').value = '0/1';
                    // Hide the entire row
                    row.style.display = 'none';
                    var btn_update = document.getElementById ('UpdateCart');
                    btn_update.click();
                });
            });
        });

        $(document).ready(function() {
            $('input[type="checkbox"]').change(function() {
                var isChecked = $(this).prop('checked');
                var hiddenField = $(this).siblings('input[type="hidden"]');
                hiddenField.val(isChecked ? '1' : '0');

                var $checkbox = $(this);
                var gia = $checkbox.parent().parent().find('.shoping__cart__price').data('gia');
                var newVal = parseInt($checkbox.parent().parent().find('input[name="soluong[]"]').val().split("/")[0]);
                var $stt = isChecked ? '1' : '0';
                var key = $checkbox.data('key');

                var url = "{{route('user.updatecart')}}";
                var data = {
                    id: key,
                    soluong: newVal,
                    trangthai: $stt,
                };
                $('.spinner').show();
                console.log(url);
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "html",
                    data: data,
                    success: function(data) {
                        // abc
                        $('.spinner').hide();
                        var parsedData = JSON.parse(data);
                        $('#product_' + key + ' .shoping__cart__total').text((newVal * gia).toLocaleString('vi-VN')+ " VNĐ");
                        $('.shoping__checkout .ul_li_subtotal .ul_li_span_subtotal').text(parseInt(parsedData.SubtotalValue).toLocaleString('vi-VN')+" VNĐ");
                        console.log($('.shoping__checkout'));
                        $('.shoping__checkout .ul_li_total .ul_li_span_total').text(parseInt(parsedData.totalValue).toLocaleString('vi-VN')+" VNĐ");
                    },
                    error: function() {
                        $('.spinner').hide();
                        alert("Lỗi khi tải dữ liệu.");
                    }
                });
            });

        });
    </script>
@endsection
</body>

</html>
