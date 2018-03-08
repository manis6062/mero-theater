@extends('admin.layout.master')

@section('main-body')
    <div class="screen-list">
        <table class="table table-responsive table-bordered" style="width: 80%; margin: 5% 10%;">
            <thead>
            <th>Movie Title(Short Name)</th>
            <th>Distributor</th>
            <th>Duration</th>
            <th>Release Date</th>
            <th>Genre</th>
            <th>Action</th>
            </thead>

            <tbody>
            @if(isset($data) && $data->count() > 0)
                @foreach($data as $dat)
                    <tr>
                        <td>{{$dat->movie_title}}:{{$dat->movie_short_name}}</td>
                        <td>{{$dat->distributor}}</td>
                        <td>{{$dat->duration}}</td>
                        <td>{{$dat->openingdate}}</td>
                        <td>{{$dat->genre}}</td>
                        <td>
                            <span><a href="{{url('admin/movies/'.$dat->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            <span class="delete-screen"><a href="javascript:void(0)" id="moviedeleteid" onclick="deletemovie({{$dat->id}})"><i class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            @if($dat->status=="active")
                                <span><a href="javascript:void(0)" class="changestatus" data-id="{{$dat->id}}"><i class="fa fa-clone stat"></i>Make Inactive</a></span>
                            @else
                                <span><a href="{{url('admin/movies/'.$dat->id)}}"><i class="fa fa-clone"></i>Make Active</a></span>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop


@section('scripts')
    <script type="text/javascript">
       function deletemovie(argument) 
       {
           var ok = confirm('Make sure to delete?');
           if(ok)
           {    
            window.location = baseurl+"/admin/movies/delete/"+argument;
           }
       }

        $('.changestatus').on('click',function(){
            var id = $(this).data('id');
            $.ajax({
                url:baseurl+"/admin/movies/statuschange/"+id,
                type:'get',
                success: function (data) {
                    if(data == 'true')
                    {
                        alert("helo");
                    }
                }, error: function (data) {

                }
            });
        });
    </script>
@stop
