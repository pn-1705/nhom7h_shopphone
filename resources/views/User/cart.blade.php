@include('User.head')
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

@include('User.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('oganimaster/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <form method="POST" action="updatecart">
                @csrf
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                            <table id="cartTable">
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $sp)
                                <tr data-key="{{$sp->id}}">
                                    <input type="hidden" name="id[]" value="{{$sp->id}}"/>
                                    <td class="shoping__cart__item">
                                        <img style="max-height: 10%;max-width: 10%" src="{{ asset('storage/' .$sp->HinhAnh1)}}" alt="">
                                        <h5>{{$sp->TenSP}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ number_format($sp->DonGia, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty" data-limit="{{$sp->SoLuong}}" data-key="{{$sp->id}}">
                                                <input class= "quantity_input" name="soluong[]" type="text" value="{{$sp->so_luong}}/{{$sp->SoLuong}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{number_format($sp->DonGia*$sp->so_luong, 0, ',', '.') }} VNĐ
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
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <?php $subtotal=0; ?>
                        @foreach($cart as $c)
                            <?php $subtotal += $c->so_luong*$c->DonGia; ?>
                        @endforeach
                        <li>Subtotal <span>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span></li>
                        <li>Total <span>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span></li>
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<!-- Footer Section Begin -->
@include('User.footer')
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
    document.addEventListener("DOMContentLoaded", function () {
        // Get all elements with the class 'close-icon'
        var closeIcons = document.querySelectorAll('.icon_close');

        // Loop through each close icon and attach a click event listener
        closeIcons.forEach(function (closeIcon) {
            closeIcon.addEventListener('click', function () {
                // Get the closest 'tr' element (table row) to the clicked icon
                var row = this.closest('tr');
                // Set the value of the associated quantity input to '0/{{$sp->SoLuong}}'
                row.querySelector('.quantity_input').value = '0/{{$sp->SoLuong}}';
                // Hide the entire row
                row.style.display = 'none';
            });
        });
    });

</script>
</body>

</html>
