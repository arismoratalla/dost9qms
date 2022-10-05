
$("body").on("click","#buttonAddUser",function () {

        $('#modalUser').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        $('#modalHeader').html($(this).attr('title'));
        setTimeout(function () {
            $("#btnrefresh").click();
        },1500);

});