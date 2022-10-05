$("body").on("click","#buttonAddObligation",function () {
    $('#modalObligation').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
    },1500);

});
$("body").on("click","#buttonAddObligation",function () {
    $('#modalObligation').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
    },1500);
});

