/*
 * Project Name: fais *
 * Copyright(C)2018 Department of Science & Technology -IX *
 * Developer: Larry Mark B. Somocor , Aris Moratalla , Eduardo R. Zaragoza Jr. *
 * 04 16, 2018 , 10:10:00 AM *
 * Module: main *
 */


jQuery(document).ready(function ($) {

    // --- Create Button
    $('#modalButton').click(function () {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        $('#modalHeader').html($(this).attr('header'));
    });

    // --- Delete action (bootbox) ---
    yii.confirm = function (message, ok, cancel) {
        var title = $(this).data("title");
        var confirm_label = $(this).data("ok");
        var cancel_label = $(this).data("cancel");

        bootbox.confirm(
            {
                title: title,
                message: message,
                buttons: {
                    cancel: {
                        label: cancel_label,
                        className: 'btn-default btn-flat'
                    },
                    confirm: {
                        label: confirm_label,
                        className: 'btn-danger btn-flat'
                    }
                },
                callback: function (confirmed) {
                    if (confirmed) {
                        !ok || ok();
                    } else {
                        !cancel || cancel();
                    }
                }
            }
        );
        // confirm will always return false on the first call
        // to cancel click handler
        return false;
    }

    // check if empty
    function isEmptyOrSpaces(str) {
        return str === null || str.match(/^ *$/) !== null;
    }

    // This JS file is exclusively for CRUD Method

    $('body').on('click', '.myAdd', function () {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        jQuery.ajax({
            type: "POST",
            url: "create?id=''&view=add",
            dataType: "text",
            success: function (response) {
                $("#mycreate").html(response);
                $(".loadpartial").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    });

    $('body').on('click', '.myEdit', function () {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        var x = $(this).data('id');
        jQuery.ajax({
            type: "POST",
            url: "update?id=" + x + "&view=edit",
            dataType: "text",
            success: function (response) {
                $("#mycontent").html(response);
                $(".loadpartial").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    });

    $('body').on('click', '.myView', function () {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        var x = $(this).data('id');
        jQuery.ajax({
            type: "POST",
            url: "view?id=" + x + "&view=view",
            dataType: "text",
            success: function (response) {
                //console.log(response);
                $("#mycontentview").html(response);
                $(".loadpartial").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    });

    $('body').on('click', '.myTagging', function () {
        $(".loadpartial").fadeIn(300);
        $(".loadpartial").show();
        var x = $(this).data('id');
        jQuery.ajax({
            type: "POST",
            url: "tag?id=" + x + "&view=tag",
            dataType: "text",
            success: function (response) {
                //console.log(response);
                $("#mycontenttag").html(response);
                $(".loadpartial").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    });

    $('body').on('click', '.btn-approve', function () {
        var r = confirm("Are you sure you want to approve this request?");
        if (r == true) {
            var x = $(this).val();
            jQuery.ajax({
                type: "POST",
                url: "approve?id=" + x,
                //data: {},
                success: function (response) {
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

    $('body').on('click', '.btn-disapprove', function () {
        var r = confirm("Are you sure you want to disapprove this request?");
        if (r == true) {
            var x = $(this).val();
            jQuery.ajax({
                type: "POST",
                url: "disapprove?id=" + x,
                //data: {},
                success: function (response) {
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        }
    });

    $('body').on('click', '.btn-review', function () {
        if (isEmptyOrSpaces($('#papcode').val())) {
            alert('Please enter PAP Code..');
        } else {
            var r = confirm("Are you sure you want to tag this request as reviewed?");
            if (r == true) {
                var x = $(this).val();
                jQuery.ajax({
                    type: "POST",
                    url: "review?id=" + x,
                    //dataType: "json",
                    data: { pap: $('#papcode').val() },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }
        }
    });

    $('#myAdd').on('hidden.bs.modal', function () {
        location.reload();
    });
    $('#Update').on('hidden.bs.modal', function () {
        //alert('tst');
        location.reload();
    });
    $('#myView').on('hidden.bs.modal', function () {
        //alert('tst');
        location.reload();
    });
    // Closing of Custom Function for CRUD Method
});

