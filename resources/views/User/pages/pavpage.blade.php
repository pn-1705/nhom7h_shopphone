<div class="row featured__filter">
    @foreach($sanpham as $sp)
        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
            <div class="featured__item">
                <div class="featured__item__pic set-bg"
                     data-setbg="{{ asset('storage/' . $sp->HinhAnh1) }}">
                    <ul class="featured__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="/cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="featured__item__text">
                    <h6><a href="/productdetails?id={{$sp->id}}">{{$sp->TenSP}}</a></h6>
                    <h5>{{ number_format($sp->DonGia, 0, ',', '.') }} VNĐ</h5>
                </div>
            </div>
        </div>
    @endforeach
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
