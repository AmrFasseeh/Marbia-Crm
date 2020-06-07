$(function () {
    $('#value').formatter({
        'pattern': '{{999}}{{999}}{{999}}',
        'persistent': true
    });

    // var date = new Date();
    $('.due_date').datepicker({
        format: "yyyy-mm-dd",
        yearRange: [2000, 2030],
    });
    $(".source").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    $(".contacts").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    $(".users").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    $(".payment_method").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

    $('input[name="payment"]').click(function () {
        // Show by current checkbox
        var value = $(this).val();
        if (value == 'cash') {
            $('#cash').show();
            $('#inst').hide();
        } else {
            $('#inst').show();
            $('#cash').hide();
        }
    });

});
