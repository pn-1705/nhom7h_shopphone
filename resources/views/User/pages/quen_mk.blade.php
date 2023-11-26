@extends('User.master')
@section('content')
<style>
    .mat_khau{
        width: 100%;
        padding: 100px 0;
        background-color: #fff;
    }
    .mat_khau>div, .mat_khau>form{
    	width: 350px;
    	margin: 0 auto;
    	background-color: #fff;
        padding: 20px;
        border: 1px solid var(--color2);
        border-radius: 20px;
        box-shadow: 10px 10px var(--color2);
    }
    .mat_khau h2 {
        font-weight: bold;
        color: var(--main-color);
        margin-bottom: 20px;
        cursor: default;
        text-align: center;
    }
    .mat_khau input {
        width: 100%;
        height: 30px;
        border: 1px solid #dcdddd;
        border-radius: 10px;
        outline: none;
        box-sizing: border-box;
        padding: 0px 20px;
        margin-bottom: 20px;
    }
    .mat_khau input[type=submit] {
        background-color: var(--main-color);
        color: white;
        cursor: pointer;
    }
    .mat_khau input[type=submit]:hover{
        background-color: var(--color2);
        transition: 0.1s all ease;
    }
    .mat_khau .thong_bao, .mat_khau .error{
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }
</style>

<div id="mkhau" class="mat_khau">
    <div>
    	<h2>QUÊN MẬT KHẨU</h2>
        <div id="submit1">
	        <input type="text" id="email" placeholder="Email (Nhập đúng Email của bạn)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required autocomplete="off">
            <p id="error1" class="error"></p>
            <p id="success1" style="color: #00bc8c"></p>
            <button id="btn_email" value="GỬI" class="site-btn" style="width: 100%!important;">Gửi</button>
        </div>
    </div>
</div>
@endsection
<footer>
    <script type="text/javascript">
        window.addEventListener('load', function() {
            document.getElementById('btn_email').addEventListener('click', function(event) {
                kt_email();
            });
            document.getElementById('email').addEventListener('keypress',function (event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    kt_email();
                }
            });
        });

        function kt_email() {
            email = document.getElementById('email').value;
            if(email == '') {
                document.getElementById('error1').innerHTML = 'Vui lòng nhập email';
            } else {
                $.ajax({
                    url: "/kt_email?email="+email,
                    type: "GET",
                    dataType: "html",
                    success: function(data) {
                            document.getElementById('error1').innerHTML = data;
                    },
                    error: function() {
                        alert("Lỗi khi tải dữ liệu.");
                    }
                });
            }
        }
    </script>
</footer>
