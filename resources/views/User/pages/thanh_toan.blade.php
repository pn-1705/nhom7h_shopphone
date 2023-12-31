@extends('user.master')
@section('head')
    <style>
        .thanh_toan{
            width: 100%;
            padding: 30px 0;
            background-color: #fff;
        }
        .thanh_toan>form{
            display: block;
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid var(--color2);
            border-radius: 20px;
            box-shadow: 10px 10px var(--color2);
        }
        .thanh_toan h2 {
            cursor: default;
            color: var(--main-color);
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
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
        }
        textarea{
            padding: 10px 20px;
            height: 100px;
        }
        .thanh_toan input[type=submit] {
            background-color: var(--main-color);
            color: white;
            cursor: pointer;
        }
        .thanh_toan input[type=submit]:hover{
            background-color: var(--color2);
            transition: 0.1s all ease;
        }
        .thanh_toan table{
            width: 100%;
            text-align: right;
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
    <section>
        <div class="container">
	        <div class="thanh_toan">
	    <form action="{{ route('user.thanh_toan') }}" method="POST">
	        <h2>THANH TOÁN</h2>
	        @csrf
	        @foreach($cart as $value)
	        	<input type="hidden" name="sp_thanh_toan[]" value="{{ $value->TenSP }}">
	        @endforeach
	        <input type="text" name="Ho" value="{{ isset($nguoi_dung->Ho) ? $nguoi_dung->Ho : '' }}" placeholder="Họ và tên lót" required autocomplete="off"><br>
	        <input type="text" name="Ten" value="{{ isset($nguoi_dung->Ten) ? $nguoi_dung->Ten : '' }}" placeholder="Tên" required autocomplete="off"><br>
	        <input type="text" name="SDT" placeholder="Số điện thoại của bạn" autocomplete="off" pattern="[0-9]+" value="{{ isset($nguoi_dung->SDT) ? $nguoi_dung->SDT : '' }}" minlength="10" maxlength="15" required>
	        <select name="id_tinh" id="id_tinh" onchange="tinh_phi_ship()">
	        @foreach($tinh_thanh as $value)
	        	@if($value->id_tinh == $nguoi_dung->id_tinh)
	            	<option value="{{ $value->id_tinh }}" selected>{{ $value->ten_tinh }}</option>
	            @else
	            	<option value="{{ $value->id_tinh }}">{{ $value->ten_tinh }}</option>
	            @endif
	        @endforeach
	        </select>
	        <textarea name="dia_chi" placeholder="Địa chỉ cụ thể">{{ $nguoi_dung->DiaChi }}</textarea>
	        <select name="pttt">
	        	<option value="">Thanh toán khi nhận hàng</option>
	        	<option value="Banking">Banking</option>
	        </select>
	        <table>
        		<tr>
        			<td>Tổng tiền hàng</td>
        			<input type="hidden" id="tong_tien_hang" value="{{ $gia }}">
        			<td>{{ number_format($gia, 0, ",", ".").' VNĐ' }}</td>
        		</tr>
        		<tr onload="tinh_phi_ship()">
        			<td>Vận chuyển</td>
        			<td id="ship"></td>
        		</tr>
        		<tr>
        			<td>Khuyến mãi</td>
        			<input type="hidden" id="km" value="{{ $km }}">
        			<td>{{ number_format($km, 0, ",", ".").' VNĐ' }}</td>
        		</tr>
        		<tr>
        			<td>Tổng cộng</td>
        			<input type="hidden" name="tong_cong" id="tong_cong">
        			<td id="tong_cong_view"></td>
        		</tr>
	        </table>
            <button type="submit" class="site-btn" >Thanh toán</button>
	    </form>
	</div>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        function tinh_phi_ship() {
            id_tinh = document.getElementById('id_tinh').value;
            if(id_tinh != 15) {
                van_chuyen = 35000;
            } else {
                van_chuyen = 20000;
            }
            document.getElementById('ship').innerHTML = van_chuyen.toLocaleString('vi-VN')+' VNĐ';

            gia = document.getElementById('tong_tien_hang').value;
            km = document.getElementById('km').value;

            document.getElementById('tong_cong').value = gia - km + van_chuyen;
            document.getElementById('tong_cong_view').innerHTML = (gia - km + van_chuyen).toLocaleString('vi-VN')+' VNĐ';
        }
        window.addEventListener('load', function() {
            tinh_phi_ship();
        });
    </script>
@endsection
