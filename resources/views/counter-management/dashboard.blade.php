@extends('counter-management.layout.master1')

@section('main-body')
    <header class="main-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="page-icon">
                        <i class="icon-account_circle"></i>
                    </div>
                    <div class="page-title">
                        <h5>{{\Illuminate\Support\Facades\Auth::guard('counter')->user()->full_name}}</h5>
                        <h6 class="sub-heading">@include('counter-management.last-login-time')</h6>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="right-actions">
                        <a href="{{url('counter-management/logout')}}" class="btn btn-primary"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">

        <!-- Row start -->
        <div class="movie-sec">

            <div class="card">
                <div class="card-body logindash-filter">
                    <div class="filter-div">
                        <div class="crm-title logi-dash-title">
                            <h4>Filter</h4>
                        </div>
                        <form action="crm_submit" method="get" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="login-dash-label">
                                        <label>Movie</label>
                                        <div class="select-movie">
                                            <select name="" class="custom-select" id="movie-filter">
                                                <option value="" class="selected">Select Movie</option>
                                                @if(isset($movies) && $movies->count() > 0)
                                                    @foreach($movies as $movie)
                                                        <option value="{{$movie->id}}" {{isset($_GET['movie']) && $_GET['movie'] == $movie->id ? 'selected' : ''}}>{{$movie->movie_title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="login-dash-label">
                                        <label>Date</label>
                                        <div class="input-group date">
                                            <input class="form-control datepicker"
                                                   value="{{isset($_GET['date']) ? $_GET['date'] : date('Y-m-d')}}"
                                                   type="text">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="movie-days-btn">
                        <a href="#"
                           class="{{ !isset($_GET['date']) || (isset($_GET['date']) && $_GET['date'] == date('Y-m-d')) ? 'active' : '' }} days-bar"
                           data-date="{{date('Y-m-d')}}">Today</a>
                        <a href="#"
                           class="days-bar {{isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime("+1 days")) ? 'active' : ''}}"
                           data-date="{{date('Y-m-d', strtotime("+1 days"))}}">Tomorrow</a>
                        @php $unixTimestamp = strtotime(date('Y-m-d', strtotime("+2 days"))); @endphp
                        @php $dayOfWeek = date("l", $unixTimestamp); @endphp
                        <a href="#"
                           class="days-bar {{isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime("+2 days")) ? 'active' : ''}}"
                           data-date="{{date('Y-m-d', strtotime("+2 days"))}}">{{$dayOfWeek}}</a>
                        @php $unixTimestamp = strtotime(date('Y-m-d', strtotime("+3 days"))); @endphp
                        @php $dayOfWeek = date("l", $unixTimestamp); @endphp
                        <a href="#"
                           class="days-bar {{isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime("+3 days")) ? 'active' : ''}}"
                           data-date="{{date('Y-m-d', strtotime("+3 days"))}}">{{$dayOfWeek}}</a>
                        @php $unixTimestamp = strtotime(date('Y-m-d', strtotime("+4 days"))); @endphp
                        @php $dayOfWeek = date("l", $unixTimestamp); @endphp
                        <a href="#"
                           class="days-bar {{isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime("+4 days")) ? 'active' : ''}}"
                           data-date="{{date('Y-m-d', strtotime("+4 days"))}}">{{$dayOfWeek}}</a>
                        @php $unixTimestamp = strtotime(date('Y-m-d', strtotime("+5 days"))); @endphp
                        @php $dayOfWeek = date("l", $unixTimestamp); @endphp
                        <a href="#"
                           class="days-bar {{isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime("+5 days")) ? 'active' : ''}}"
                           data-date="{{date('Y-m-d', strtotime("+5 days"))}}">{{$dayOfWeek}}</a>
                        @php $unixTimestamp = strtotime(date('Y-m-d', strtotime("+6 days"))); @endphp
                        @php $dayOfWeek = date("l", $unixTimestamp); @endphp
                        <a href="#"
                           class="days-bar {{isset($_GET['date']) && $_GET['date'] == date('Y-m-d', strtotime("+6 days")) ? 'active' : ''}}"
                           data-date="{{date('Y-m-d', strtotime("+6 days"))}}">{{$dayOfWeek}}</a>
                    </div>
                    <div class="movie-sub-btn">
                        <a href="#"
                           class="{{!isset($_GET['screen']) || (isset($_GET['screen']) && $_GET['screen'] ==  'all') ? 'active' : ''}} screen-name"
                           data-screenid="all">All</a>
                        @if(isset($screens) && $screens->count() > 0)
                            @foreach($screens as $screen)
                                <a href="#"
                                   class="screen-name {{isset($_GET['screen']) && $_GET['screen'] ==  $screen->id ? 'active' : ''}}"
                                   data-screenid="{{$screen->id}}">{{$screen->name}}</a>
                            @endforeach
                        @endif
                    </div>

                    @if(isset($screens) && $screens->count() > 0)
                        @foreach($screens as $screen)
                            @if(!isset($_GET['screen']) || (isset($_GET['screen']) && $_GET['screen'] == 'all'))
                                <div class="movie-item-list">
                                    <div class="screen1-movie">
                                        <div class="movie-item-head">
                                            <span>{{$screen->name}}</span>
                                        </div>
                                        <div class="row">
                                            @if(isset($todaySchedules) && $todaySchedules->count() > 0)
                                                @foreach($todaySchedules as $ts)
                                                    @if($ts->screen_id == $screen->id)
                                                        <div class="col-xl-3 col-lg-3 col-md-3 fifth-item">
                                                            <div class="movie-item">
                                                                <a href="#" class="go-to-booking"
                                                                   data-screenid="{{$screen->id}}" data-showtime="{{$ts->show_time_start}}"  data-movie="{{$ts->movie_id}}" data-schedule="{{$ts->id}}">
                                                                    <div class="movie-item-content">
                                                                        <div class="movie-time-info">
                                                                            <div class="movie-time">
                                                                            <span> {{array_map('trim', explode(' ', $ts->show_time_start))[0]}}
                                                                                <br>{{array_map('trim', explode(' ', $ts->show_time_start))[1]}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="movie-right-content">
                                                                            <div class="movie-title">
                                                                                <h3>{{\App\MovieModel::find($ts->movie_id)->movie_title}}</h3>
                                                                            </div>
                                                                            <div class="movie-lang">
                                                                                <span>{{\App\MovieModel::find($ts->movie_id)->rating}}</span><span>{{ucwords(\App\MovieModel::find($ts->movie_id)->language)}}</span>
                                                                            </div>
                                                                            <div class="movie-duration">
                                                                            <span><em>Duration :</em> {{\App\MovieModel::find($ts->movie_id)->duration}}
                                                                                mins</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="movie-item-bottom">
                                                                            <div class="movie-thumb">
                                                                                <img src="{{asset('movies/posterimage/'.\App\MovieModel::find($ts->movie_id)->image)}}"
                                                                                     alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if($_GET['screen'] == $screen->id)
                                    <div class="movie-item-list">
                                        <div class="screen1-movie">
                                            <div class="movie-item-head">
                                                <span>{{$screen->name}}</span>
                                            </div>
                                            <div class="row">
                                                @if(isset($todaySchedules) && $todaySchedules->count() > 0)
                                                    @foreach($todaySchedules as $ts)
                                                        @if($ts->screen_id == $screen->id)
                                                            <div class="col-xl-3 col-lg-3 col-md-3 fifth-item">
                                                                <div class="movie-item">
                                                                    <a href="#" class="go-to-booking"
                                                                       data-screenid="{{$screen->id}}"  data-showtime="{{$ts->show_time_start}}" data-movie="{{$ts->movie_id}}">
                                                                        <div class="movie-item-content">
                                                                            <div class="movie-time-info">
                                                                                <div class="movie-time">
                                                                            <span> {{array_map('trim', explode(' ', $ts->show_time_start))[0]}}
                                                                                <br>{{array_map('trim', explode(' ', $ts->show_time_start))[1]}}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="movie-right-content">
                                                                                <div class="movie-title">
                                                                                    <h3>{{\App\MovieModel::find($ts->movie_id)->movie_title}}</h3>
                                                                                </div>
                                                                                <div class="movie-lang">
                                                                                    <span>{{\App\MovieModel::find($ts->movie_id)->rating}}</span><span>{{ucwords(\App\MovieModel::find($ts->movie_id)->language)}}</span>
                                                                                </div>
                                                                                <div class="movie-duration">
                                                                            <span><em>Duration :</em> {{\App\MovieModel::find($ts->movie_id)->duration}}
                                                                                mins</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="movie-item-bottom">
                                                                                <div class="movie-thumb">
                                                                                    <img src="{{asset('movies/posterimage/'.\App\MovieModel::find($ts->movie_id)->image)}}"
                                                                                         alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- END: .main-content -->
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', 'a.screen-name', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                var screenId = $(this).data('screenid');
                if ($(document).find('a.days-bar.active').length > 0)
                    var date = $(document).find('a.days-bar.active').attr('data-date');
                else
                    var date = $(document).find('input.datepicker').val();

                window.location = baseurl + '/counter-management/dashboard?screen=' + screenId + '&date=' + date;
            }
        });

        $(document).on('click', 'a.days-bar', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                var screenId = $(document).find('a.screen-name.active').attr('data-screenid');
                var date = $(this).data('date');
                window.location = baseurl + '/counter-management/dashboard?screen=' + screenId + '&date=' + date;
            }
        });

        $('select#movie-filter').on('change', function () {

            var movieId = $(this).val();
            if ($(document).find('a.days-bar.active').length > 0)
                var date = $(document).find('a.days-bar.active').attr('data-date');
            else
                var date = $(document).find('input.datepicker').val();

            var screenId = $(document).find('a.screen-name.active').attr('data-screenid');
            window.location = baseurl + '/counter-management/dashboard?screen=' + screenId + '&date=' + date + '&movie=' + movieId;
        });

        $('input.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('input.datepicker').on('changeDate', function () {
            $('.datepicker-dropdown').hide();
            var date = $(this).val();
            var screenId = $(document).find('a.screen-name.active').attr('data-screenid');
            window.location = baseurl + '/counter-management/dashboard?screen=' + screenId + '&date=' + date;
        });

        $(document).on('click', 'a.go-to-booking', function (e) {
            e.preventDefault();
            var screen = $(this).data('screenid');
            if ($(document).find('a.days-bar.active').length > 0)
                var date = $(document).find('a.days-bar.active').attr('data-date');
            else
                var date = $(document).find('input.datepicker').val();
            var time = $(this).data('showtime');
            var movie = $(this).data('movie');
            var schedule = $(this).data('schedule');
            "{{\Illuminate\Support\Facades\Session::put('redirect-url', \Illuminate\Support\Facades\Request::fullUrl())}}";
            window.location = baseurl+'/counter-management/booking?screen='+screen+'&date='+date+'&time='+time+'&movie='+movie+'&schedule='+schedule;
        });
    </script>
@stop