$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id,url){
    if (confirm('Bạn có muốn xóa vĩnh viễn không?')){
        $.ajax({
            type:'DELETE',
            datatype: 'JSON',
            data:{ id },
            url:url,
            success: function (result){
                if (result.error===false){
                    alert(result.messes);
                    location.reload();
                }
                else{
                    alert('Xóa thất bại');
                }
            }
        })
    }
}
