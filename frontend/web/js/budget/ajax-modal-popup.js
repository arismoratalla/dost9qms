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

$("body").on("click","#buttonAddExpenditure",function () {
    
    $('#modalExpenditure').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

/*$("body").on("click","#buttonAddBudgetallocationItem",function () {
    
    $('#modalBudgetallocationitem').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});*/

$("body").on("click","#buttonAddBudgetallocationItem",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonAdjustment",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonViewAdjustment",function () {
    loadModal($(this).attr('value'));
});


$("body").on("click","#buttonCreateObligation",function () {
    
    $('#modalObligation').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$('body').keydown(
function(e){
    if(e.keyCode === 27){
        $('#modalExpenditure').modal('hide');
    }
});

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
    
