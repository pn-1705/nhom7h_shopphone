@if(Session::has('success'))
    <div id="successPopup" class="popup-overlay">
        <div class="popup-content alert alert-success">
            {{ Session::get('success') }}
            <span class="close-btn" onclick="closePopup('successPopup');">&times;</span>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div id="errorPopup" class="popup-overlay">
        <div class="popup-content alert alert-danger">
            {{ Session::get('error') }}
            <span class="close-btn" onclick="closePopup('errorPopup');">&times;</span>
        </div>
    </div>
@endif

@if(Session::has('warning'))
    <div id="warningPopup" class="popup-overlay">
        <div class="popup-content alert alert-warning">
            {{ Session::get('warning') }}
            <span class="close-btn" onclick="closePopup('warningPopup');">&times;</span>
        </div>
    </div>
@endif

<script>
    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }
</script>
