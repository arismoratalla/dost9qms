

function loadModal(url){
    $('#modalContainer').modal('show')
        .find('#modalContent')
        .load(url);
        //.load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
}

$("body").on("click","#buttonCreatePayroll",function () {
    loadModal($(this).attr('value'));
});