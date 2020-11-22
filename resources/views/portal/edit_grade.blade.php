@extends('portal.layouts.contentLayoutMaster2')

@section('title', 'Edit Grade')

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
                <h2>Edit Grade
                    <small>Update</small>
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
                                <h4 class="m-t-0 m-b-0"><strong>Edit Grade</strong></h4>
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
                        <li class="nav-item"><a class="nav-link active" data-toggle="modal" data-target="#menuAddModal">Upload Excel</a>
                        </li>
                        @isset($message)
                        <button class="btn btn-info btn-round">{{$message ?? ''}} </button>
                        @endisset
                    </ul>
                </div>

                <div class="card">
                    <div class="header">
                        <h2><strong>Grade</strong> Settings</h2>
                    </div>
                    <div class="body">
                        <form class="row clearfix" action="{{route('grade.update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="col-lg-4 col-md-12">
                            <input type="hidden" name="id" value="{{$grade->id??old('id')}}">

                            <label >Grade Name</label>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Grade Name" name="name" value="{{$grade->name??old('name')}}">
                                    @error('title')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                            <label >Grade Number</label>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Grade Number" name="number" value="{{$grade->number??old('number')}}">
                                    @error('title')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                            <label >Tobacco Type Number</label>

                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="tobacco_id" name="tobacco_id" required>
                                        <option value="">--Select the order status--</option>
                                        @foreach(\App\tobacco::all() as $tobacco)
                                        <option selected selected value="{{$grade->tobacco_id}}">{{$grade->number}}</option>
                                        @endforeach

                                    </select>
                                    @error('status')
                                    <span class="text-danger pl-1 small" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">Update
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
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