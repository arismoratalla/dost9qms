//$.pjax.defaults.timeout = 25000;

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

$("body").on("click","#buttonCreateLddapada",function () {
    
    $('#modalLddapada').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonAddItems",function () {
    
    $('#modalCreditor').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonAddCreditors",function () {
    
    $('#modalCreditor').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonAssignCheckNo",function () {
    
    $('#modalAda').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonAssignAdaNo",function () {
    
    $('#modalPreview').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonSave",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonPrintPreview",function () {
    //loadModal($(this).attr('value'));
    $('#modalPreview').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("#modalCreditor").on("hidden.bs.modal", function () {
    // put your default event here
    $.pjax.reload({container:'#lddap-ada-items'});
});

