@include('User.head')
<body>
<div id="preloder">
    <div class="loader"></div>
</div>
@include('User.header')

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Tất cả</li>
                        @foreach($danhmuc as $dm)
                            <li data-filter=".{{$dm->id}}">{{$dm->TenDM}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter" id="pagination">
            @foreach($sanpham as $sp)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{$dm->id}}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg"
                                 data-setbg="{{ asset('storage/' . $sp->HinhAnh1) }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a onclick="addToFavourite()"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="/addtocart?idsp={{$sp->id}}"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="/productdetails?id={{$sp->id}}">{{$sp->TenSP}}</a></h6>
                                <h5>{{ number_format($sp->DonGia, 0, ',', '.') }} VNĐ</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
    </div>
    <div class="card-tools float-right">
        <ul class="pagination pagination-sm">
            @if ($sanpham->onFirstPage())
                <li class="disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $sanpham->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif
            @if ($sanpham->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $sanpham->nextPageUrl() }}" rel="next" id="nextPage">&raquo;</a></li>
            @else
                <li class="disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<!-- Blog Section End -->
<!-- Footer Section Begin -->
@include('User.footer')

</body>

</html>
