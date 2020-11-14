@extends('portal.layouts.contentLayoutMaster2')

@section('title', 'Buying')

@section('vendor-style')
<!-- vendor css files -->
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{asset('port/assets/css/timeline.css')}}">
@endsection
@section('content')
<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Profile
                    <small>Welcome to Leaf</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index-2.html"><i class="zmdi zmdi-home"></i> Leaf</a>
                    </li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="container">
                    <div class="card">

                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active text" data-toggle="tab" href="#about">Order Generation</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane body active" id="about">
                            <small class="text-muted"> Generate Order Below </small>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-dark btn-round" type="submit">GENERATE</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#usersettings">New Order </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane  active" id="usersettings">
                        {{--
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Security</strong> Settings</h2>
                                </div>
                                <form method="get" action="{{route('settings.update.password')}}"
                        autocomplete="off" class="body">
                        <div class="form-group">
                            <input type="password" name="current_password" required class="form-control" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="New Password" name="password_confirmation">
                        </div>
                        <button class="btn btn-info btn-round">Save Changes</button>
                    </div>
                </div>
                --}}
                <div class="card">
                    <div class="header">
                        <h2><strong>Create</strong> Order</h2>
                    </div>
                    <div class="body">
                        <form class="row clearfix" action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PATCH')
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Order ID" name="title" value="{{$user->title??old('title')}}">
                                    @error('title')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="country" name="country_id" required>
                                        <option value="">Select Customer</option>
                                        @foreach (\App\FarmerProfile::all() as $farmer)
                                        <option value="{{$farmer->id}}">
                                            {{$farmer->full_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('farmer')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Headline" name="headline" value="{{$user->headline??old('headline')}}">
                                    @error('headline')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="location" name="location" value="{{$user->location??old('location')}}">
                                    @error('location')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="country" name="country_id" required>
                                        <option value="">Select Country</option>
                                        @foreach (\App\Country::all() as $country)
                                        <option value="{{$country->id}}">
                                            {{$country->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="city" name="city_id" required>
                                        <option value="">City</option>
                                    </select>
                                    @error('city_id')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
          
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-round" type="submit">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</section>
@endsection


@section('vendor-script')
<!-- vendor files -->
@endsection
@section('page-script')
<script src="{{asset('port/assets/js/pages/charts/jquery-knob.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#country').on('change', function() {
            let country_id = this.value;
            $.ajax({
                url: "/country/" + country_id + "/cities",
                type: "GET",
                success: function(result) {
                    $("#city").empty();
                    $("#city").append('<option selected value="">Please select city</option>');
                    $.each(result, function(key, value) {
                        $("#city").append('<option value="' + key + '">' + value + '</option>');
                    });
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        });
    });
</script>
@endsection