$('#modalDisbursement').on('hidden.bs.modal', function () {
    location.reload();
});


$("body").ready(function() {
    //Execute Default Values
    var data=$("#disbursement-dv_type").val();
    if (data=='MDS') {
        $('#sono').show(500);
        $('#specify').hide(500);
        $('#pono').hide(500);
        $('#taxable').show(500);
        $(".cboEmployeeA").select2({
            disabled : false,
            dropdownParent: $('#modalDisbursement'),
            theme : "krajee"
        });
        //$("#disbursement-certified_a").val('').trigger('change');
    }
    if (data=='TF') {
        $('#sono').hide(500);
        $('#specify').show(500);
        $('#pono').show(500);
        var value=0;
        $("input[name=rdList][value=" + value + "]").prop('checked', true);
        $('#taxable').show(500);
        $(".cboEmployeeA").select2({
            disabled : false,
            dropdownParent: $('#modalDisbursement'),
            theme : "krajee"
        });
    }
    if (data == 'ST') {
        $('#sono').hide(500);
        $('#specify').show(500);
        $('#pono').show(500);
        $('#taxable').show(500);
        $(".cboEmployeeA").select2({
            disabled : false,
            dropdownParent: $('#modalDisbursement'),
            theme : "krajee"
        });
    }
    if (data == 'BI') {
        $('#sono').hide(500);
        $('#specify').hide(500);
        $('#pono').hide(500);
        $('#taxable').hide(500);
        $(".cboEmployeeA").select2({
            disabled : false,
            dropdownParent: $('#modalDisbursement'),
            theme : "krajee"
        });
    }
});

$("body").on("change","input[name='Disbursement[taxable]']",function () {
    var s= $(this).val()
    var amt = $("#disbursement-dv_amount").val();
    if(amt=='') {
        $("input[name='Disbursement[taxable]'][value='0']").prop('checked', true);
    }else{
        if (s==1) {
             var gross = amt;
             var lesstax = gross / 1.12;
             var tax = lesstax * 0.05;
             var ewt = lesstax * 0.01;
             var taxwet = tax + ewt;
             var net = 0;
            var disb =  $("#disbursement-particulars").text();
            localStorage["lastSet"] = disb;
             if (gross > 10000) {
                net = gross - taxwet;   
                 $("#disbursement-particulars").html(disb
                     +'&#13;&#13;' + 'GROSS : ' + parseFloat( gross ).toFixed(2)
                     +'&#13;' + 'Less TAX : ' + parseFloat( tax ).toFixed(2)
                     +'&#13;' + 'Less EWT : ' + parseFloat( ewt ).toFixed(2)
                     +'&#13;' + 'NET AMOUNT : ' + parseFloat( net ).toFixed(2));
                     $("#disbursement-dv_amount").val(parseFloat(net).toFixed(2));
             }else{
                 net = gross - tax;
                 $("#disbursement-particulars").html(disb
                     +'&#13;&#13;' + 'GROSS : ' + parseFloat( gross ).toFixed(2)
                     +'&#13;' + 'Less TAX : ' + parseFloat( tax ).toFixed(2)
                     +'&#13;' + 'NET AMOUNT : ' + parseFloat( net ).toFixed(2));
                     $("#disbursement-dv_amount").val(parseFloat(net).toFixed(2));
             }
        }else{
            var s = document.getElementById('disbursement-particulars');
            var f = document.getElementById('disbursement-dv_amount');
            f.value = '';
            s.value = '';
            s.focus();
        }
    }
})

$("body").on("change","input[type=radio][name='rdList']",function () {

    var x = $(this).val();
    var s = $('#disbursement-dv_type').val();
    if (s=='TF') {
        if (x==2) {
        $("input[name=rdList][value='1']").prop('checked', true);
        }
    }
    if (x==0) {
        $(".cboPono").select2({
            disabled : false,
            dropdownParent: $('#modalDisbursement'),
            width: "element",
            theme : "krajee"
        });

    } else if(x==1) {



    }

    else{

        $(".cboPono").select2({
            disabled : true,
            dropdownParent: $('#modalDisbursement'),
            width: "element",
            theme : "krajee"
        });
    }
});

