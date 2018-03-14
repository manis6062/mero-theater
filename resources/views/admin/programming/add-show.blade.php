@extends('admin.layout.master')

@section('styles')
    <style>
        .add-show-editor {
            width: 90%;
            margin: 0 5%;
        }

        .screen-span, .screen-span-not {
            padding: 5px 8px;
            background: #E3D6A6;
            color: #9b7502;
            margin-right: 10px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            text-shadow: 1px 1px 1px #fff;
            box-shadow: 1px 1px;
        }

        .day-span {
            padding: 5px 8px;
            background: #E3D6A6;
            color: #9b7502;
            margin-right: 10px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            text-shadow: 1px 1px 1px #fff;
            box-shadow: 1px 1px;
        }
    </style>
@stop

@section('main-body')
    <section class="content">
        <div class="row">
            <button class="add-show-button">Add Show</button>
            <div class="add-show-editor" style="bottom: 0px;">
                <div class="form">
                    <form action="" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="film">Film</label>
                                    <select name="film" id="film" class="form-control">
                                        <option value="">-- Choose Film --</option>
                                        @if(isset($films) && $films->count() > 0)
                                            @foreach($films as $film)
                                                <option value="{{$film->id}}">{{$film->movie_title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Screen</label>
                                    <div class="screen-span-div">
                                        @if(isset($screens) && $screens->count() > 0)
                                            @foreach($screens as $s)
                                                <span onclick="removeError('screen-id');"
                                                      class="{{$s->screenSeats != null ? 'screen-span' : 'screen-span-not'}} screen-span-{{$s->id}}"
                                                      data-screenid="{{$s->id}}">{{$s->name}}</span>
                                            @endforeach
                                            <span onclick="removeError('screen-id');" class="screen-span screen-span-all"
                                                  data-screenid="all">All</span>
                                        @endif
                                    </div>
                                    <span class="screen-id-error error help-block"></span>
                                </div>


                                <div class="form-group">
                                    <label for="">Day (s)</label>
                                    <div class="day-span-div">
                                        <span onclick="removeError('days');" class="day-span">Sun</span>
                                        <span onclick="removeError('days');" class="day-span">Mon</span>
                                        <span onclick="removeError('days');" class="day-span">Tue</span>
                                        <span onclick="removeError('days');" class="day-span">Wed</span>
                                        <span onclick="removeError('days');" class="day-span">Thu</span>
                                        <span onclick="removeError('days');" class="day-span">Fri</span>
                                        <span onclick="removeError('days');" class="day-span">Sat</span>
                                        <span onclick="removeError('days');" class="day-span day-span-all">Every Day</span>
                                    </div>
                                    <span class="days-error error help-block"></span>
                                </div>

                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script>

    </script>
@stop