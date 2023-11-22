@if(Session::has('errors'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ Session::get('errors') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ Session::get('error') }}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('message') }}
    </div>
@endif
{{--@if(Session::has('message'))--}}
{{--    <script>--}}
{{--        toastr.options = {--}}
{{--            "progressbar" : true,--}}
{{--            "closebutton" : true,--}}
{{--        }--}}
{{--        toastr.success(" {{ Session::get('message') }}",'Success !',{timeOut:12000});--}}
{{--    </script>--}}
{{--@endif--}}
<script>
    // Xóa thông báo thành công sau 5 giây
    setTimeout(function() {
        var successAlerts = document.getElementsByClassName('alert');

        for (var i = 0; i < successAlerts.length; i++) {
            successAlerts[i].remove();
        }
    }, 2000);// 5000 milliseconds = 5 seconds
</script>
