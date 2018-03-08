@extends('admin.layout.master')

@section('main-body')
    <div class="screen-list">
        <table class="table table-responsive table-bordered" style="width: 80%; margin: 5% 10%;">
            <thead>
            <th>Screen Name</th>
            <th>Available Seat Image</th>
            <th>Selected Seat Image</th>
            <th>Reserved Seat Image</th>
            <th>Sold Seat Image</th>
            <th>Created On</th>
            <th>Action</th>
            </thead>

            <tbody>
            @if(isset($screens) && $screens->count() > 0)
                @foreach($screens as $sc)
                    <tr>
                        <td>{{$sc->name}}</td>
                        <td><img src="{{asset('screen/available-seat-image/'.$sc->available_seat)}}" alt=""></td>
                        <td><img src="{{asset('screen/selected-seat-image/'.$sc->selected_seat)}}" alt=""></td>
                        <td><img src="{{asset('screen/reserved-seat-image/'.$sc->reserved_seat)}}" alt=""></td>
                        <td><img src="{{asset('screen/sold-seat-image/'.$sc->sold_seat)}}" alt=""></td>
                        <td>{{date('M d, Y', strtotime($sc->created_at))}}</td>
                        <td>
                            <span><a href="{{url('admin/screens/'.$sc->slug.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            <span class="delete-screen" data-screenid="{{$sc->id}}"><a href=""><i class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            <span><a href="{{url('admin/screens/'.$sc->slug.'/seat')}}"><i class="fa fa-clone"></i> Seat</a></span>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop

@section('scripts')
    <script>
       $('.delete-screen').on('click', function (e) {
           e.preventDefault();
           var screenId = $(this).data('screenid');
           alertify.confirm("Delete this screen ?",
               function(){
                   $.ajax({
                       url: baseurl+'/admin/screens/delete?screenId='+screenId,
                       type: 'get',
                       success: function (data) {
                           if(data == 'true')
                           {
                               window.location.reload();
                           }else{
                               alertify.alert("Oops ! something went wrong. Please try again.");
                           }
                       }, error: function (data) {

                       }
                   });
               },
               function(){

               });
       });
    </script>
@stop