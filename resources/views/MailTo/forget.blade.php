<div style="width: 600px;margin: 0 auto">
    <div style="text-align: center">
        <h2>
            Xin chào {{$customer->Ten}}
        </h2>
        <p>Bạn vừa sử dụng chức năng quên mật khẩu ở SHOPPHONE 7H</p>
        <p>Vui lòng bỏ qua email này nếu đó không phải bạn</p>
        <p>Mật khẩu mới của bạn là: {{$maXN}}</p>
        <p>Vui lòng ấn vào nút bên dưới để kích hoạt mật khẩu</p>
        <button>
            <a href="{{route('forget',['customer'=>$customer->id,'token'=>$maXN])}}"
               style="display: inline-block;background: green;color: #FFF;padding: 7px 25px">
                Kích hoạt tài khoản
            </a>
        </button>
        <p></p>
    </div>
</div>
