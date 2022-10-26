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

function loadModal2(url){
    $('#modalContainerLg').modal('show')
        .find('#modalContent')
        .load(url);
        //.load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
}

$("body").on("click","#buttonCreateRequest",function () {
    $('#modalRequest').modal('show')
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

$("body").on("click","#buttonViewRequesttype",function () {
    $('#modalViewRequesttype').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});


$("body").on("click","#buttonViewAttachments",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonViewDocuments",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonViewRecent",function () {
    loadModal2($(this).attr('value'));
});

$("body").on("click","#buttonUploadAttachments",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonAddFinancialSubsidy",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonUploadAttachmentstest",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonSubmitForVerification",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonPayrollitems",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonSubmitForValidation",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonValidateRequest",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonAddAllotment",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonObligate",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonReassign",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonCertifyfundsavailable",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonApprove",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonApprovepayroll",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonGenerateOSNumber",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonGenerateDVNumber",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonAddAccounttransaction",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonSkipOS",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonUploadDocument",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonTrackProgress",function () {
    loadModal2($(this).attr('value'));
});

$("body").on("click","#buttonSkipDV",function () {
    loadModal($(this).attr('value'));
});

$("body").on("click","#buttonCreateObligationtype",function () {
    $('#modalObligationtype').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("body").on("click","#buttonAddCreditor",function () {
    $('#modalCreditor').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalCreditorHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

//code
$("body").on("click","#buttonCreateOsdv",function () {
    $('#modalRequest').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    $('#modalHeader').html($(this).attr('title'));
    setTimeout(function () {
        $("#btnrefresh").click();
    },1500);
});

$("#modalContainer").on("hidden.bs.modal", function () {
    // put your default event here
    //$.pjax.reload({container:'#request-obligation'});
    $.pjax.reload({container:'#account-transactions'});
});

$("#modalViewRequesttype").on("hidden.bs.modal", function () {
    // put your default event here
    $.pjax.reload({container:'#requesttype'});
});