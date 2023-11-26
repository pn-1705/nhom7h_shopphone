@extends('user.master')
@section('head')
    <style type="text/css">
        .content{
            background-color: var(--bg);
        }
        .don_mua{
            width: 100%;
            cursor: default;
        }
        p{
            margin: 0;
        }
        .dieu_huong{
            background-color: #fff;
        }
        .dieu_huong label{
            display: flex;
            justify-content: center;
            align-items: center;
            width: calc(100% / 6);
            height: 50px;
            cursor: pointer;
            transition: 0.1s all ease;
        }
        #dk1:checked ~ .dk1{
            border-bottom: 5px solid var(--main-color);
        }
        #dk2:checked ~ .dk2{
            border-bottom: 5px solid var(--main-color);
        }
        #dk3:checked ~ .dk3{
            border-bottom: 5px solid var(--main-color);
        }
        #dk4:checked ~ .dk4{
            border-bottom: 5px solid var(--main-color);
        }
        #dk5:checked ~ .dk5{
            border-bottom: 5px solid var(--main-color);
        }
        #dk6:checked ~ .dk6{
            border-bottom: 5px solid var(--main-color);
        }
        .don_mua .don_hang{
            padding: 30px;
            margin-top: 30px;
            background-color: #fff;
        }
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .don_mua .don_hang .in_don_hang{
            float: left;
        }
        .don_mua .don_hang .trang_thai{
            width: 100%;
            text-align: right;
            padding-bottom: 10px;
            font-weight: bold;
            font-size: 20px;
            color: var(--main-color);
            border-bottom: 1px solid grey;
        }
        .don_mua .don_hang .sp{
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid grey;
            margin-top: 20px;
        }
        .don_mua .don_hang .sp>a{
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            text-decoration: none;
            margin-bottom: 15px;
        }
        .don_mua .don_hang .sp>a:hover{
            color: var(--color2);
        }
        .don_mua .don_hang .sp img{
            display: block;
            width: 80px;
            margin-right: 20px;
        }
        .don_mua .don_hang .sp p{
            font-size: 18px;
        }
        .don_mua .tong_tien{
            margin-top: 20px;
            text-align: right;
            font-size: 20px;
        }
        .don_mua .tong_tien span{
            color: var(--main-color);
            font-weight: bold;
        }
        .block{
            display: block;
        }
    </style>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="don_mua">
                <select id="trangthaidon" style="width: 100%">
                    <option value="0">CHỜ XÁC NHẬN</option>
                    <option value="1">CHỜ LẤY HÀNG</option>
                    <option value="2">ĐANG GIAO</option>
                    <option value="3">ĐÃ GIAO</option>
                    <option value="4">ĐÃ HỦY</option>
                </select>
                <div class="noi_dung" id="noi_dung">
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
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        window.addEventListener('load', function() {
            var $select = document.getElementById('trangthaidon');
            $select.addEventListener('change',function (event){
                var pttt=$select.selectedIndex;
                $.ajax({
                    url: "locdonmua?trangthai="+pttt,
                    type: "GET",
                    dataType: "html",
                    success: function(data) {
                        var $noidung = document.getElementById('noi_dung');
                        $noidung.innerHTML=data;
                    },
                    error: function() {
                        alert("Lỗi khi tải dữ liệu.");
                    }
                });

            });
        });
    </script>
@endsection
