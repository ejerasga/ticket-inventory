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
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        editable: false,
        selectable: false,
        eventLimit: true,
        events: '{{ route("calendar.events") }}',
        eventRender: function(event, element) {
            element.tooltip({
                title: event.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        },
        timeFormat: 'H:mm',
        slotLabelFormat: 'H:mm',
        displayEventEnd: true,
        eventClick: function(event) {
            if (event.url) {
                window.location.href = event.url;
                return false;
            }
        }
    });
});
</script>
@endpush

@endsection