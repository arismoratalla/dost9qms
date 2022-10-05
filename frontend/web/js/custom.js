$(document).ready(function(){
    /* Function Radio Button */
    var totalItems = $('.radio.tbl-tmt').length;
    var verifyItems;
    $('body').on('click','.radio.tbl-tmt',function(e){
        //e.delegateTarget();
        //alert($(this).html());
        if($(this).hasClass('check')){
            $(this).removeClass('check');
            $('#main-radio').removeClass('check');
            verifyItems = $('.radio.tbl-tmt.check').length;
        }else{
            $('.control-options').show(200);
            $(this).addClass('check');
            verifyItems = $('.radio.tbl-tmt.check').length;
            //alert(totalItems + ' - ' + verifyItems);
            if(totalItems===verifyItems){
                $('#main-radio').addClass('check');
            }
        }
        if(verifyItems===0){
            $('.control-options').hide(200);
        }
        $('#tbl-item-selected').html($('.radio.tbl-tmt.check').length+ " selected").show('fast');
    });
    $('body').on('click','#main-radio',function(){
        //currentRadio =$(this).data("radio");
        if($(this).hasClass('check')){
            $(".radio.tbl-tmt").removeClass('check');
            $(this).removeClass('check');
            $('.control-options').hide(200);
        }else{
            $(this).addClass('check');
            $(".radio.tbl-tmt").addClass('check');
            $('.control-options').show(300);
        }
        //alert($('.radio.tbl-tmt.check').length);
        $('#tbl-item-selected').html($('.radio.tbl-tmt.check').length+ " selected").show('fast');
    });

    $('body').on('click','#max-scroll',function(){
        scrolldesc = $('#scroll-description').text();
        if(scrolldesc=="Minimize") {
            $('#scroll-description').text('Maximize');
            $('.table-scroll').removeClass('max-scroll');
            $('#max-scroll i').removeClass('fa fa-caret-up');
            $('#max-scroll i').addClass('fa fa-caret-down');
        }else{
            $('#scroll-description').text('Minimize');
            $('.table-scroll').addClass('max-scroll');
            $('#max-scroll i').removeClass('fa fa-caret-down');
            $('#max-scroll i').addClass('fa fa-caret-up');
        }

    });

});