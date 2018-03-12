@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="screen-list" style="width: 80%; margin: 5% 10%;">
            <a href="{{url('admin/box-office/price-card-management/create')}}">Add New Price Card</a>
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success">
                    <i class="fa fa-times pull-right closeMessage"></i>
                    <p class="text-center">{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                </div>
            @endif
            <table class="table table-responsive table-bordered">
                <thead>
                <th>Name</th>
                <th>Screens</th>
                <th>Ticket Types</th>
                <th>Days</th>
                <th>Time Range</th>
                <th>Sequence</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created On</th>
                <th width="100">Action</th>
                </thead>

                <tbody>
                @if(isset($priceCards) && $priceCards->count() > 0)
                    @foreach($priceCards as $pc)
                        <tr>
                            <td>{{$pc->name}}</td>
                            @php $scIds = json_decode($pc->screen_ids, true); @endphp
                            <td>
                                @foreach($scIds as $scid)
                                    <span style="display: block;">{{\App\Screen\Screen::find($scid)->name}}</span>
                                @endforeach
                            </td>
                            @php $ttIds = json_decode($pc->ticket_types_ids, true); @endphp
                            <td>
                                @foreach($ttIds as $ttId)
                                    <span style="display: block;">{{\App\TicketTypeModel\TicketType::find($ttId)->label}}</span>
                                @endforeach
                            </td>
                            <td>{{implode(',', json_decode($pc->selected_days, true))}}</td>
                            <td>{{$pc->time_range}}</td>
                            <td>{{$pc->sequence}}</td>
                            <td>{{$pc->price}}</td>
                            <td>{{$pc->status}}</td>
                            <td>{{date('M d, Y', strtotime($pc->created_at))}}</td>
                            <td>
                                <span><a href="{{url('admin/box-office/price-card-management/'.$pc->slug.'/edit')}}"><i
                                                class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                                <br>
                                <span class="delete-price-card" data-pcid="{{$pc->id}}"><a href=""><i
                                                class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12" class="text-center">No Any Price Card Found !</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </section>
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