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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          views: {
            dayGridMonth: {
              type: 'dayGrid',
              duration: { month: 1 }
            },
            timeGridWeek: {
              type: 'timeGrid',
              duration: { week: 1 },
              buttonText: 'Week'
            },
            timeGridDay: {
              type: 'timeGrid',
              duration: { day: 1 },
              buttonText: 'Day'
            }
          }
        });
        calendar.render();
      });
</script>

@endsection