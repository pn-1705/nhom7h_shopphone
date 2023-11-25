<?php
    if (Auth::check()) {
        $cart = DB::table('giohang')
            ->join('sanpham', 'sanpham.id', '=', 'id_sp')
            ->where('id_nd', '=', Auth::user()->id)
            ->get();
        $yeuthich = DB::table('yeuthich')
            ->join('sanpham', 'sanpham.id', '=', 'idSP')
            ->where('idND', '=', Auth::user()->id)
            ->get();
    }else{
        $cart = null;
        $yeuthich=null;
    }
?>
<style>
    .notification-icon {
        cursor: pointer;
    }

    .menu {
        display: none;
        position: absolute;
        top: 40px;
        right: 10px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu li {
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }

    .menu li:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset('oganimaster/img/logo.png')}}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li><a href="#"><i class="fa fa-heart"></i> <span>
                    {{$yeuthich->count()}}
                </span></a></li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::check())
                <li><a href="/cart"><i class="fa fa-shopping-bag"></i> <span>
                    {{$cart->count()}}
                </span></a></li>
            @endif
        </ul>
        <div class="header__cart__price">item: <span>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="header__cart__price">Số dư: <span>{{ number_format(\Illuminate\Support\Facades\Auth::user()->sodu, 0, ',', '.') }} VNĐ</span></div>
                @endif</span>
        </div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="{{ asset('oganimaster/img/language2.png')}}" alt="">
            <div>Tiếng việt</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Tiếng việt</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <p href="/login">
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="header__top__right__language">
                    <i class="fa fa-user"></i>
                    <div>{{\Illuminate\Support\Facades\Auth::user()->Ten}}</div>
                    <span class="arrow_carrot-down"></span>
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::user()->Quyen_id==2)
                            <li><a href="/admin">Quản trị</a></li>
                        @endif
                        <li><a href="/profile">Cập nhật thông tin</a></li>
                        <li><a href="/doi_mk">Đổi mật khẩu</a></li>
                        <li><a href="#">Nạp số dư</a></li>
                        <li><a href="/logout">Đăng xuất</a></li>
                    </ul>
                </div>
            @else
                <i class="fa fa-user"></i>
                Login
                @endif
                </p>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="./shop-grid.html">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./cart">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@gmail.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="{{asset('oganimaster/img/language2.png')}}" alt="">
                            <div>Tiếng việt</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Tiếng việt</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            <a href="/login">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <div class="header__top__right__language">
                                        <i class="fa fa-user"></i>
                                        <div>{{\Illuminate\Support\Facades\Auth::user()->Ten}}</div>
                                        <span class="arrow_carrot-down"></span>
                                        <ul>
                                            @if(\Illuminate\Support\Facades\Auth::user()->Quyen_id==2)
                                                <li><a href="/admin">Quản trị</a></li>
                                            @endif
                                            <li><a href="/profile">Cập nhật thông tin</a></li>
                                            <li><a href="/doi_mk">Đổi mật khẩu</a></li>
                                            <li><a href="#">Nạp số dư</a></li>
                                            <li><a href="/logout">Đăng xuất</a></li>
                                        </ul>
                                    </div>
                                @else
                                    <i class="fa fa-user"></i>
                                    Login
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('oganimaster/img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="./shop-grid.html">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./cart">Shoping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li><a><i class="fa fa-bell"></i> <span>
                                {{$yeuthich->count()}}
                                </span></a>
                            </li>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li><a href="/cart"><i class="fa fa-shopping-bag"></i><span>
                            {{$cart->count()}}
                        </span></a></li>
                        @endif
                    </ul>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="header__cart__price">Số dư: <span>{{ number_format(\Illuminate\Support\Facades\Auth::user()->sodu, 0, ',', '.') }} VNĐ</span></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <?php
                            $danhmuc=\Illuminate\Support\Facades\DB::table('danhmuc')->get();
                        ?>
                        @foreach($danhmuc as $dm)
                            <li><a href="/?danhmuc={{$dm->id}}">{{$dm->TenDM}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                    <div class="hero__search__form">
                        <form>
{{--                            <select id="categorySelect" style="z-index: 1">--}}
{{--                                <option value="">All Categories</option>--}}
{{--                                <option value="category1">Category 1</option>--}}
{{--                                <option value="category2">Category 2</option>--}}
{{--                                <!-- Thêm các tùy chọn khác nếu cần -->--}}
{{--                            </select>--}}
                            <input id="txt_search" type="text" placeholder="What do you need?">
                            <button id="btn_search" onclick="searchData()" type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
