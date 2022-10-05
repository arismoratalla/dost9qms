//$.pjax.defaults.timeout = 25000;
$(document).ready(function() {
    $("body").on("click","#buttonSupplementalItem",function () {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        $('#modalHeader').html($(this).attr('title'));
        setTimeout(function () {
            $("#btnrefresh").click();
        },1500);
    });
});

$("body").on("click","#buttonAddPpmp",function () {
    
    $('#modalPpmp').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonAddPpmpItem",function () {
    $('#modalPpmpItem').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});
/*
$("body").on("click","#buttonSubmitPpmp",function () {
    $('#modalPpmpItem').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});
*/
$('body').keydown(
function(e){
    if(e.keyCode === 27){
        $('#modalPpmp').modal('hide');
    }
});

/*
$("#modalPpmpItem").on("hidden.bs.modal", function () {
    // put your default event here
    $.pjax.reload({container:'#ppmp-items'});
});*/

$('#year').on("change", function(){
    
    //alert($(this).val())
    $.ajax({
        //url:'".Yii::app()->createUrl("ppmp/index")."',
        //url: '<?php echo $this->createUrl("ppmp/index") ?>',
        url: 'index',
        type:   "GET",            
        data:   "year="+$(this).val(),
        //dataType:   "json",
        //success:function(data){
            //$.pjax.reload({container:'#ppmp-pjax'});
            /*if(data==null){
                $("#product_type").empty();    
            }else{
                var obj = eval(data);
                $("#product_type").empty();
                $.each(obj, function(key, value) {
                    $("#product_type").append("<option value="+key+">"+value+"</option>");
                });
            }*/
        //}
    });
});

//$("#buttonAddPpmpItem").click(function(){
//   alert('hahahha'); 
//});
    
