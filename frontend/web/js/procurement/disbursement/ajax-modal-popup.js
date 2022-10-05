//$.pjax.defaults.timeout = 25000;

$("body").on("click","#buttonAddDisbursement",function () {

    $('#modalDisbursement').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        //$("#btnrefresh").click();
    },1500);

});
