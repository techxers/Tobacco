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
    <section class="content Buying-page">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Buying
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
                        <li class="breadcrumb-item active">Buying</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card Buying-header">
                       
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
              
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#usersettings">Bale receiving </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane  active" id="usersettings">
                       
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Bale</strong> Buying</h2>
                                </div>
                                <div class="body">
                                    <form class="row clearfix" action="{{route('buying.create')}}" method="post"
                                          enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('POST')
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Bale Label"
                                                       name="bale_name">
                                                @error('title')
                                                <span class="small pl-3 text-danger font-weight-light" role="alert">
                                                        <strong>{{$message}}.</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <select class="form-control show-tick ms select2"
                                                        data-placeholder="Select"
                                                        id="grade_id" name="grade_id" required>
                                                    <option value="">Select Grade</option>
                                                    @foreach (\App\Grade::all() as $grade )
                                                        <option value="{{$grade->id}}">
                                                            {{$grade->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('grade_id')
                                                <span class="small pl-3 text-danger font-weight-light" role="alert">
                                            {{$message}}
                                         </span>
                                                @enderror
                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Bale Unique ID"
                                                       name="unique_no">
                                                @error('unique_no')
                                                <span class="small pl-3 text-danger font-weight-light" role="alert">
                                                        <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <select class="form-control show-tick ms select2"
                                                        data-placeholder="Select"
                                                        id="farmer_profile_id" name="farmer_profile_id" required>
                                                    <option value="">Select Farmer</option>
                                                    @foreach (\App\FarmerProfile::all() as $farmer)
                                                        <option value="{{$farmer->id}}">
                                                            {{$farmer->full_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('farmer_profile_id')
                                                <span class="small pl-3 text-danger font-weight-light" role="alert">
                                            {{$message}}
                                         </span>
                                                @enderror
                                            </div>
                                        </div>
                                             
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <select class="form-control show-tick ms select2"
                                                        data-placeholder="Select"
                                                        id="transport" name="transport_id" required>
                                                    <option value="">Select Lorry</option>
                                                    @foreach (\App\Transport::all() as $transport)
                                                        <option value="{{$transport->id}}">
                                                            {{$transport->plate}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('transport_id')
                                                <span class="small pl-3 text-danger font-weight-light" role="alert">
                                            {{$message}}
                                         </span>
                                                @enderror
                                            </div>
                                        </div>
                                   
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Weight kgs"
                                                       name="weight">
                                                @error('weight')
                                                <span class="small pl-3 text-danger font-weight-light" role="alert">
                                                        <strong>{{$message}}.</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                         </div>
                                    
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-round" type="submit">Add Bale</button>
                                            <button class="btn btn-danger btn-round" type="submit">Close  </button>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about"><b>Manage inventories</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane body active" id="about">
                           
                                <p></p>
                                <hr>
                                <small class="text-muted">Bale: </small>
                                <p></p>
                                <hr>
                                <small class="text-muted">Lorry: </small>
                                <p></p>
                                <hr>
                                <small class="text-muted">Weight: </small>
                                <p class="m-b-0"> </p>
                                <br>
                                <small class="btn btn-dark" >Generate  delivery slip </small>
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
        $(document).ready(function () {
            $('#country').on('change', function () {
                let country_id = this.value;
                $.ajax({
                    url: "/country/" + country_id + "/cities",
                    type: "GET",
                    success: function (result) {
                        $("#city").empty();
                        $("#city").append('<option selected value="">Please select city</option>');
                        $.each(result, function (key, value) {
                            $("#city").append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            });
        });
    </script>
@endsection
