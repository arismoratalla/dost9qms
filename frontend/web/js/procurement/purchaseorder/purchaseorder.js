/*
 * Project Name: fais *
 * Copyright(C)2018 Department of Science & Technology -IX *
 * Developer: Larry Mark B. Somocor , Aris Moratalla  *
 * 04 20, 2018 , 10:43:00 AM *
 * Module: purchaserequest *
 */

jQuery(document).ready(function ($) {

  /*   $(document).on('click','.purchaseorder' , function() {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        var x = $(this).data('id');
        jQuery.ajax( {
            type: "POST",
            url: frontendURI + "procurement/purchaseorder/view?id=" + x + "&view=purchaseorder",
            dataType: "text",
            success: function ( response ) {
                //console.log(response);
                $("#purchaseorderview").html(response);
                $(".loadpartial").hide();
            },
            error: function ( xhr, ajaxOptions, thrownError ) {
                alert( thrownError );
            }
        } );
    });
*/


$(document).on('click','#btncancelpo', function(){
    var po_num = $(this).val();
    swal({
        title: "Are you sure you want to cancel " + po_num  + "?",
        text: "Once cancelled, it cannot be undone!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willCancel) => {
        if (willCancel) {
            //pr_id = atob(atob(pr_id.toUpperCase()));
            jQuery.ajax( {
                type: "POST",
                url: frontendURI + "procurement/bids/cancelpo",
                data:{po_num:po_num},
                dataType:'JSON',
                success: function ( response ) {
                    
                    swal(po_num  + " cancelled successfully!", {
                        icon: "success",
                    }).then(() =>{
                        location.reload();
                    });
                    //console.log(response);
                },
                error: function ( xhr, ajaxOptions, thrownError ) {
                    alert( thrownError );
                }
            } );

        }
      });
});



$("body").on("click","#buttonAddObligation",function () {
    $('#modalPurchaseOrder').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
    },1500);
});


$('body').on('click','.kv-row-checkbox' , function() {
        var chkRow = $(this);
        var checked = chkRow.is(':checked');
        var bools;
        if (checked==true) {
            bools = 1;
        }else{
            bools = 0;
        }
        jQuery.ajax({
            type: "POST",
            url: frontendURI + "procurement/inspection/checkselected",
            data: {chkRow: chkRow.val() , chkStatus: bools},
            success: function (response) {
                //alert(response);
                console.log(response);
                $("#kv-grid-data-togdata-all").click();
                $("#kv-grid-data-togdata-page").click();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
});



});