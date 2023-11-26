@if(Session::has('errors'))
    <div class="alert alert-danger alert-dismissible fade show">
        {!! Session::get('errors') !!}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {!! Session::get('error') !!}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {!! Session::get('success') !!}
    </div>
@endif
@if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {!! Session::get('message') !!}
    </div>
@endif
@if(session('logout_success'))
    <div class="alert alert-success">
        {!! session('logout_success') !!}
    </div>
@endif
