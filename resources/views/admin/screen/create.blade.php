@extends('admin.layout.master')

@section('styles')
    <style>
        .create-form {
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 5%;
            margin-bottom: 5%;
            border: 1px solid #ddd;
            padding: 2%;
        }

        #screen-name {
            margin: 10px 0 0 0;
        }

        #seatImageSpan {
            margin: 10px 0 0 0;
            display: block;
        }

        .subBtn {
            margin: 10px 0;
        }

        .help-block {
            display: block;
            color: red;
            font-size: 15px;
            font-weight: 500;
        }
    </style>
@stop


@section('main-body')
    <div class="create-form">
        <span>Create New Screen</span>
        <form action="{{url('admin/screens/submit')}}" class="form-horizontal" id="create-form" method="post"
              enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="screen-name"
                       onfocus="removeError();" placeholder="Enter Screen Name">
                @if($errors->has('name'))
                    <span class="help-block">
                    <strong>
                        {{$errors->first('name')}}
                    </strong>
                </span>
                @endif
                <span class="screen-name-error error help-block"></span>
            </div>


            <div class="form-group">
                <span id="seatImageSpan">Available Seat Image (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                <input type="file" id="available_seat" name="available_seat" onclick="removeError();">
                @if($errors->has('available_seat'))
                    <span class="help-block error">
                    <strong>
                        {{$errors->first('available_seat')}}
                    </strong>
                </span>
                @endif
                <span class="available-seat-error error help-block"></span>
            </div>


            <div class="form-group">
                <span id="seatImageSpan">Selected Seat Image (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                <input type="file" id="selected_seat" name="selected_seat" onclick="removeError();">
                @if($errors->has('selected_seat'))
                    <span class="help-block error">
                    <strong>
                        {{$errors->first('selected_seat')}}
                    </strong>
                </span>
                @endif
                <span class="selected-seat-error error help-block"></span>
            </div>


            <div class="form-group">
                <span id="seatImageSpan">Reserved Seat Image (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                <input type="file" id="reserved_seat" name="reserved_seat" onclick="removeError();">
                @if($errors->has('reserved_seat'))
                    <span class="help-block error">
                    <strong>
                        {{$errors->first('reserved_seat')}}
                    </strong>
                </span>
                @endif
                <span class="reserved-seat-error error help-block"></span>
            </div>


            <div class="form-group">
                <span id="seatImageSpan">Sold Seat Image (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                <input type="file" id="sold_seat" name="sold_seat" onclick="removeError();">
                @if($errors->has('sold_seat'))
                    <span class="help-block error">
                    <strong>
                        {{$errors->first('sold_seat')}}
                    </strong>
                </span>
                @endif
                <span class="sold-seat-error error help-block"></span>
            </div>

            <div class="form-group">
            <input type="submit" class="btn btn-primary subBtn" value="Create">
            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script>
        $('#create-form').on('submit', function (e) {
            $('.error').html('');
            if ($('#screen-name').val() == '') {
                e.preventDefault();
                $('.screen-name-error').html('<strong>Please enter the screen name.</strong>');
            }

            if ($('#available_seat').val() == '') {
                e.preventDefault();
                $('.available-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#available_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.available-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#available_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.available-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }


            if ($('#selected_seat').val() == '') {
                e.preventDefault();
                $('.selected-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#selected_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.selected-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#selected_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.selected-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }


            if ($('#reserved_seat').val() == '') {
                e.preventDefault();
                $('.reserved-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#reserved_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.reserved-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#reserved_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.reserved-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }

            if ($('#sold_seat').val() == '') {
                e.preventDefault();
                $('.sold-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#sold_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.sold-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#sold_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.sold-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }
        });

        function removeError() {
            $('.error').html('');
        }
    </script>
@stop