//$.pjax.defaults.timeout = 25000;

$("body").on("click","#buttonAddLibObject",function () {

    $('#modalLib').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);

})

$("body").on("click","#buttonAssign",function () {

        $('#modalUser').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        $('#modalHeader').html($(this).attr('title'));
        setTimeout(function () {
            $("#btnrefresh").click();
        },1500);

});

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

$("body").on('click','#btnForward', function () {
    var rows = $('#realignment-objects').yiiGridView('getSelectedRows');
    if ($("#btnForward").attr("disabled")) {
        // Do nothing
    }else{
        $("#btnForward").attr("disabled",true);
        $("#leftLoad").css('display','block');
        $("#leftIcon").hide();
        var table = $(".kv-grid-table").tableToJSON();
        var datatable = JSON.stringify(table);
        var selectedrows = JSON.stringify(rows);
        jQuery.ajax({
            type: "POST",
            data: { array_rows: selectedrows , tabledata: datatable },
            url: frontendURI + "procurement/lineitembudget/forwardlib",
            dataType: "text",
            success: function (response) {
                $("#btnForward").prop('disabled',false);
                //$.pjax.reload({container:"#realignment-objects-pjax",timeout:5000}); //for pjax update
                setTimeout(function(){
                    $("#btnrefresh2").click();
                }, 500);
                setTimeout(function(){
                    $("#btnrefresh").click();
                }, 1500);
                setTimeout(function () {
                    $("#leftLoad").css('display','none');
                    $("#leftIcon").show();
                    $("#btnForward").attr("disabled",false);
                    $("#counts").html("0");
                },3000);
            },
            error: function (xhr, ajaxOptions, thrownError ) {
                alert( thrownError );
            }
        });
    }
});



$("body").on("click","input[type='checkbox']",function (e) {
    if ($(this).is(':checked')) {
        var count = $("#counts").html();
        if (count == "") {
            count = 0;
        }
        count = parseInt(count) + 1;
        $("#counts").html(count);
    } else {
        var count = $("#counts").html();
        if (count == "") {
            count = 0;
        }
        count = parseInt(count) - 1;
        $("#counts").html(count);
    }
});

    
