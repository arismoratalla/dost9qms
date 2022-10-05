/*
 * Project Name: fais *
 * Copyright(C)2018 Department of Science & Technology -IX *
 * Developer: Larry Mark B. Somocor , Aris Moratalla  *
 * 04 20, 2018 , 10:43:00 AM *
 * Module: purchaserequest *
 */
jQuery(document).ready(function ($) {



    $("body").keydown(function(key) {
        if (key.which == 115) {
            $('#add-expenditure-objects').each(function () {
                if ($(".mypopup").hasClass('selected')) { $(".mypopup").removeClass('selected'); }else{  $(".mypopup").addClass('selected');}
            });
        }
        if (key.which == 113) {
            alert("testing lang wala pa ito");
        }
    });
    
    
    
});
