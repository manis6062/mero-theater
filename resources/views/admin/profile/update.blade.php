@extends('admin.layout.master1')

@section('styles')

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
						<h5>Profile</h5>
						<h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
					<div class="right-actions">
						<span class="last-login"> @include('admin.last-login-time')</span>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="row gutters form-wrapper">
		<div class=" col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="card">
						<div class="card-body">
							<div class="artist-form">
								<div class="account-brand-logo">
									<img src="{{asset('admins/theme/img/mero-theatre-logo.png')}}" alt="mero theatre">
								</div>
								@if(isset($editdata) && $editdata->count() > 0)
                                        @foreach($editdata as $edt)
								<form class="update-form" role="form" autocomplete="off" action="{{url('admin/profile/master/'.$edt->admin->id.'/update')}}" method="post" id="update-form">
									  {{csrf_field()}}
									
									<div class="account-form">
										<div class="card-header artist-header">
											<a href="#"> Account Details</a>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Account Name <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name="account_name" value="{{$edt->admin->account_name}}" id="account_name"
                                                onfocus="removeError();">
                                                @if($errors->has('account_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('account_name')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="account-name-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Title <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name="title" value="{{$edt->admin->title}}" id="title"
                                                onfocus="removeError();">
                                                @if($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('title')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="title-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">First Name <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" name ="fname"type="text" value="{{$edt->admin->first_name}}" id="fname"
                                                onfocus="removeError();">
                                                @if($errors->has('fname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('fname')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="fname-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Last Name <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name ="lname" value="{{$edt->admin->last_name}}" id="lname"
                                                onfocus="removeError();">
                                                @if($errors->has('lname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('lname')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="lname-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Phone <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="number" name ="mobile" value="{{$edt->admin->mobile}}" id="mobile"
                                                onfocus="removeError();">
                                                @if($errors->has('moble'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('mobile')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="mobile-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Verified Contact Email <span class="req">*</span></label>
											<div class="col-lg-9">
												<span>brijesh@esignature.com.np</span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Update Contact email <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="email" value="brijesh@esignature.com.np">
											</div>
										</div>
									</div>

									<div class="account-form">
										<div class="card-header artist-header">
											<a href="#"> Company Details</a>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Company name <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name ="company_name" value="{{$edt->company_name}}" id="company_name"
                                                onfocus="removeError();">
                                                @if($errors->has('company_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('company_name')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="company-name-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">company display name <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name ="company_display_name" value="{{$edt->company_display_name}}" id="company_display_name"
                                                onfocus="removeError();">
                                                @if($errors->has('company_display_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('company_display_name')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="company-display-name-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">company VAT number <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name ="vat_number" value="{{$edt->vat_number}}" id="vat_number"
                                                onfocus="removeError();">
                                                @if($errors->has('vat_number'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('vat_number')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="vat-number-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">country <span class="req">*</span></label>
											<div class="col-lg-9">

												<select name="country" class="custom-select" id="country"
                                                onfocus="removeError();">
													<option {{$edt->country == 'Nepal' ? 'selected' : ''}} value="Nepal">Nepal   </option>
												</select>
												@if($errors->has('country'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('country')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="country-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">time zone <span class="req">*</span></label>
											<div class="col-lg-9">
												<select name="timezone" class="custom-select" id="timezone"
                                                onfocus="removeError();">
													<option {{$edt->timezone == 'Asia/Kathmandu' ? 'selected' : ''}} value="Asia/Kathmandu">Asia/Kathmandu</option>
												</select>
												@if($errors->has('timezone'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('timezone')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="time-zone-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Address 1 <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" name="address1" type="text" value="{{$edt->address1}}" id="address1"
                                                onfocus="removeError();">
                                                @if($errors->has('address1'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('address1')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="address1-error error help-block"></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Address 2 <span class="req">*</span></label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name ="address2" value="{{$edt->address2}}" id="address2"
                                                onfocus="removeError();">
                                                @if($errors->has('address2'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('address2')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="address2-error error help-block"></span>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"></label>
										<div class="col-lg-9">
											<input type="reset" class="btn btn-secondary" value="Cancel">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</div>
									@endforeach
								@endif
								</form>
								

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@stop

	@section('scripts')

	<script>
		$('#update-form').on('submit', function (e) {
        $('.error').html('');
        if ($('#account_name').val() == '') {
            e.preventDefault();
            $('.account-name-error').html('<strong>Please enter the account name.</strong>');
        }

        if ($('#title').val() == '') {
            e.preventDefault();
            $('.title-error').html('<strong>Please enter the title.</strong>');
        }

        if ($('#fname').val() == '') {
            e.preventDefault();
            $('.fname-error').html('<strong>Please enter your first name.</strong>');
        }

        if ($('#lname').val() == '') {
            e.preventDefault();
            $('.lname-error').html('<strong>Please enter your email.</strong>');
        }


        if ($('#mobile').val() == '') {
            e.preventDefault();
            $('.mobile-error').html('<strong>Please enter your mobile number.</strong>');

        }

         if ($('#company_name').val() == '') {
            e.preventDefault();
            $('.company-name-error').html('<strong>Please enter the company name.</strong>');

        }

         if ($('#company_display_name').val() == '') {
            e.preventDefault();
            $('.company-display-name-error').html('<strong>Please enter the company display name.</strong>');

        }

         if ($('#vat_number').val() == '') {
            e.preventDefault();
            $('.vat-number-error').html('<strong>Please enter the company VAT number.</strong>');

        }

         if ($('#mobile').val() == '') {
            e.preventDefault();
            $('.mobile-error').html('<strong>Please enter your mobile number.</strong>');

        }

         if ($('#country').val() == '') {
            e.preventDefault();
            $('.country-error').html('<strong>Please select the country</strong>');

        }

         if ($('#timezone').val() == '') {
            e.preventDefault();
            $('.time-zone-error').html('<strong>Please select the country time zone.</strong>');

        }

         if ($('#address1').val() == '') {
            e.preventDefault();
            $('.address1-error').html('<strong>Please enter your first address.</strong>');

        }

         if ($('#address2').val() == '') {
            e.preventDefault();
            $('.address2-error').html('<strong>Please enter your second address.</strong>');

        }
    });

	</script>
	@stop