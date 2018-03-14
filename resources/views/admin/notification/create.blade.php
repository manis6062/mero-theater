@extends('admin.layout.master')

@section('main-body')
    <div class="main-content">                     
        <!-- Row start -->
        <div class="row gutters form-wrapper">
            <div class=" col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header artist-header"><a href="create-artist.html"> Create Footer</a></div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="artist-form">
                                    <form class="form" role="form" autocomplete="off" id="createForm" action="{{url('admin/content-management/notification/footer/submit')}}" method="post">
                                         {{csrf_field()}}
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Name <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" value="{{old('name')}}" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Text<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" name="text" value="{{old('text')}}">
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
            if ( $('#name').val() == '' || $('#text').val() == '') 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });

    </script>
@stop