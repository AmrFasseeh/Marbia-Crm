$(function () {
    $('#lead_value').formatter({
        'pattern': '{{999}},{{999}},{{999}} EGP',
        'persistent': true
    });

    // var date = new Date();
    $('.lead_date').datepicker({
        format: "yyyy-mm-dd",
        yearRange: [1950, 2030],
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

});
