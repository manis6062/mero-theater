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
                                    <form class="form" role="form" autocomplete="off" id="createForm" action="{{url('admin/content-management/movie-banner/update/'.$editdata->id)}}" method="post" enctype="multipart/form-data">
                                         {{csrf_field()}}
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Name <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text"  name="name" value="{{$editdata->name}}" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"> Existing Image<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <img src="{{asset('moviebanner/'.$editdata->image)}}" class="img img-responsive">
                                                <label class="control-label">Change Image</label>
                                                <input class="form-control" type="file" name="image" >
                                            </div>
                                             (Type: jpeg,jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Description<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <textarea name="description">{{isset($editdata->description)?$editdata->description:''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Link<span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" name="link" value="{{isset($editdata->link)?$editdata->link:''}}">
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
            if ( $('#name').val() == '' || $('#description').val() == '' || $('status').val() == '') 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });

        $('#image').on('change', function () {
            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input#image').val();
            if (file != '') {
                var fileSize = $('input#image')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                } else {
                    var ext = $('input#image').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subModalBtn').prop('disabled', true);
                        alertify.alert('Invalid Image Format !');
                    } else {
                        var fileInput = $(this)[0],
                            fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 200 && heightOfImg != 200) {
                                    alertify.alert('Invalid Image Dimension !');
                                    $('.subModalBtn').prop('disabled', true);
                                } else {
                                    $('.subModalBtn').prop('disabled', false);
                                }
                            };
                        }
                    }
                }
            }
        });
    </script>
@stop