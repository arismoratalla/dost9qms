/*
 * Project Name: fais *
 * Copyright(C)2018 Department of Science & Technology -IX *
 * Developer: Larry Mark B. Somocor , Aris Moratalla  *
 * 04 20, 2018 , 10:43:00 AM *
 * Module: purchaserequest *
 */

jQuery(document).ready(function ($) {
    var po_no = $("#purchaserequest-purchase_request_number").val();
    if (po_no!='') {
        jQuery.ajax( {
            type: "POST",
            url: frontendURI + "procurement/purchaserequest/checkprdetails?pno=" + po_no ,
            dataType: "json",
            success: function ( result ) {
                $.each( result, function ( i, field ) {
                    var purchase_request_details_id = field.purchase_request_details_id;
                    var purchase_request_id = field.purchase_request_id;
                    var purchase_request_number = field.purchase_request_number;
                    var purchase_request_details_unit = field.purchase_request_details_unit;
                    var unit_id = field.unit_id;
                    var units = field.units;
                    var purchase_request_details_item_description = field.purchase_request_details_item_description;
                    var purchase_request_details_quantity = field.purchase_request_details_quantity;
                    var purchase_request_details_price = field.purchase_request_details_price;
                    var purchase_request_details_status = field.purchase_request_details_status;

          
                    /********** Temporary Data **************/
                    var rowCount = $('#pr-table tr').length;
                    opentr  = "<tr class='table-data'>";
                    checkbox = "<td><div class=\"radio-container\"><div class=\"radio tbl-tmt\" data-id='"+rowCount+"' data-radio=\"test\"><input type=\"radio\" name=\"test\" class=\"radio-ui\"></div></div></td>";
                    closetr = "</tr>";
                    var pd_id ="<td style='display:none;' id='data-details"+rowCount+"' data-details='"+ purchase_request_details_id +"'>" + purchase_request_details_id + "</td>";
                    unit = "<td id='data-units"+rowCount+"' data-units='"+ unit_id +"'>" +units+"</td>";
                    unit_type = "<td style='display:none;' id='data-unit"+rowCount+"' data-unit='"+ unit_id +"'>" + unit_id +"</td>";
                    itemdescription = "<td id='data-description"+rowCount+"' data-description='"+ purchase_request_details_item_description +"'>" +purchase_request_details_item_description+"</td>";
                    qty = "<td id='data-qty"+rowCount+"' data-qty='"+ purchase_request_details_quantity +"'>" +purchase_request_details_quantity+"</td>";
                    unitcost = "<td id='data-cost"+rowCount+"' data-cost='"+ purchase_request_details_price +"'>" + purchase_request_details_price +"</td>";
                    var tt = parseFloat(purchase_request_details_quantity) * parseFloat(purchase_request_details_price);
                    totalcost = "<td id='data-total"+rowCount+"'>" +  tt.toFixed(2) + "</td>";
                    $dataAppend =  opentr + checkbox  + pd_id + unit + unit_type + itemdescription + qty + unitcost + totalcost + closetr;
                    $('table tbody.table-body').append($dataAppend);
                    var table = $('#pr-table').tableToJSON({allowHTML:true,ignoreHiddenRows:false});
                    var jsonstring = JSON.stringify(table);
                    $('.radio.tbl-tmt').each(function(){
                        $('.radio.tbl-tmt').length > 0 ? $('.delete-row').prop('disabled',false) : $('.delete-row').prop('disabled',true);
                        $('.radio.tbl-tmt').length > 0 ? $('.edit-row').prop('disabled',false) : $('.edit-row').prop('disabled',true);
                        //$('.radio.tbl-tmt').length > 2 ? $('.edit-row').prop('disabled',true) : $('.edit-row').prop('disabled',false);
                    });
                    $('#purchaserequest-lineitembudgetlist').val(jsonstring);

                } );
            },
            error: function ( xhr, ajaxOptions, thrownError ) {
                alert( thrownError );
            }
        } );
    }

    $("body").keydown(function(key) {
        if (key.which == 115) {
            $('#add-container').each(function () {
                if ($(".mypopup").hasClass('selected')) { $(".mypopup").removeClass('selected'); }else{  $(".mypopup").addClass('selected');}
            });
        }
        if (key.which == 113) {
            $("#btnInsert").click();
        }
    });

    $("tr.table-data td").each(function() {

    });

    $("body").on('click','#btnAddLineItem',function () {

        $("#btnAdd").val("Add");
        $("#btnAdd").text("Add");

        $('#add-container').each(function () {
            if ($(".mypopup").hasClass('selected')) { $(".mypopup").removeClass('selected'); }else{  $(".mypopup").addClass('selected');}
        });


    });

    $("body").on('click','#btnAdd',function () {


        var rowCount = $('#pr-table tr').length;
        opentr  = "<tr class='table-data'>";
        checkbox = "<td><div class=\"radio-container\"><div class=\"radio tbl-tmt\" data-id='" + rowCount + "' data-radio=\"test\"><input type=\"radio\" name=\"test\" class=\"radio-ui\"></div></div></td>";
        closetr = "</tr>";
        if($("#btnAdd").text()=='Add') {
            p_id = "<td style='display:none;' id='data-details"+rowCount+"' data-details='-1'>"+ - 1+ "</td>";
        }else{
            p_id = "<td style='display:none;' id='data-details"+rowCount+"' data-details='"+localStorage["mDetails"]+"'>"+localStorage["mDetails"]+ "</td>";
        }
        unit = "<td id ='data-unit"+rowCount+"' data-unit='" + $("#txtunits").val() + "'>" + $("#txtunits option:selected").text() + "</td>";
        unit_type = "<td style='display:none;' id='data-unit"+rowCount+"' data-unit='"+  $("#txtunits").val()+"'>" + $("#txtunits").val() +"</td>";
        itemdescription = "<td id ='data-description"+rowCount+"' data-description='" + $("#txtitemdesc").val() + "'>" + $("#txtitemdesc").val() + "</td>";
        qty ="<td id ='data-qty"+rowCount+"' data-qty='" + $("#txtqty").val() + "'>"  + $("#txtqty").val() + "</td>";
        unitcost = "<td id ='data-cost"+rowCount+"' data-cost='" + $("#txtcost").val() + "'>"  + $("#txtcost").val() + "</td>";
        $(".req").removeClass('visible');
        $("#txtunits").focus();
        if ($("#txtunits").val() == "") {
            $(".one").addClass('visible');
            $("#txtunits").focus();
        }
            else if ($("#txtitemdesc").val() == "") {
                $(".two").addClass('visible');
                $("#txtitemdesc").focus();
            }
            else if ($("#txtqty").val() == "") {
                $(".three").addClass('visible');
                $("#txtqty").focus();
            }
            else if ($("#txtcost").val() == 0.00) {
                $(".four").addClass('visible');
                $("#txtcost").focus();
        }else{
            var tt = parseFloat($("#txtqty").val()) * parseFloat($("#txtcost").val());
            totalcost = "<td>" +  tt.toFixed(2) + "</td>";
            //$dataAppend = opentr + checkbox + p_id + unit + itemdescription + qty + unitcost + totalcost + closetr;
            $dataAppend =  opentr + checkbox  + p_id     + unit + unit_type + itemdescription + qty + unitcost + totalcost + closetr;
            if($("#btnAdd").text()=='Add') {
                $('table tbody.table-body').append($dataAppend);
                var table = $('#pr-table').tableToJSON({allowHTML:true,ignoreHiddenRows:false});
                var jsonstring = JSON.stringify(table);
                $('.radio.tbl-tmt').each(function(){
                    $('.radio.tbl-tmt').length > 0 ? $('.delete-row').prop('disabled',false) : $('.delete-row').prop('disabled',true);
                    $('.radio.tbl-tmt').length > 0 ? $('.edit-row').prop('disabled',false) : $('.edit-row').prop('disabled',true);
                });
                $('#purchaserequest-lineitembudgetlist').val(jsonstring);
            }else{
                //Update Query will execute here
                console.log('Update Execute')
                var tt = parseFloat($("#txtqty").val()) * parseFloat($("#txtcost").val());
                totalcost = "<td>" +  tt.toFixed(2) + "</td>";

                $('table tbody.table-body').append($dataAppend);
                var table = $('#pr-table').tableToJSON({allowHTML:true,ignoreHiddenRows:false});
                var jsonstring = JSON.stringify(table);

                $("table tbody").find('.radio.tbl-tmt').each(function() {
                    if ($(this).hasClass('check')) {
                        var id = $(this).attr('data-id');
                        if(id==-1) {
                            $("td#data-details"+id).html(localStorage["mDetails"]);
                        }
                        $("td#data-unit"+id).html($("#txtunits option:selected").text());
                        $("td#data-description"+id).html(CKEDITOR.instances.txtitemdesc.getData());
                        $("td#data-qty"+id).html($("#txtqty").val());
                        $("td#data-cost"+id).html($("#txtcost").val());
                        $("td#data-total"+id).html($("#txtcost").val() * $("#txtqty").val());

                        $(this).parents("tr").remove();
                        $('#tbl-item-selected').html($('.radio.tbl-tmt.check').length+ " selected").show('fast');
                        $('.radio.tbl-tmt').length > 0 ? $('.delete-row').prop('disabled',false) : $('.delete-row').prop('disabled',true);
                        $('#purchaserequest-lineitembudgetlist').val(jsonstring);

                        $("#btnClose").click();

                    }
                    $('#purchaserequest-lineitembudgetlist').val(jsonstring);
                });
            }
            $("#txtitemdesc").val('');
            $("#txtqty").val('');
            $("#txtcost").val('');
        }
    });
    
    $("body").on('click','#btnClose',function () {
            $('#add-container').each(function () {
                if ($(".mypopup").hasClass('selected')) { $(".mypopup").removeClass('selected'); }else{  $(".mypopup").addClass('selected');}
            });
    })

    $('body').on('click','.edit-row' , function() {
        $("table tbody").find('.radio.tbl-tmt').each(function(){

            if($(this).hasClass('check')) {
                var id = $(this).attr('data-id');
                var details = $('#data-details'+id).data('details');
                var unit = $('#data-unit'+id).data('unit');
                var description = $('#data-description'+id).data('description');
                var qty = $('#data-qty'+id).data('qty');
                var cost = $('#data-cost'+id).data('cost');
                localStorage["mDetails"]=details;
                $("#txtunits").val(unit);
                $("#txtitemdesc").html(description);
                CKEDITOR.instances.txtitemdesc.setData(description);
                $("#txtqty").val(qty);
                $("#txtcost").val(cost);
                $("#btnAdd").val("Update");
                $("#btnAdd").text("Update");
                $('#add-container').each(function () {
                    if ($(".mypopup").hasClass('selected')) { $(".mypopup").removeClass('selected'); }else{  $(".mypopup").addClass('selected');}
                });

            }
        });
    });


    $('body').on('click','.delete-row' , function() {
        $("table tbody").find('.radio.tbl-tmt').each(function(){
            if($(this).hasClass('check')) {
                var id = $(this).attr('data-id');
                var xd = $('#data-details'+id).data('details');
                if (xd==-1) {
                    $(this).parents("tr").remove();
                    $('#tbl-item-selected').html($('.radio.tbl-tmt.check').length+ " selected").show('fast');
                    var table = $('#pr-table').tableToJSON();
                    var jsonstring = JSON.stringify(table);
                    $('.radio.tbl-tmt').length > 0 ? $('.delete-row').prop('disabled',false) : $('.delete-row').prop('disabled',true);
                    $('#purchaserequest-lineitembudgetlist').val(jsonstring);
                }else{
                    var s  = DelDetails(xd);
                }

                if (s=='success') {
                    $(this).parents("tr").remove();
                    $('#tbl-item-selected').html($('.radio.tbl-tmt.check').length+ " selected").show('fast');
                    var table = $('#pr-table').tableToJSON();
                    var jsonstring = JSON.stringify(table);
                    $('.radio.tbl-tmt').length > 0 ? $('.delete-row').prop('disabled',false) : $('.delete-row').prop('disabled',true);
                    $('#purchaserequest-lineitembudgetlist').val(jsonstring);
                }
            }
        });
    });

    function DelDetails(id) {
        $.get(frontendURI + "procurement/purchaserequest/deletedetails?idno=" + id , function(data, status){
        });
        return 'success';
    }





    $('body').on('click','#btnInsert' , function() {
        /********** Temporary Data 
        opentr  = "<tr class='table-data'>";
        checkbox = "<td><div class=\"radio-container\"><div class=\"radio tbl-tmt\" data-id=\"2\" data-radio=\"test\"><input type=\"radio\" name=\"test\" class=\"radio-ui\"></div></div></td>"
        closetr = "</tr>";
        p_id = "<td>"+ -1 + "</td>";
        unit = "<td>1</td>";
        itemdescription = "<td>Item description</td>";
        qty = "<td>5</td>";
        unitcost = "<td>60,000</td>";
        totalcost = "<td>60,000</td>";
        $dataAppend = opentr + checkbox + p_id  + unit + itemdescription + qty + unitcost + totalcost + closetr;
        $('table tbody.table-body').append($dataAppend);
        var table = $('#pr-table').tableToJSON();
        var jsonstring = JSON.stringify(table);
        $('.radio.tbl-tmt').each(function(){
        $('.radio.tbl-tmt').length > 0 ? $('.delete-row').prop('disabled',false) : $('.delete-row').prop('disabled',true);
        });
        $('#purchaserequest-lineitembudgetlist').val(jsonstring);
        **************/
    });
});



