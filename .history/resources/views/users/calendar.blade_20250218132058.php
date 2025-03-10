@extends('layout.header')
@section('content')

<div id='calendar'></div>




<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'resourceTimelineWeek'
      });
      calendar.render();
    });

  </script>

@endsection