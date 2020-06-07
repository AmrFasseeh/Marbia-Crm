/* Calendar */
/*-------- */

$(document).ready(function () {
    /* initialize the calendar
     -----------------------------------------------------------------*/
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;
    var containerEl = document.getElementById('external-events');
    var calendarEl = document.getElementById('fc-external-drag');
    var checkbox = document.getElementById('drop-remove');
    var events = [{
        title: 'All Day Event',
        start: '2020-04-13',
        color: '#009688'
    },
    {
        title: 'Long Event',
        start: '2019-01-07',
        end: '2019-01-10',
        color: '#4CAF50'
    },
    {
        id: 999,
        title: 'Meeting',
        start: '2019-01-09T16:00:00',
        color: '#00bcd4'
    },
    {
        id: 999,
        title: 'Happy Hour',
        start: '2019-01-16T16:00:00',
        color: '#3f51b5'
    },
    {
        title: 'Conference Meeting',
        start: '2019-01-11',
        end: '2019-01-13',
        color: '#e51c23'
    },
    {
        title: 'Meeting',
        start: '2019-01-12T10:30:00',
        end: '2019-01-12T12:30:00',
        color: '#00bcd4'
    },
    {
        title: 'Dinner',
        start: '2019-01-12T20:00:00',
        color: '#4a148c'
    },
    {
        title: 'Birthday Party',
        start: '2019-01-13T07:00:00',
        color: '#ff5722'
    },
    {
        title: 'Click for Google',
        url: 'http://google.com/',
        start: '2020-06-10',
    }
];

$.ajax({
    url: 'http://marbia.crm/app-calendar/populate',
    type: 'GET',
    success: function(resp) {
        console.log(resp);
        
    }
});
    console.log(SITEURL);
    var today = new Date();
    // var date = new Date();
    $('#start').datepicker({
        format: "yyyy-mm-dd",
        yearRange: [1950, 2030],
        parentEl: '#modal1'
    });
    $('#end').datepicker({
        format: "yyyy-mm-dd",
        yearRange: [1950, 2030],
        parentEl: '#modal1'
    });
    //  Basic Calendar Initialize
    var basicCal = document.getElementById('basic-calendar');
    var fcCalendar = new FullCalendar.Calendar(basicCal, {
        timeZone: 'Africa/Cairo',
        defaultDate: today,
        header: {
            left: 'prev,next today addEventButton',
            center: 'title',
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        customButtons: {
            addEventButton: {
                text: 'add event...',
                click: function () {
                    // var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                    // var date = new Date(dateStr + 'T00:00:00'); // will be in local time
                    $('.modal').modal();
                    $('#modal1').modal('open');
                    // if (!isNaN(date.valueOf())) { // valid?
                    //     alert('Great. Now, update your database...');
                    // } else {
                    // alert('Invalid date.');
                    // }
                }
            }
        },

        editable: true,
        droppable: true,
        selectable: true,
        selectHelper: true,
        businessHours: {
            daysOfWeek: [0, 1, 2, 3, 4]
        },
        plugins: ["dayGrid", "timeGrid", "interaction"],
        eventLimit: false, // allow "more" link when too many events
        events: events,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        select: function (date) {
            var addEvent = $("#modal1");
            addEvent.modal();
            addEvent.modal('open');
            addEvent.find("#start_label").addClass('active');
            addEvent.find("#end_label").addClass('active');
            addEvent.find("#start").val(date.startStr);
            addEvent.find("#end").val(date.endStr);
            // console.log(date.startStr + date.endStr);
        }
    });
    fcCalendar.render();


    // Adding event
    $('#addEvent').on('submit', function (e) {
        e.preventDefault();
        var title = $('#title').val();
        var start = $('#start').val();
        var description = $('#description').val();
        var end = $('#end').val();
        var color = $('#color').val();
        var allDay = $('#allDay').val();

        fcCalendar.addEvent({
            title: title,
            start: start,
            description: description,
            end: end,
            color: color,
            allDay: allDay
        });
        $.ajax({
            url: 'http://marbia.crm/app-calendar/store',
            data: 'title=' + title + '&description=' + description + '&start=' + start + '&end=' + end + '&color=' + color,
            type: "POST",
            success: function (response) {
                console.log(response);

                console.log("Updated Successfully");
            },
            error: (error) => {
                console.log(JSON.stringify(error));
            }
        });
        $('form#addEvent')[0].reset();
    });

})
