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

        .info-span {
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: magenta;
        }

        .info-msg {
            font-size: 15px;
            text-align: center;
            font-weight: 500;
            color: darkblue;
        }

        small {
            color: red;
        }
    </style>
@stop


@section('main-body')
    <section class="content">
        <div class="row create-ticket-div">
            <p class="info-span">Edit Ticket Type</p>
            <form action="{{url('admin/box-office/ticket-types/'.$ticketType->slug.'/update')}}" class="form-horizontal" id="create-form"
                  method="post"
                  enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <span>Description <small>*</small></span>
                    <input type="text" name="description" value="{{$ticketType->description}}" class="form-control"
                           id="description"
                           onfocus="removeError();" placeholder="Enter Ticket Description">
                    @if($errors->has('description'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('description')}}
                    </strong>
                </span>
                    @endif
                    <span class="description-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Label <small>*</small></span>
                    <input type="text" name="label" value="{{$ticketType->label}}" class="form-control" id="label"
                           onfocus="removeError();" placeholder="Enter Ticket Label">
                    @if($errors->has('label'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('label')}}
                    </strong>
                </span>
                    @endif
                    <span class="label-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Ticket Class <small>*</small></span>
                    <select name="ticket_class_id" id="ticket_class_id" class="form-control" onfocus="removeError();">
                        <option value="">-- Select Ticket Class --</option>
                        @if(isset($ticketClasses) && $ticketClasses->count() > 0)
                            @foreach($ticketClasses as $tc)
                                <option value="{{$tc->id}}" {{$ticketType->ticket_class_id == $tc->id ? 'selected' : ''}}>{{$tc->class_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @if($errors->has('ticket_class_id'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('ticket_class_id')}}
                    </strong>
                </span>
                    @endif
                    <span class="ticket-class-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Default Price <small>*</small></span>
                    <input type="text" name="default_price" value="{{$ticketType->default_price}}"
                           class="form-control" id="default_price"
                           onfocus="removeError();" placeholder="Enter Default Price">
                    @if($errors->has('default_price'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('default_price')}}
                    </strong>
                </span>
                    @endif
                    <span class="default-price-error error help-block"></span>
                </div>


                <div class="form-group">
                    <span>Display Sequence <small>*</small></span>
                    <input type="text" name="display_sequence" value="{{$ticketType->display_sequence}}"
                           class="form-control" id="display_sequence"
                           onfocus="removeError();" placeholder="Enter Display Sequence">
                    @if($errors->has('display_sequence'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('display_sequence')}}
                    </strong>
                </span>
                    @endif
                    @if(isset($sequenceNumbers) && $sequenceNumbers->count() > 0)
                        @php $sequenceNumbers = $sequenceNumbers->toArray(); @endphp
                        @foreach($sequenceNumbers as $sq)
                            <input type="hidden" class="usedSqNum" value="{{$sq}}">
                        @endforeach
                        <span class="info-msg"><i
                                    class="fa fa-info"></i> Display sequence {{implode(',',$sequenceNumbers)}} is already used !</span>
                    @endif
                    <span class="display-sequence-error-exists help-block"></span>
                    <span class="display-sequence-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Voucher Identifier</span>
                    <input type="text" name="voucher_identifier" value="{{$ticketType->voucher_identifier}}"
                           class="form-control" id="voucher_identifier"
                           onfocus="removeError();" placeholder="Enter Voucher Identifier">
                    @if($errors->has('voucher_identifier'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('voucher_identifier')}}
                    </strong>
                </span>
                    @endif
                    <span class="voucher-identifier-error error help-block"></span>
                </div>


                <div class="form-group">
                    <span>Sales Via</span>
                    <select name="sales_via" class="form-control" onfocus="removeError();">
                        <option value="">-- Choose Sales Via --</option>
                        <option value="web" {{$ticketType->sales_via == 'web' ? 'selected' : ''}}>WEB</option>
                        <option value="pos" {{$ticketType->sales_via == 'pos' ? 'selected' : ''}}>POS</option>
                        <option value="kiosk" {{$ticketType->sales_via == 'kiosk' ? 'selected' : ''}}>KIOSK</option>
                    </select>
                    @if($errors->has('sales_via'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('sales_via')}}
                    </strong>
                </span>
                    @endif
                    <span class="sales-via-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Ticket Type</span>
                    <select name="ticket_type" class="form-control" onfocus="removeError();">
                        <option value="">-- Choose Ticket Type --</option>
                        <option value="standard" {{$ticketType->ticket_type == 'standard' ? 'selected' : ''}}>Standard</option>
                        <option value="complimentary" {{$ticketType->ticket_type == 'complimentary' ? 'selected' : ''}}>Complimentary</option>
                    </select>
                    @if($errors->has('ticket_type'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('ticket_type')}}
                    </strong>
                </span>
                    @endif
                    <span class="ticket-type-error error help-block"></span>
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
        $('#create-form').on('submit', function (e) {
            $('.error').html('');
            $('.display-sequence-error-exists').html('');
            if ($('#screen_id').val() == '') {
                e.preventDefault();
                $('.screen-id-error').html('<strong>Please select the screen.</strong>');
            }

            if ($('#description').val() == '') {
                e.preventDefault();
                $('.description-error').html('<strong>Please enter the description.</strong>');
            }

            if ($('#label').val() == '') {
                e.preventDefault();
                $('.label-error').html('<strong>Please enter the label.</strong>');
            }


            if ($('#ticket_class').val() == '') {
                e.preventDefault();
                $('.ticket-class-error').html('<strong>Please choose the ticket class.</strong>');
            }


            if ($('#default_price').val() == '') {
                e.preventDefault();
                $('.default-price-error').html('<strong>Please enter the default price.</strong>');
            }

            if ($('#display_sequence').val() == '') {
                e.preventDefault();
                $('.display-sequence-error').html('<strong>Please enter the display sequence.</strong>');
            }

            if($(document).find('input.usedSqNum').length > 0)
            {
                var arr = [];
                $(document).find('input.usedSqNum').each(function(){
                    arr.push($(this).val());
                });

                if ($.inArray($('#display_sequence').val(), arr) != -1 && $('#display_sequence').val() != "{{$ticketType->display_sequence}}") {
                    e.preventDefault();
                    $('.display-sequence-error').html('<strong>Inputted Display Sequence is Already Used !</strong>');
                }

            }

        });

        function isNumber(evt, element) {

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (
                (charCode < 48 || charCode > 57) &&
                (charCode != 8) &&
                (charCode != 110))
                return false;

            return true;
        }
        $('input#display_sequence').keypress(function (event) {
            return isNumber(event, this)
        });

        $(document).on('keypress', '#default_price', function (event) {
            if ((event.which == 46 && $(this).val().indexOf('.') == -1)) {
                return true;
            } else if (event.which == 48) {
                return true;
            } else if (event.which == 49) {
                return true;
            } else if (event.which == 50) {
                return true;
            } else if (event.which == 51) {
                return true;
            } else if (event.which == 52) {
                return true;
            } else if (event.which == 53) {
                return true;
            } else if (event.which == 54) {
                return true;
            } else if (event.which == 55) {
                return true;
            } else if (event.which == 56) {
                return true;
            } else if (event.which == 57) {
                return true;
            } else if (event.which == 08) {
                return true;
            } else {
                return false;
            }
        });

        function removeError() {
            $('.error').html('');
        }

        $(document).find('#ticket_class_id').on('change', function () {
            $(document).find('input[name=ticket_class]').remove();
            if ($(this).val() != '') {
                var tc = $('#ticket_class_id option:selected').text();
                $(document).find('#create-form').append('<input type="hidden" name="ticket_class" value="' + tc + '">');
            } else {
                $(document).find('input[name=ticket_class]').remove();
            }
        });

        $('#display_sequence').on('focusout', function () {
            if($(document).find('input.usedSqNum').length > 0)
            {
                var arr = [];
                $(document).find('input.usedSqNum').each(function(){
                    arr.push($(this).val());
                });

                if ($.inArray($('#display_sequence').val(), arr) != -1 && $('#display_sequence').val() != "{{$ticketType->display_sequence}}") {
                    $('.display-sequence-error-exists').html('<strong>Inputted Display Sequence is Already Used !</strong>');
                }
            }
        });

        $('#display_sequence').on('focus', function (e) {
            $('.display-sequence-error-exists').html('');
        });
    </script>
@stop