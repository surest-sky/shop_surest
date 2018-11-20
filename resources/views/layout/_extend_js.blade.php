<script>
    $('.like-deal').on('click',function () {
        var $id = $(this).attr('data-id');

        if( $id.length == 0) {
            swal('错误操作','','error');
        }
        $.ajax({
            url: '{{ route('wish.add') }}',
            type: 'post',
            data: {
                id: $id
            },
            success: function (data,text,status) {
                swal('喜欢成功','','success');
                var n = $('#wish_count').text();
                $('#wish_count').html(parseInt(n)+1);
            },
            error: function (error) {
                if(error.status == 401 ) {
                    swal('未登录哦','','error');
                    window.location.href = '{{ route('login') }}'
                }else {
                    $msg = error.responseJSON.message;
                    console.log(error)
                    swal($msg,'','error');
                }
            }
        })
    })
</script>