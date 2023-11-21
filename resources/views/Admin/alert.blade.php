@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('errors'))
    <div class="alert alert-danger">
        {{ Session::get('errors') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('errors') }}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success" id="success-alert">
        {{ Session::get('success') }}
    </div>
@endif

<script>
    // Xóa thông báo thành công sau 5 giây
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.remove();
        }
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
