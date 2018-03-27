@extends('admin.layout.master1')

@section('styles')
    <link href="{{asset('custom/css/tooltip.css')}}" rel="stylesheet">
    <link href="{{url('/custom/css/bootstrap-tagsinput.css')}}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <style>
        .a-link {
            padding-left: 10px;
        }
        .a-link:hover {
            text-decoration: underline;
        }



         .bootstrap-tagsinput {
             width: 100%;
         }
        .alert-danger {
            color: red;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white;
            background-color: #00c0ef !important;
            border-radius:24px;
            -webkit-border-radius:24px;
            -moz-border-radius:24px;
            -ms-border-radius:24px;
            padding:3px 8px;
        }
        .tt-menu {
            box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
            width: 100%;
            cursor: pointer;

            padding: 14px 16px;
            background: white;
        }
        .tt-menu .tt-suggestion.tt-selectable {
            border-bottom: 1px solid #ddd;
        }

        .tt-menu .tt-suggestion.tt-selectable {
            padding-top: 14px;
            padding-bottom: 14px;
        }
        .twitter-typeahead{
            width: 100%;
        }


    </style>
@endsection

@section('main-body')
    <!-- Content Header (Page header) -->
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-laptop_windows"></i>
                        </div>
                        <div class="page-title">
                            <h5>Mero Theatre</h5>
                            <h6 class="sub-heading">Welcome to your Dashboard</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            @include('admin.last-login-time')
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END: .main-heading -->
        <!-- BEGIN .main-content -->
        <div class="main-content">

            <!-- Row start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-top: 5px solid green;">
                        <div class="panel-heading">
                            <div class="row">
                                <!--Adding quick link-->
                                <div class="col-md-6 pull-left">
                                    Compose Bulk SMS
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form id="compose-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8" style="margin-left: 15px;">
                                        {{ csrf_field()  }}

                                        <div class="">
                                            <div class="form-group">
                                                <div id="the-basics" style="width: 100%">
                                                    <label for="to">To*</label>
                                                    <a id="tooltip-1" class="pull-right"
                                                       href="#"
                                                       title="Start typing a name, surname, mobile number, or group with comma ',' separation.">
                                                        <i class="fa fa-info-circle pull-right"></i></a>
                                                    <input type="text" id="to" class="form-control field-on-required " name="contact"
                                                           data-role="tagsinput"
                                                           placeholder="Type Mobile no."
                                                           width="100%">
                                                </div>
                                                <input type="hidden" name="recipients" value="">
                                                <span id="short-number" style="color: red !important;"></span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="form-group">
                                                <label> OR Choose Contact Group</label>
                                                <div class="">

                                                    {!! Form::select('group[]', $contactGroup, null, ['multiple' => true, 'class' => 'form-control','id'=>'contact']) !!}

                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="">
                                                <div class="file-field form-group" style="margin-top: 10px">
                                                    <label>Add or Upload File</label>
                                                    <a id="tooltip-2" class="pull-right"
                                                       href="#"
                                                       title="You can also attach XLS or CSV files to import contact information.">
                                                        <i class="fa fa-info-circle pull-right"></i></a>
                                                    <input type="file" name="contacts" class="form-control" accept=".csv" id="contactsCSVFile" onchange="checkfile(this);">
                                                    <div class="">
                                                        <a href="{{url('admin/box-office/smsCampaigns/sampleCsv1/download/sample1')}}"
                                                           target="_blank">
                                                            Sample 1
                                                        </a>
                                                        <a href="{{url('admin/box-office/smsCampaigns/sampleCsv1/download/sample2')}}"
                                                           target="_blank">
                                                            Sample 2
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="optradio">Do you want to use template?</label>
                                            <label class="radio-inline">
                                                <input type="radio" class="radio-template" name="optradio" value="yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" class="radio-template" name="optradio" checked=""
                                                       value="no">No
                                            </label>

                                        </div>

                                        <div class="template-view">
                                            <div class="form-group" style="margin-top: 10px">
                                                <div id="template">

                                                    <input class="typeahead form-control" type="text" id="saved_templates"
                                                           placeholder="Search your message templates here ...">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="">
                                            <div class="form-group" style="margin-top: 10px">
                                                <label>Message*</label>
                                                <label class="radio-inline">
                                                    <input type="radio" class="radio-template" name="messegeLang" value="english" onclick="location.reload();"  checked>English
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" id="nepLang" class="radio-template" name="messegeLang"
                                                           value="nepali"  onclick="onLoad('nepali');">नेपाली
                                                    <a  href="#"
                                                        title="नेपालीमा परिबर्तन गर्न  नेपालीमा click गर्नुहोस  र messege type गर्दा space थिच्नुहोस  "><i
                                                                class="fa fa-info-circle pull-right"></i></a>
                                                </label>

                                                {{--<a id="tooltip-3" class="pull-right" href="#"--}}
                                                {{--title="*Advanced: Add {fn##} or {sn##} to insert firstname or surname of your Contacts. Set the length of the placeholder by adding or removing #. A field that is too long will be shortened - e.g. with {fn####} 'Alexander' becomes 'Alex'."><i--}}
                                                {{--class="fa fa-info-circle pull-right"></i></a>--}}

                                                {{--<a href="#" id="messageFirstNamePlaceholder" class="pull-right namePlaceholder a-link" data-holder="{sn#####}">Last name</a>--}}
                                                {{--<a href="#" id="messageFirstNamePlaceholder" class="pull-right namePlaceholder a-link" data-holder="{fn#####}">First name</a>--}}


                                                <textarea id="message" name="body" class="form-control" rows="4"
                                                          placeholder="Type your message here..."></textarea>
                                            </div>
                                        </div>
                                        {{--<div class="">--}}
                                            {{--<p>--}}
                                                {{--<input type="checkbox" class="filled-in" id="user_tagline"/>--}}
                                                {{--<label for="user_tagline">Append your tagline--}}
                                                {{--</label>--}}
                                            {{--</p>--}}
                                        {{--</div>--}}

                                        <div class="">
                                            <div class="">
                                                <div class="message-info" id="message-info">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="">
                                                <a class="" title="Click here to save Message as template for future use."
                                                   href="" id="save-template"><i class="fa fa-floppy-o"></i> Save Template
                                                </a>
                                                <a href="#" id="save-template-with-name"></a>
                                                <a id="tooltip-1" class="" href="#"
                                                   title="Save Message as template for future use.">
                                                    <i class="fa fa-info-circle "></i>
                                                </a>
                                            </div>
                                            <div class="">
                                                {{--@if(\Illuminate\Support\Facades\Auth::user()->id=='6')--}}
                                                <button class="btn btn-primary pull-right" type="button"
                                                        name="action" id="send-message">
                                                    <i class="fa fa-paper-plane-o"></i>
                                                    Send SMS
                                                </button>
                                                {{--@else--}}
                                                {{--<span style="color: red">--}}
                                                {{--Due to Smsc Upgradation of  server Our bulksms service will be down for certian time .We will notify you as soon as the problem has been fixed . Thank you .If any urgent Requirement please contact admin or this number 9810369866.--}}
                                                {{--</span>--}}
                                                {{--@endif--}}


                                                {{--<img src="{{asset('custom/images/send-sms.gif')}}" alt="Logo" class="img img-responsive pull-right" style="display:none" id="loadingImg">--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-left: 15px;">

                                        <h4>Schedule Message
                                            <a id="tooltip-1" class="pull-right" href="#"
                                               title="Optional, set if you want your message to be sent at scheduled time."><i
                                                        class="fa fa-info-circle pull-right"></i></a></h4>
                                        <label for="scheduled_date"> Send Later Date </label>
                                        <div class="input-group date" id="datepicker2">
                                            <input required type="text" id="scheduled_date" name="date" placeholder="Date"
                                                   class="form-control">
                                            <span class="input-group-addon" id="secondCalendarIconAddon"><i
                                                        class="fa fa-calendar"></i></span>
                                        </div>


                                        <div class="">
                                            <label for="timepicker1"> Send Later Time </label>
                                            <div class="input-group">

                                                <input type="text" name="time" class="form-control timepicker"
                                                       id="timepicker1" placeholder="Time">
                                                <span class="input-group-addon" id="secondCalendarIconAddon"><i
                                                            class="fa fa-clock-o"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>
    {{--Modal to show Template save confirmation message--}}
    <div class="modal fade" id="modalTemplateConfirmMessageShow" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Save Template</h4>
                </div>
                <div class="modal-body">
                    <p style="color: red;">Are you sure to save this message as Template?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="showShaveAsNameModal">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--/--}}
    {{--Modal to show request name before saveing Template--}}
    <div class="modal fade" id="modalTemplateSaveAsName" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Save Template As</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="form-group" style="margin-top: 10px">
                            <label>Name*</label>
                            <input type="text" name="template_name" id="template_name" class="form-control"
                                   placeholder="Template name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveTemplateName">Save</button>
                </div>
                [
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--/--}}
    {{--Modal to show send more bulk sms confirmation message--}}
    <div class="modal fade" id="modalConfirmationSendMoreBulkSMS" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Send more SMS</h4>
                </div>
                <div class="modal-body">
                    <p style="color: red;">Your messages will be sent shortly, do you want to continue sending more messages?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="cancelSendingBulkSMS">Cancel</button>
                    <button type="button" class="btn btn-primary" id="continueSendBulkSMS">Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--/--}}
@endsection


@section('scripts')
    <script src="{{url('/custom/js/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{url('/custom/js/typeahead.js')}}"></script>
    <script src="{{url('/custom/js/compose.js')}}"></script>
    <script type="text/javascript" src="{{url('/custom/js/language_translate/jsapi.js')}}"></script>
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
            type="text/javascript"></script>

    <script type="text/javascript">
        setTimeout(function(){
            $('#contact').multiselect();
        }, 800);
    </script>
    <script >



        $('.template-view').hide();
        $('.radio-template').on('change', function () {
            if ($(this).val() == 'yes') {
                $('.template-view').show();
            } else {
                $('.template-view').hide();
            }
        });
        $('#scheduled_date').datepicker({
            todayBtn: "linked",
            language: "it",
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        $('.timepicker').timepicker();

        $(document).ready(function () {
            var sms_setting =
                    {!! json_encode($sms_setting) !!}
            var maxLength = sms_setting.sms_length;
            var charUsedInfo = " characters used, ";
            var charLeftInfo = " left ";
            var smsS = " Credits";

            $('#message').keyup(function () {
                var message = "";
                var language=$('input[name=messegeLang]:checked').val();
              //  var ascii = /^[ -~]+$/;
                var ascii = /^[\x00-\x7F]*$/;
                if (!ascii.test($(this).val()) || language=='nepali') {
                    maxLength = sms_setting.unicode_sms_length;
                } else {
                    maxLength = sms_setting.sms_length;
                }
               // alert(maxLength);

                var length = $(this).val().length;
                var hasFirstOrLastNamePatterns = hasFnSN($(this).val());
                if (hasFirstOrLastNamePatterns != 0) {
                    length -= (hasFirstOrLastNamePatterns * 4);
                }
                var left = maxLength - length;

                message += length;
                message += charUsedInfo;

                if (left >= 0) {
                    message += left;
                    message += charLeftInfo;
                }

                // Counting number of message
                var totalMessage = Math.floor(length / maxLength);
                if (length > maxLength) {
                    totalMessage++;

                    message += totalMessage;
                    message += smsS;

                    message += "   ";
                    message += "*Long Message";
                }

                if  (length > 0) {
                    $('#message-info').text(message);
                } else {
                    $('#message-info').text("");
                }
            });
        });
        isTaglinechecked = false;

        var sms_setting = {!! json_encode($sms_setting) !!}
                via_message = sms_setting.taglib_name;

        $('#tagline').click(function (event) {

            if ($(this).is(":checked")) {
                $('#message').val(function (_, val) {
                    return val + via_message;
                });
                isTaglinechecked = true;
            }
            else {
                var message = $("#message").val();
                isTaglinechecked = false;
                $('#message').val(message.replace(via_message, ''));
            }
            $('#message').trigger('keyup');
        });
        user_via_message = ' :via ';
        $('#user_tagline').click(function (event) {
            if ($(this).is(":checked")) {
                $('#message').val(function (_, val) {
                    return val + user_via_message;
                });
                isTaglinechecked = true;
            }
            else {
                var message = $("#message").val();
                isTaglinechecked = false;
                $('#message').val(message.replace(user_via_message, ''));

            }
        });

        // Template confirmation modal show
        $('#save-template').on('click', function (evt) {
            evt.preventDefault();

            if ($("#message").val().length == 0) {
                var $toastContent = $('<span>Oops! There must be message to save as Template!</span>');
                $.toaster({priority: 'danger', title: 'Error', message: $toastContent});
                return false;
            }

            $('#modalTemplateConfirmMessageShow').modal('show');
        });

        // Template save as name modal show
        $('#showShaveAsNameModal').on('click', function (evt) {
            evt.preventDefault();
            $('#modalTemplateConfirmMessageShow').modal('hide');
            $('#modalTemplateSaveAsName').modal('show');
        });

        // Triggering the click events on saving Template name
        $('#saveTemplateName').on('click', function (evt) {
            evt.preventDefault();
            $('#save-template-with-name').click();
            setTimeout(function () {
                $('#modalTemplateSaveAsName').modal('hide');
            }, 1000);
        });

        // Cancel sending bulksms again
        $('#cancelSendingBulkSMS').on('click', function (evt) {
            evt.preventDefault();
            setTimeout(function () {
                $('#modalConfirmationSendMoreBulkSMS').modal('hide');
                window.location = js_base_url + "/user/dashboard";
            }, 1000);
        });

        // Continue sending more bulk sms
        $('#continueSendBulkSMS').on('click', function (evt) {
            evt.preventDefault();
            setTimeout(function () {
                $('#modalConfirmationSendMoreBulkSMS').modal('hide');

            }, 5);
        });

        function hasFnSN(messageText) {
            var count = (messageText.match(/({sn#+})|({fn#+})/g) || []).length;
            return count;
        }

        $(".namePlaceholder").click(function (evt) {
            evt.preventDefault();

            var holderData = $(this).data('holder');

            var cursorPos = $('#message').prop('selectionStart');
            var v = $('#message').val();
            var textBefore = v.substring(0,  cursorPos);
            var textAfter  = v.substring(cursorPos, v.length);

            $('#message').val(textBefore + holderData + textAfter);
            $('#message').trigger('keyup');

            $('#message').focus();
            setCaretPosition("message", cursorPos + holderData.length);

        });

        function setCaretPosition(elemId, caretPos) {
            var elem = document.getElementById(elemId);

            if(elem != null) {
                if(elem.createTextRange) {
                    var range = elem.createTextRange();
                    range.move('character', caretPos);
                    range.select();
                } else {
                    if(elem.selectionStart) {
                        elem.focus();
                        elem.setSelectionRange(caretPos, caretPos);
                    } else {
                        elem.focus();
                    }
                }
            }
        }

        // Switch input field to either nepali or english
        $('#switchMessageLanguage').click(function (evt) {
            evt.preventDefault();

            var langLable = $(this).text();

            if (langLable == "Nepali") {
                $(this).text("English");
            } else {
                $(this).text("Nepali");
            }

            $('#message').toggleClass('preetyFonts');
        });

    </script>

    <script src="{{asset('custom/js/tooltip.js')}}"></script>

    <!-- Javascript -->
    <script>
        $(function () {
            $("#tooltip-1").tooltip({position: {my: "right top+15", at: "right bottom", collision: "flipfit"}});
            $("#tooltip-2").tooltip({position: {my: "right top+15", at: "right bottom", collision: "flipfit"}});
            $("#tooltip-3").tooltip({position: {my: "right top+15", at: "right bottom", collision: "flipfit"}});
            $("#save-template").tooltip();
        });
    </script>
    <!-- for translating english to nepali -->
    <script type="text/javascript">

      // Load the Google Transliteration API
      google.load("elements", "1", {

          packages: "transliteration"
      });

      var lang = decodeURIComponent("ne");
      var e = 1;


      function onLoad(lang) {
          if(lang =='nepali') {
                  var options = {
                      sourceLanguage: 'en',
                      destinationLanguage: ['ne'],    //'hi','kn','ml','ta','te'
                      shortcutKey: 'ctrl+g',
                      transliterationEnabled: e
                  };
                  var control = new google.elements.transliteration.TransliterationControl(options);
                  var title = document.getElementById("message");
                  var ids = [title];
                  control.makeTransliteratable(ids);
              }


              //control.showControl('translControl');
          }

      google.setOnLoadCallback(onLoad);





 </script>


@endsection
