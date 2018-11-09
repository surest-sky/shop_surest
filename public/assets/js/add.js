jQuery.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.onload = function () {

    $('#logout-click').on('click',function () {
        $("#logout-form").submit();
    })

}
function _alert($param,$bol=true) {
    $str = $bol ? 'success' : 'error';
    swal($param, "",$str);
    return ;
}

function dd(a) {
    console.log(a);
}