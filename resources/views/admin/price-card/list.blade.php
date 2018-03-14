@extends('admin.layout.master1')

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
                            <h5>Price Cards</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            <span class="last-login">Last Login: 2 hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END: .main-heading -->
        <!-- BEGIN .main-content -->
        <div class="main-content">

            <!-- Row start -->
            <div class="row gutters">
                <div class=" col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header artist-header"><a
                                    href="{{url('admin/box-office/price-card-management/create')}}"> Create New Price
                                Card</a></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table m-0 table-bordered common-table ticket-type-table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th width="100">Screens</th>
                                        <th width="120">Seat Categories</th>
                                        <th>Ticket Types</th>
                                        <th>Days</th>
                                        <th>Time Range</th>
                                        <th>Sequence</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th class="table-action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($priceCards) && $priceCards->count() > 0)
                                        @foreach($priceCards as $pc)
                                            <tr>
                                                <th scope="row"><a href="#"> {{$pc->name}}</a></th>
                                                @php $scIds = json_decode($pc->screen_ids, true); @endphp
                                                <td>
                                                    @foreach($scIds as $scid)
                                                        @if(\App\Screen\Screen::find($scid) != null)
                                                            <span style="display: block;">{{\App\Screen\Screen::find($scid)->name}}</span>
                                                        @endif
                                                    @endforeach
                                                </td>

                                                @php $seatCtegories = json_decode($pc->seat_categories, true); @endphp
                                                <td>
                                                    @foreach($seatCtegories as $scat)
                                                        <span style="display: block;">{{$scat}}</span>
                                                    @endforeach
                                                </td>

                                                @php $ttIds = json_decode($pc->ticket_types_ids, true); @endphp
                                                <td>
                                                    @foreach($ttIds as $ttId)
                                                        @if(\App\TicketTypeModel\TicketType::find($ttId) != null)
                                                            <span style="display: block;">{{\App\TicketTypeModel\TicketType::find($ttId)->label}}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{implode(',', json_decode($pc->selected_days, true))}}</td>
                                                <td>{{$pc->time_range}}</td>
                                                <td>{{implode(',', json_decode($pc->sequences, true))}}</td>
                                                <td>{{implode(',', json_decode($pc->prices, true))}}</td>
                                                <td>{{$pc->status}}</td>
                                                <td>{{date('M d, Y', strtotime($pc->created_at))}}</td>
                                                <td>
                                                    <a href="{{url('admin/box-office/price-card-management/'.$pc->slug.'/edit')}}"
                                                       class="table-content-edit" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="icon-edit2"></i>Edit
                                                    </a>
                                                    <a href="#" class="table-content-delete delete-price-card"
                                                       data-pcid="{{$pc->id}}" data-toggle="tooltip"
                                                       data-placement="top" title="Delete">
                                                        <i class="icon-delete2"></i>Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- END: .main-content -->
    </div>
    <!-- END: .app-main -->
@stop

@section('scripts')
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });
        $('.delete-price-card').on('click', function (e) {
            e.preventDefault();
            var pcid = $(this).data('pcid');
            alertify.confirm("Delete this price card ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/box-office/price-card-management/delete?pcid=' + pcid,
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