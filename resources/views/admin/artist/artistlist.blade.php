@extends('admin.layout.master')

@section('main-body')
<br>
    <a href="{{url('admin/box-office/artist/create')}}" class="btn btn-primary">Create Artist</a>
    <div class="screen-list">
        <table class="table table-responsive table-bordered" style="width: 80%; margin: 5% 10%;">
            <thead>
            <th>Artist Name</th>
            <th>Avatar</th>
            <th>Hash Tags</th>
            <th>Action</th>
            </thead>

            <tbody>
            @if(isset($data) && $data->count() > 0)
                @foreach($data as $dat)
                    <tr>
                        <td><a href="{{url('admin/box-office/artist/'.$dat->id.'/view')}}">{{$dat->artists_name}}</a></td>
                        <td><img src="{{asset('artists/'.$dat->artists_avatar)}}" class="img img-responsive"></td>
                        <td>{{$dat->hashtag}}</td>
                        <td>
                            <span><a href="{{url('admin/box-office/artist/'.$dat->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                            <br>
                            <span class="delete-screen"><a href="javascript:void(0)" id="artistdeleteid" onclick="deleteartist({{$dat->id}})"><i class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
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
       function deleteartist(argument) 
       {
           var ok = confirm('Make sure to delete?');
           if(ok)
           {    
            window.location = baseurl+"/admin/box-office/artist/delete/"+argument;
           }
       }

       @if(isset($alertify) && $alertify == 'successfully-updated')
            alertify.success('Artist successfully updated.');
        @endif

        @if(isset($alertify) && $alertify == 'error-updating')
            alertify.success('Artist error in updating.');
        @endif

        @if(isset($alertify) && $alertify == 'successfully-deleted')
            alertify.success('Artist successfully deleted .');
        @endif
    </script>
@stop
