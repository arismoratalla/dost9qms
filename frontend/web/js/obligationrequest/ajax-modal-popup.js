//$.pjax.defaults.timeout = 25000;

$("body").on("click","#buttonAddObligation",function () {

    $('#modalObligation').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        //$("#btnrefresh").click();
    },1500);

})

$("body").on("click","#buttonAddDetails",function () {

    $('#modalObject').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    $('#lineitembudgetobjectdetails-line_item_budget_object_id').val($(this).attr('object_id'));
})




$("#modalObject").on('hidden.bs.modal', function () {
    $('form#objectdetails-form').html('');
});

$("#modalLib").on('hidden.bs.modal', function () {
    //location.reload();
});

$('body').keydown(
function(e){
    if(e.keyCode === 27){
        $('#modalLib').modal('hide');
    }
});

    
