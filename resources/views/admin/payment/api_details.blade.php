@extends('admin.layout.master1')

@section('styles')
    <style>
        #addmorebtn_live {
            cursor: pointer;
        }

        #addmorebtn_test {
            cursor: pointer;
        }


    </style>
@stop

@section('main-body')
    <!-- BEGIN .app-main -->
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-border_outer"></i>
                        </div>
                        <div class="page-title">
                            <h5>API Details</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
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
                        <div class="row gutters form-wrapper api-sec">
                            <div class=" col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h4>Update Payment Api Keys</h4>
                                        </div>


                                        <div class="key-title">
                                            <span><i class="icon-key2"> Live keys</i></span>
                                        </div>
                                        <div class="api-dettails-form">
                                           @foreach($payment_apis as $pa)
                                           <form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/payment_api_update/'.$pa->id)}}" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" name="payment_type_id" value="{{$payment_type_id}}">
                                            <input type="hidden" name="api_type" value="live">
                                                <div class="row">
                                                    <div class="col-lg-4"><div class="form-group">
                                                    <label>Label</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="Enter Key Label" name="label" value="{{$pa->label}}" id="live_label">
                                                    </div>
                                                </div></div>
                                                     <div class="col-lg-6"><div class="form-group">
                                                    <label>Key</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="Enter API Key" name="api_key" value="{{$pa->api_key}}" id="live_api_key"> 
                                                    </div>
                                                </div></div>
                                                 <div class="col-lg-2"><div class="form-group" style="margin-top: 30px;">
                                                    <div class="input-group">
                                                      <button type="submit" class="btn btn-default">
                                                          Update
                                                      </button>


 <a href="#" class="close delete-api-key" data-id="{{$pa->id}}" style="margin: 15px 30px;" data-toggle="tooltip" data-placement="top" title="Delete" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                            </form>
                                      @endforeach

                                            <div class="new_key_row_live"></div>
                                     @if(!empty($pa->api_type))
                                       @if($pa->api_type == 'live')
                                            <div class="text-right">
                                                    <br>
                                    <i class="fa fa-plus" id="addmorebtn_live">Add More</i>
                                                            </div>
                                        @else
                                        <div class="text-center">
                                                    <br>
                                    <i class="fa fa-plus" id="addmorebtn_live">Add Key</i>
                                                            </div>                    
                                       @endif      
                                          @else
                                          <div class="text-center">
                                                    <br>
                                    <i class="fa fa-plus" id="addmorebtn_live">Add Key</i>
                                                            </div>  
                                          @endif                 


<form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/payment_api_live_note/update/'.$payment_type_id)}}" method="post" id="createForm" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="api-note">
                                                <textarea name="live_note" id="body" rows="5" class="form-control" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut lectus eros. Cras convallis porta pulvinar. Cras odio mi, viverra eu finibus et, placerat in ligula." onfocus="removeError();" >{{$payment_api_details->live_note}}</textarea>
                                                <div class="text-center">
                                                    <br>
                                                                <button type="submit" class="btn btn-default">Update Note</button>
                                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="card-header">
                                        </div>
                                        <div class="key-title">
                                            <span><i class="icon-meter2"> Test keys</i></span>
                                        </div>
                                           <div class="api-dettails-form">
                                           @foreach($payment_apis_test as $pa)
                                           <form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/payment_api_update/'.$pa->id)}}" method="post" id="createForm" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" name="payment_type_id" value="{{$payment_type_id}}">
                                            <input type="hidden" name="api_type" value="test">
                                                <div class="row">
                                                    <div class="col-lg-4"><div class="form-group">
                                                    <label>Label</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="Enter Key Label" name="label" value="{{$pa->label}}">
                                                    </div>
                                                </div></div>
                                                     <div class="col-lg-6"><div class="form-group">
                                                    <label>Key</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="Enter API Key" name="api_key" value="{{$pa->api_key}}"> 
                                                    </div>
                                                </div></div>
                                                 <div class="col-lg-2"><div class="form-group" style="margin-top: 30px;">
                                                    <div class="input-group">
                                                      <button type="submit" class="btn btn-default">
                                                          Update
                                                      </button>


 <a href="#" class="close delete-api-key" data-id="{{$pa->id}}" style="margin: 15px 30px;" data-toggle="tooltip" data-placement="top" title="Delete" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                            </form>
                                      @endforeach

                                            <div class="new_key_row_test"></div>
                                         @if(!empty($pa->api_type))
                                     @if(!empty($pa->api_type == 'test'))
                                            <div class="text-right">
                                                    <br>
                                    <i class="fa fa-plus" id="addmorebtn_test">Add More</i>
                                                            </div>
                                             @else
                                             <div class="text-center">
                                                    <br>
                                    <i class="fa fa-plus" id="addmorebtn_test">Add Key</i>
                                                            </div>
                                             @endif 
                                             @else
                                                 <div class="text-center">
                                                    <br>
                                    <i class="fa fa-plus" id="addmorebtn_test">Add Key</i>
                                                            </div>
                                             @endif           
<form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/payment_api_test_note/update/'.$payment_type_id)}}" method="post" id="createForm" enctype="multipart/form-data">{{csrf_field()}}
                                            <div class="api-note">
                                                <textarea name="test_note" id="body" rows="5" class="form-control" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut lectus eros. Cras convallis porta pulvinar. Cras odio mi, viverra eu finibus et, placerat in ligula." onfocus="removeError();" >{{$payment_api_details->test_note}}</textarea>
                                                <div class="text-center">
                                                    <br>
                                                                <button type="submit" class="btn btn-default">Update Note</button>
                                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                    </div>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <!-- END: .main-content -->
    </div>
    <!-- END: .app-main -->
@stop
@section('scripts')
    <script>

          $('#addmorebtn_live').on('click',function(e){
        e.preventDefault();
            $.ajax({
                url:baseurl+'/admin/content-management/payment-gateway/payment_api_field_live',
                type:'POST',
                data:{ 
                   'payment_type_id': {{$payment_type_id}},
                   '_token': $('#token').val(),
                    },
                success:function(data)
                {
                    $('.new_key_row_live').append(data);
                }
            });
        });


             $('#addmorebtn_test').on('click',function(e){
        e.preventDefault();
            $.ajax({
                url:baseurl+'/admin/content-management/payment-gateway/payment_api_field_test',
                type:'POST',
                 data:{ 
                   'payment_type_id': {{$payment_type_id}},
                   '_token': $('#token').val(),
                    },
                success:function(data)
                {
                    $('.new_key_row_test').append(data);
                }
            });
        });

             $('.delete-api-key').on('click', function (e) {
            e.preventDefault();
            var Id = $(this).data('id');
            alertify.confirm("Delete this api key?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/content-management/payment_api/delete?Id=' + Id,
                        type: 'get',
                        success: function (data) {
                            if (data == 'true') {
                                window.location.reload();
                            } else {
                                alertify.alert("Oops ! something went wrong. Please try again.");
                            }
                        }, error: function (data) {

                        }
                    });
                },
                function () {

                });
        });


        
    </script>
@stop

