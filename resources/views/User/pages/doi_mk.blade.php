@extends('user.master')
@section('head')
    <style>
        .mat_khau{
            width: 100%;
            padding: 100px 0;
            background-color: #fff;
        }
        .mat_khau>form{
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
        .mat_khau .error{
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
        .mat_khau .hidden{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="mat_khau">
        <form action="{{route('user.doi_mk')}}" method="POST">
            @csrf
            <h2>ĐỔI MẬT KHẨU</h2>
            <input type="hidden" name="email" value="{{ isset($email) ? $email : '' }}">
            <input type="password" class="{{ \Illuminate\Support\Facades\Auth::check()!=false ? '' : 'hidden' }}" name="password_old" placeholder="Mật khẩu cũ" autocomplete="off">
            <input type="password" name="password" placeholder="Mật khẩu mới" required autocomplete="off">
            <input type="password" name="password_kt" placeholder="Xác nhận mật khẩu mới" required autocomplete="off">
            <p class="error">{{ isset($error) ? $error : '' }}</p>
            <button type="submit">Lưu</button>
        </form>
    </div>
@endsection
