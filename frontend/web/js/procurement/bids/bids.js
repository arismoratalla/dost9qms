/*
 * Project Name: fais *
 * Copyright(C) 2018 Department of Science & Technology -IX *
 * Developer: Larry Mark B. Somocor , Aris Moratalla  *
 * 04 16, 2018 , 10:10:00 AM *
 * Module: bids *
 */

jQuery(document).ready(function ($) {



    $(document).on('click','#myawarded' , function () {
        $('.btn-group').show();
        $("#kv-grid-data3-togdata-all").click();
        $("#kv-grid-data3-togdata-page").click();
        setTimeout(function(){
            $('.btn-group').hide();
        }, 1000);
        }
    );

    $(document).on('click','#myhome' , function () {
            $('.btn-group').show();
            $("#kv-grid-data-togdata-all").click();
            $("#kv-grid-data-togdata-page").click();
            $('#cbosupplyofficer').prop('disabled',true);
            $('#btnCreatePO').prop('disabled',true);
            setTimeout(function(){
                $('.btn-group').hide();
            }, 1000);
        }
    );

    $(document).on('click','#myabstract' , function () {
            $('.btn-group').show();
            $("#kv-grid-data2-togdata-all").click();
            $("#kv-grid-data2-togdata-page").click();
            setTimeout(function(){
                $('.btn-group').hide();
            }, 1000);
        }
    );``

    $(document).on('click','.quotation' , function() {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        var x = $(this).data('id');
        jQuery.ajax( {
            type: "POST",
            url: frontendURI + "procurement/bids/view?id=" + x + "&view=quotation",
            dataType: "text",
            success: function ( response ) {
                //console.log(response);
                $("#quotationview").html(response);
                $(".loadpartial").hide();
            },
            error: function ( xhr, ajaxOptions, thrownError ) {
                alert( thrownError );
            }
        } );
    });

    $(document).on('click','.bids' , function() {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        var x = $(this).data('id');
        jQuery.ajax( {
            type: "POST",
            url: frontendURI + "procurement/bids/view?id=" + x + "&view=bids",
            dataType: "text",
            success: function ( response ) {
                $("#bidsview").html(response);
                $('.kv-editable-value').prop('disabled',true);
                $('.kv-editable-value').removeClass('kv-editable-link');
                $('.kv-editable-value').addClass('kv-disable-link');
                $('.btn-group').hide();
                $('#btnCreatePO').prop('disabled',true);
                $(".loadpartial").hide();
            },
            error: function ( xhr, ajaxOptions, thrownError ) {
                alert( thrownError );
            }
        } );
    });

    $(document).on('click','#btncancelpo', function(){
        var txt;
        var r = confirm("Are you sure you want to cancel this PO?");
        if (r == true) {
            var pr_id = $("#btncancelpo").val();
            pr_id = atob(atob(pr_id.toUpperCase()));
            jQuery.ajax( {
                type: "POST",
                url: frontendURI + "procurement/bids/cancelpo",
                data:{pr_id:pr_id},
                success: function ( response ) {
                    console.log(pr_id);
                },
                error: function ( xhr, ajaxOptions, thrownError ) {
                    alert( thrownError );
                }
            } );
        } 
    });

    $('body').on('click','#changespopup' , function() {
        $('div#homeids-container').each(function () {
            if ($("#homeids-container .mypopup").hasClass('selected')) {
                $("#homeids-container .mypopup").removeClass('selected');
            } else {
                $("#homeids-container .mypopup").addClass('selected');
            }
        });
    });

    $('body').on('click','#changesspopup' , function() {
        $('div#disabled-container').each(function () {
            if ($("#disabled-container .mypopup").hasClass('selected')) {
                $("#disabled-container .mypopup").removeClass('selected');
            } else {
                $("#disabled-container .mypopup").addClass('selected');
            }
        });
    });


    $('body').on('click','#bidspoupclose' , function() {
        $('div#bids-container').each(function () {
            if ($("#bids-container .mypopup").hasClass('selected')) {
                $("#bids-container .mypopup").removeClass('selected');
            } else {
                $("#bids-container .mypopup").addClass('selected');
            }
        });
    });

    $('body').on('click','#disablepopup' , function() {
        $('div#disable-container').each(function () {
            if ($("#disable-container .mypopup").hasClass('selected')) {
                $("#disable-container .mypopup").removeClass('selected');
            } else {
                $("#disable-container .mypopup").addClass('selected');
            }
        });
    });

    $('body').on('click','#btnCreatePurchaseOrder', function () {
        var selectedrows = $('#kv-grid-data2').yiiGridView('getSelectedRows');
        var table = $(".kv-grid-table").tableToJSON();
        var datatable = JSON.stringify(table);
        var selectedrows = JSON.stringify(selectedrows);
        if (selectedrows=='[]') {
            $('div#disabled-container').each(function () {
                if ($("#disabled-container .mypopup").hasClass('selected')) {
                    $("#disabled-container .mypopup").removeClass('selected');
                } else {
                    $("#disabled-container .mypopup").addClass('selected');
                }
            });
        }else{

            jQuery.ajax({
                type: "POST",
                data: { array_rows: selectedrows , tabledata: datatable },
                url: frontendURI + "procurement/bids/createpurchase",
                dataType: "text",
                success: function (response) {
                    $('.btn-group').show();
                    setTimeout(function(){
                        $("#kv-grid-data-togdata-all").click();
                        $("#kv-grid-data-togdata-page").click();
                    }, 2000);
                    setTimeout(function(){
                        $("#kv-grid-data2-togdata-all").click();
                        $("#kv-grid-data2-togdata-page").click();
                    }, 2000);
                    setTimeout(function(){
                        $("#kv-grid-data3-togdata-all").click();
                        $("#kv-grid-data3-togdata-page").click();
                    }, 2000);
                    var tabs = $('.nav-tabs > li');
                    var active = tabs.filter('.active');
                    var next = active.next('li').length ? active.next('li').find('a') : tabs.filter(':first-child').find('a');
                    next.tab('show');
                    $('.btn-group').hide();
                },
                error: function (xhr, ajaxOptions, thrownError ) {
                    alert( thrownError );
                }
            });

        }
    });

    $('body').on('click','#btnCreatePO' , function(e) {
        var selectedrows = $('#kv-grid-data').yiiGridView('getSelectedRows');
        var table = $(".kv-grid-table").tableToJSON();
        var datatable = JSON.stringify(table);
        var supplierid = $("#cbosupplyofficer").val();
        var pID = $("#pID").val();
        if(selectedrows=="" || supplierid=="") {
            $('#homeids-container').each(function () {
                if ($("#homeids-container .mypopup").hasClass('selected')) {
                    $("#homeids-container .mypopup").removeClass('selected');
                }else{
                    $("#homeids-container .mypopup").addClass('selected');}
            });
        }else{
            jQuery.ajax( {
                type: "POST",
                data: { array_rows: selectedrows ,
                            tabledata: datatable ,
                                supplierid: supplierid,
                                pID: pID,
                        },
                        url: frontendURI + "procurement/bids/createpo",
                        dataType: "text",
                        success: function ( response ) {
                        console.log(response);
                        setTimeout(function(){
                        $('.btn-group').show();
                        $("#kv-grid-data-togdata-all").click();
                        $("#kv-grid-data-togdata-page").click();

                        //$('#cbosupplyofficer').trigger('change.select2');
                    }, 1000);
                    var tabs = $('.nav-tabs > li');
                    var active = tabs.filter('.active');
                    var next = active.next('li').length ? active.next('li').find('a') : tabs.filter(':first-child').find('a');
                    next.tab('show');
                    $('#bids-container').each(function () {
                        if ($("#bids-container  .mypopup").hasClass('selected')) {
                            $("#bids-container .mypopup").removeClass('selected');
                        }else{
                            $("#bids-container .mypopup").addClass('selected');}
                    });
                    $("#kv-grid-data2-togdata-all").click();
                    $("#kv-grid-data2-togdata-page").click();
                    $('.btn-group').hide();
                    $("#cbosupplyofficer").val(null).trigger('change');
                    $('#cbosupplyofficer').trigger('change.select2');
                },
                error: function( xhr, ajaxOptions, thrownError ) {
                    alert( thrownError );
                }
            } );
        }
    });

    $('body').on('click','.kv-row-checkbox' , function() {
        var chkRow = $(this);
        var chkBids =  $("[name='chkBids']").prop('checked');
        var checked = chkRow.is(':checked');
        var bools;
        if (checked==true) {
            bools = 1;
        }else{
            bools = 0;
        }
        if (chkBids==true) {
            chkBids=1;
        }else{
            chkBids=0;
        }
        jQuery.ajax({
            type: "POST",
            url: frontendURI + "procurement/bids/checkselected",
            data: {chkRow: chkRow.val() , chkStatus: bools , chkBids: chkBids},
            success: function (response,data) {
                //alert(response);
                 //$("#kv-grid-data2-togdata-all").click();
                 //$("#kv-grid-data2-togdata-page").click();

                /************************update 5-6-2021*********************/
                if(checked==true){
                    $('#status-badge-' + chkRow.val()).html('<span class="badge btn-block" style="background: black;">Pending for Award <i class="fa fa-pencil"></i></span>');
                }else{
                    $('#status-badge-' + chkRow.val()).html('<span class="badge btn-block" style="background: green;">Available for Award <i class="fa fa-toggle-on"></i></span>');
                }
           
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    });
    $('body').on('click','.btntesting',function() {
        var data = $(this).data('id');
    });

    $('#quotation').on('hidden.bs.modal', function () {
        location.reload();
    });


    $('#bids').on('hidden.bs.modal', function () {
        //location.reload();
        location.href = '/procurement/bids/index';
       // window.history.back();
        
    });

    $('body').on('click','#btnAddBids',function () {
       $("#cbosupplyofficer").prop('disabled',false);
    });
});