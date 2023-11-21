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
    </style>
@endsection
@section('content')

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
