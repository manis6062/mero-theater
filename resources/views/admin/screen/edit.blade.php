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
        .info-span{
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: magenta;
        }

        small{
            color: red;
        }
    </style>
@stop


@section('main-body')
    <section class="content">
    <div class="create-form">
        <p class="info-span">Update Screen</p>
        <form action="{{url('admin/seat-management/screens/'.$screen->slug.'/update')}}" class="form-horizontal" id="create-form" method="post"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <span>Screen Name <small>*</small></span>
                <input value="{{$screen->name}}" type="text" name="name" class="form-control"
                       id="screen-name" onfocus="removeError();" placeholder="Enter Screen Name">
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
                <span>Screen Number <small>*</small></span>
                <input type="text" name="screen_number" value="{{$screen->screen_number}}" class="form-control" id="screen-number"
                       onfocus="removeError();" placeholder="Enter Screen Number">
                @if($errors->has('screen_number'))
                    <span class="help-block">
                    <strong>
                        {{$errors->first('screen_number')}}
                    </strong>
                </span>
                @endif
                <span class="screen-number-error error help-block"></span>
            </div>

            <div class="form-group">
                <span>House Seats</span>
                <input type="text" name="house_seats" value="{{$screen->house_seats}}" class="form-control" id="house-seats"
                       onfocus="removeError();" placeholder="Enter House Seats Value (Optional)">
                @if($errors->has('house_seats'))
                    <span class="help-block">
                    <strong>
                        {{$errors->first('house_seats')}}
                    </strong>
                </span>
                @endif
                <span class="house-seats-error error help-block"></span>
            </div>

            <div class="form-group">
                <span>Wheel Chair Seats</span>
                <input type="text" name="wheel_chair_seats" value="{{$screen->wheel_chair_seats}}" class="form-control" id="wheel-chair-seats"
                       onfocus="removeError();" placeholder="Enter Wheel Chair Seats Value (Optional)">
                @if($errors->has('wheel_chair_seats'))
                    <span class="help-block">
                    <strong>
                        {{$errors->first('wheel_chair_seats')}}
                    </strong>
                </span>
                @endif
                <span class="wheel-chair-seats-error error help-block"></span>
            </div>

            <div class="form-group">
                <span id="seatImageSpan">Available Seat Image (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                <div class="existingImage">
                    <span>Currently Existing Image</span>
                    <img src="{{asset('screen/available-seat-image/'.$screen->available_seat)}}" alt="">
                </div>
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
                <div class="existingImage">
                    <span>Currently Existing Image</span>
                    <img src="{{asset('screen/selected-seat-image/'.$screen->selected_seat)}}" alt="">
                </div>
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
                <div class="existingImage">
                    <span>Currently Existing Image</span>
                    <img src="{{asset('screen/reserved-seat-image/'.$screen->reserved_seat)}}" alt="">
                </div>
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
                <div class="existingImage">
                    <span>Currently Existing Image</span>
                    <img src="{{asset('screen/sold-seat-image/'.$screen->sold_seat)}}" alt="">
                </div>
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
            <input type="submit" class="btn btn-primary subBtn" value="Update">
        </form>
    </div>
    </section>
@stop

@section('scripts')
    <script>
        $('#create-form').on('submit', function (e) {
            $('.error').html('');
            if ($('#screen-name').val() == '') {
                e.preventDefault();
                $('.screen-name-error').html('<strong>Please enter the screen name.</strong>');
            }

            if ($('#screen-number').val() == '') {
                e.preventDefault();
                $('.screen-number-error').html('<strong>Please enter the screen number.</strong>');
            }

            if ($('#available_seat').val() == '') {

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

        function isNumber(evt, element) {

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (
                (charCode < 48 || charCode > 57) &&
                (charCode != 8) &&
                (charCode != 110))
                return false;

            return true;
        }
        $('input#screen-number').keypress(function (event) {
            return isNumber(event, this)
        });

        $('input#house-seats').keypress(function (event) {
            return isNumber(event, this)
        });

        $('input#wheel-chair-seats').keypress(function (event) {
            return isNumber(event, this)
        });
    </script>
@stop