@extends('admin.layout.master')

@section('styles')
    <style>
        .create-ticket-div {
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 5%;
            margin-bottom: 5%;
            border: 1px solid #ddd;
            padding: 2%;
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

        .addMoreSpan{
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            color: rebeccapurple;
        }
    </style>
@stop


@section('main-body')
    <section class="content">
        <div class="row create-ticket-div">
            <p class="info-span">Edit Ticket Class</p>
            <form action="{{url('admin/box-office/ticket-types/classes/'.$ticketClass->slug.'/update')}}" class="form-horizontal" id="create-form" method="post"
                  enctype="multipart/form-data">
                {{csrf_field()}}


                    <div class="form-group">
                        <span>Class Name <small>*</small></span>
                        <input type="text" name="class_name" value="{{$ticketClass->class_name}}" class="form-control class_name"
                               onfocus="removeError();" placeholder="Enter Ticket Class Name">
                        @if($errors->has('class_name'))
                            <span class="help-block">
                    <strong>
                        {{$errors->first('class_name')}}
                    </strong>
                </span>
                        @endif
                        <span class="class-name-error error help-block"></span>
                    </div>

                    <div class="form-group">
                        <span>Class Description <small>*</small></span>
                        <input type="text" name="class_description" value="{{$ticketClass->class_description}}" class="form-control class_description"
                               onfocus="removeError();" placeholder="Enter Ticket Class Description">
                        @if($errors->has('class_description'))
                            <span class="help-block">
                    <strong>
                        {{$errors->first('class_description')}}
                    </strong>
                </span>
                        @endif
                        <span class="class-description-error error help-block"></span>
                    </div>


                <div class="form-group">
                    <span class="empty-error error help-block"></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary subBtn" value="Update">
                </div>
            </form>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });

        $('#create-form').on('submit', function (e) {
            if($(document).find('input.class_name').val() == '')
            {
                e.preventDefault();
                $('span.empty-error').html('<strong>You cannot leave the shown field empty !</strong>');
            }

            if($(document).find('input.class_description').val() == '')
            {
                e.preventDefault();
                $('span.empty-error').html('<strong>You cannot leave the shown field empty !</strong>');
            }
        });


        function removeError() {
            $('.error').html('');
        }
    </script>
@stop