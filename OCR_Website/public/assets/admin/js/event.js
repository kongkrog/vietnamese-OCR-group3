$('#change-password').change(function (){
    let status = !$(this).is(':checked');
    showChange(status);
})

$('#btn-reset-edit-user').click(function(){
    showChange(true);
})


function showChange(status){
    $('#password').attr('readonly', status);
    $('#password-confirm').attr('readonly', status);

    $('#password').val("");
    $('#password-confirm').val("");
}