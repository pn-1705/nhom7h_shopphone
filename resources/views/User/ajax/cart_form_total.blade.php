<form action="/thanhtoan" method="post">
    @csrf
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
            <li>Subtotal <span>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span></li>
            <li>Total <span>{{ number_format($total, 0, ',', '.') }} VNĐ</span></li>
        </ul>
        <button type="submit" class="primary-btn">Thanh toán</button>
    </div>
</form>
