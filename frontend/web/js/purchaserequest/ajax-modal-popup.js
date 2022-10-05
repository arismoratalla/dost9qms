$("body").on("click", "#buttonCreatePR", function() {
    $('#createPRModal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
});
$("body").on("click", "#buttonUpdatePR", function() {
    $('#createPRModal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html('Update Purchase Request');
});
$("body").on("click", "#buttonViewPR", function() {
    $('#viewPRModal').modal('show')
        .find('#modalContent2')
        .load($(this).attr('value'));
    $('#modalHeader2').html('View Purchase Request');
});