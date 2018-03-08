@extends('admin.layout.master')

@section('styles')
    <style>
        .seatDiv{
            width: 80%;
            margin: 0 10%;
            border: 1px solid #ddd;
            padding: 5%;
            margin-top: 5%;
        }
    </style>

@section('main-body')
    <div class="seatDiv">
        @if(isset($seatData) && $seatData->count() > 0)
        @else
            <div class="seat-structure">
                <span style="display: block;">No any seat structure defined for {{$screen->name}}</span>
                <a href="{{url('admin/screens/'.$screen->slug.'/seat/create')}}"><button class="btn btn-primary">Create Now</button></a>
            </div>
        @endif
    </div>
@stop