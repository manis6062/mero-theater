@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('admins/plugins/calendar/calendar.css')}}">
    <link rel="stylesheet" href="{{asset('admins/plugins/calendar/fullcalendar.css')}}">    
@stop

@section('main-body')
    <section class="content">
        <div class="row">
            <div id="calendar"></div>
        </div>
    </section>
@stop

@section('scripts')
    <!-- <script src="{{asset('admins/plugins/calendar/moment.js')}}"></script> -->
    <!-- <script src="{{asset('admins/plugins/calendar/calendar.js')}}"></script>     -->

    <script src="{{asset('admins/plugins/calendar/moment.min.js')}}"></script>    
    <script src="{{asset('admins/plugins/calendar/fullcalendar.js')}}"></script>    

    <script>
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
    </script>
@stop