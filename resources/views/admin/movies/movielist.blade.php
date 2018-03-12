@extends('admin.layout.master')

@section('main-body')
<br>
    <a href="{{url('admin/box-office/movies/create')}}" class="btn btn-primary">Create Movie</a>
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
                        <td><a href="{{url('admin/box-office/movies/'.$dat->id.'/view')}}">{{$dat->movie_title}}:{{$dat->movie_short_name}}</a></td>
                        <td>{{$dat->distributor}}</td>
                        <td>{{$dat->duration}}</td>
                        <td>{{$dat->openingdate}}</td>
                        <td>{{$dat->genre}}</td>
                        <td>
                            <span><a href="{{url('admin/box-office/movies/'.$dat->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            <span class="delete-screen"><a href="javascript:void(0)" id="moviedeleteid" onclick="deletemovie({{$dat->id}})"><i class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            
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
            window.location = baseurl+"/admin/box-office/movies/delete/"+argument;
           }
       }

       @if(isset($alertify) && $alertify == 'successfully-updated')
            alertify.success('Movie successfully updated.');
        @endif

        @if(isset($alertify) && $alertify == 'error-updating')
            alertify.success('Movie error in updating.');
        @endif

        @if(isset($alertify) && $alertify == 'successfully-deleted')
            alertify.success('Movie successfully deleted .');
        @endif

    </script>
@stop
