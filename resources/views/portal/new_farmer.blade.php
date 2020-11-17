@extends('portal.layouts.contentLayoutMaster2')

@section('title', 'Add New')

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
                    <small>tobacco</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index-2.html"><i class="zmdi zmdi-home"></i> Leaf</a>
                    </li>
                    <li class="breadcrumb-item active">Add New</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card profile-header">
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="profile-image float-md-right"><img src="" alt=""></div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-12">
                                <h4 class="m-t-0 m-b-0"><strong>Add a new Farmer</strong></h4>
                                <span class="job_post"></span>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
           
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#usersettings">Setting</a>
                     
                    </li>
                 
                    @isset($message)
                    <button class="btn btn-info btn-round">{{$message ?? ''}} </button>
                    @endisset

                 
                    </ul>
                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane  active" id="usersettings">
                        {{--
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Security</strong> Farmer Settings</h2>
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
                        <h2><strong>Farmer</strong> Settings</h2>
                    </div>
                    <div class="body">
                        <form class="row clearfix" action="{{route('farmer.add')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name"  value="{{$farmer->first_name??old('first_name')}}">
                                    @error('title')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Middle Name" name="middle_name"  value="{{$farmer->middle_name??old('middle_name')}}">
                                    @error('title')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{$farmer->last_name??old('last_name')}}">
                                    @error('title')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="email" name="email"  value="{{$farmer->email??old('email')}}">
                                    @error('email')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Id no" name="id_number" value="{{$farmer->id_number??old('id_number')}}">
                                    @error('id_number')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="address" name="address" value="{{$farmer->address??old('address')}}">
                                    @error('address')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="phone" name="phone" value="{{$farmer->phone??old('phone')}}">
                                    @error('phone')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="country" name="country_id" required value="{{$farmer->country_id??old('country_id')}}">
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
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="city" value="{{$farmer->city_id??old('city_id')}}" name="city_id" required>
                                        <option value="">City</option>
                                    </select>
                                    @error('city_id')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="region" value="{{$farmer->region_id??old('region_id')}}" name="region_id" required>
                                        <option value="">Select Region</option>
                                        @foreach (\App\Region::all() as $region)
                                        <option value="{{$region->id}}">
                                            {{$region->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('region')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                            <select class="form-control show-tick ms select2" data-placeholder="Select" id="cropyear"  value="{{$farmer->cropyear_id??old('cropyear_id')}}" name="cropyear_id" required>
                                        <option value="">Select Crop Year</option>
                                        @foreach (\App\CropYear::all() as $cropyear)
                                        <option value="{{$cropyear->id}}">
                                            {{$cropyear->year}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('region')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                            
                            </div>


                            <!-- <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="file" class="form-control" placeholder="logo" name="logo">
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-round" type="submit">add new</button>
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