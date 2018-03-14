@extends('admin.layout.master')

@section('styles')
<link rel="stylesheet" href="{{asset('admins/plugins/calendar/calendar.css')}}">
@stop
<style>
      .fc-agendaDay-view  table tr > *{
        display: block;
    }
    .fc-agendaDay-view table tr {
        display: table-cell;
    }
</style>
@section('main-body')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div id="movies-calendar"></div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<!-- <script src="{{asset('admins/plugins/calendar/moment.js')}}"></script> -->
<script src="{{asset('admins/plugins/calendar/calendar.js')}}"></script>    

  
<script>
        $(document).ready(function() {

        $('#movies-calendar').fullCalendar({
         defaultView: 'agendaDay',            
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaDay, agendaWeek',            
        },
        titleRangeSeparator: ' - ',
        defaultDate: '2018-03-12',
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: [
      {
          title: 'All Day Event',
          start: '2018-03-01',
      },
      {
          title: 'Long Event',
          start: '2018-03-07',
          end: '2018-03-10'
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-09T16:00:00'
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-16T16:00:00'
      },
      {
          title: 'Conference',
          start: '2018-03-11',
          end: '2018-03-13'
      },
      {
          title: 'Meeting',
          start: '2018-03-12T10:30:00',
          end: '2018-03-12T12:30:00'
      },
      {
          title: 'Lunch',
          start: '2018-03-12T12:00:00'
      },
      {
          title: 'Meeting',
          start: '2018-03-12T14:30:00'
      },
      {
          title: 'Happy Hour',
          start: '2018-03-12T17:30:00'
      },
      {
          title: 'Dinner',
          start: '2018-03-12T20:00:00'
      },
      {
          title: 'Birthday Party',
          start: '2018-03-13T07:00:00'
      },
      {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2018-03-28'
      }
      ]
  });

    });
</script>
  <!--   <script>
        $('#calendar').fullCalendar({
            header: [
                center: 'month,timelineFourDays'
            ],
            views: {
            timelineFourDays: {
                type: 'timeline',
                    duration: { days: 4 }
            }
        }
        });
    </script> -->
    @stop