@foreach($don_mua as $value)
    <div class="don_hang">
        <a href="{{ route('user.in_don_hang', [$value->id]) }}" target="blank" class="in_don_hang">In đơn hàng</a>
        <div class="trang_thai">
            @switch($value->TrangThai)
                @case(0)
                    CHỜ XÁC NHẬN
                    @break
                @case(1)
                    CHỜ LẤY HÀNG
                    @break
                @case(2)
                    ĐANG GIAO
                    @break
                @case(3)
                    ĐÃ GIAO
                    @break
                @case(4)
                    ĐÃ HỦY
                    @break
            @endswitch
        </div>
        <div class="ds_sp">
                <?php
                $sp = DB::table('hoadon')
                    ->select('chitiethoadon.MaSP', 'TenSP', 'HinhAnh1', 'chitiethoadon.DonGia', 'chitiethoadon.SoLuong')
                    ->join('chitiethoadon', 'hoadon.id', 'chitiethoadon.MaHD')
                    ->join('sanpham', 'sanpham.id', 'chitiethoadon.MaSP')
                    ->where('MaHD', $value->id)
                    ->get();
                ?>
            @foreach($sp as $value1)
                <div class="sp">
                    <a href="{{ route('product.view', [$value1->MaSP]) }}">
                        <img src="{{asset('storage/'.$value1->HinhAnh1)}}">
                        <p>{{ $value1->TenSP }}<br>số lượng : {{ $value1->SoLuong }}</p>
                    </a>
                    <p>{{ number_format($value1->DonGia, "0", "0", ".").' VNĐ' }}</p>
                </div>
            @endforeach
            <div class="tong_tien">
                Tổng số tiền : <span>{{ number_format($value->TongTien, "0", "0", ".").' VNĐ' }}</span>
            </div>
        </div>
    </div>
@endforeach
