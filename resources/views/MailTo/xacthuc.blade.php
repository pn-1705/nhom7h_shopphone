<div style="width: 600px;margin: 0 auto">
    <div style="text-align: center">
        <h2>
            Xin chào {{$customer->Ten}}
        </h2>
        <p>Bạn đã đăng ký tài khoản tại hệ thống SHOPPHONE 7H</p>
        <p>Gmail của bạn laf</p>
        <p>Bạn vui lòng ấn vào nút bên dưới để kích hoạt tài khoản</p>
        <button>
            <a href="{{route('activate',['customer'=>$customer->id,'token'=>$customer->google_token])}}"
            style="display: inline-block;background: green;color: #FFF;padding: 7px 25px">
                Kích hoạt tài khoản
            </a>
        </button>
    </div>
</div>
