{{-- resources/views/users/calendar.blade.php --}}
@extends('layout.header')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ticket Calendar</h3>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
    

    var calendar = $('#full_calendar_events').fullCalendar({
        buttonText: {
        today: 'Today'
    },
        editable: false,
        events: events,
        displayEventTime: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
    });

    // Styling
    $('.fc-event').css('font-size', '13px');
    $('.fc-event').css('width', '100%');
    $('.fc-event').css('border-radius', '3px');
    $('.fc-event').css('padding', '5px');
    $('.fc-event').css('font-weight', 'bold');
});
</script>

@endsection