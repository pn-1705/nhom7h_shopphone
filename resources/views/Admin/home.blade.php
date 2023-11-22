@extends('admin.main')
@section('head')
    <script src="ckeditor/ckeditor.js"></script>
    <style>
        .card-text+p {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .hero__search__form select {
            position: relative;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent;
            border: none;
            padding: 5px; /* Điều chỉnh giảm độ rộng của phần chọn để không bị che phủ */
            font-size: inherit;
            z-index: 1;
        }
    </style>
@endsection
@section('content')

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
