@extends('admin.layout.master')

@section('main-body')
    <div class="main-content">                     
        <!-- Row start -->
        <div class="row gutters form-wrapper">
            <div class=" col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header artist-header"><a href="create-artist.html"> Create Movie Banner</a></div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="artist-form">
                                    <form class="form" role="form" autocomplete="off" id="createForm" action="{{url('admin/content-management/movie-banner/submit')}}" method="post" enctype="multipart/form-data">
                                         {{csrf_field()}}
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Name <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text"  name="name" value="{{old('name')}}" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Image<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="file" name="image" >
                                            </div>
                                             (Type: jpeg,jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Description<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <textarea name="description">{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Link<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" name="link" value="{{old('text')}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Status<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="status" class="custom-select">
                                                    <option value="active" class="selected">Active</option>
                                                    <option value="inactive">InActive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
@stop


@section('scripts')
    <script>
        $('#createForm').on('submit', function (e) {
            if ( $('#name').val() == '' || $('#image').val() == '' || $('#description').val() == '' || $('status').val() == '') 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });

    </script>
@stop