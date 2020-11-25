@extends('portal.layouts.contentLayoutMaster2')

@section('title', 'Add Farmer to Crop Year')

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
                <h2>Farmer Crop Years
                    <small>manage</small>
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
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Crop</strong> Year</h2>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane body active" id="about">

                            <div class="col-lg-12 col-md-12">
                                <h5 class="text-muted"> How it works</h5>
                                <hr>
                                <small class="text-muted"> 1. Search Farmer </small>
                                <hr>
                                <hr>
                                <small class="text-muted"> 2. Select crop Year</b> </small>
                                <hr>
                                <hr>
                                <small class="text-muted"> 3. Add </small>
                                <hr>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <!-- <div class="header">
                        <div class="col-lg-12 col-md-6">
                            <b> Crop Year </b> <label type="text" id="cropyearlabel"></label>
                        </div>
                    </div> -->

                    <hr>
                    <div class="header">
                        @if(session('success'))
                        <div class="col-lg-8 col-md-12"> <img style="width:50px;height:50px" src="/images/check.png"> <b>Farmer added to crop season succesfully</b></div>
                        @endif
                    </div>

                    <div class="header">
                        <div class="row">

                            <div class="col-lg-12 col-md-6">
                                <label class="header"><b>Search Farmer </b></label>
                                <form action="{{route('farmer.search.oncrop')}}" method="get">
                                    <div class="input-group">
                                        <input style="background: white;" type="text" name="term" class="form-control" placeholder="Search...">
                                        <span style="background: white;" class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <form class="row" action="{{route('farmer.add.cropyear')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('POST')
                                <div class="col-lg-9 col-md-12">
                                    @if(null !==($farmer))
                                    <div class="form-group">
                                        <label class="form-control"><span> <b> Full Names : </b></span> {{$farmer->first_name ?? ''}} {{$farmer->middle_name ?? '' }} {{$farmer->last_name ?? ''}} <br> <span> <b> Farmer No : </b>{{$farmer->number ?? ''}} </span> <br> <span> <b> Phone No: </b>{{$farmer->phone ?? ''}} </span> </label>
                                        @error('title')
                                        <span class="small pl-3 text-danger font-weight-light" role="alert">
                                            <strong>{{$message}}.</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @else

                                    @endif
                                </div>
                                <input type="hidden" name="farmer_id" value="{{$farmer->id ?? ''}}">
                                <div class="col-lg-12 col-md-12">
                                    <label class="header"><b>Select Crop Year</b> </label>
                                    <hr>
                                    <div class="form-group">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" id="cropyeardropdown" value="{{$farmer->cropyear_id??old('cropyear_id')}}" name="cropyear_id" required>
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
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <button style="width: 250px;" class="btn btn-info" type="submit" class="form-control"> add <span class="iconify" data-icon="zmdi:plus-square" data-inline="false"></span></span>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
                <!-- <div class="tab-content"> -->



                <!-- </div> -->
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h2><strong>Farmers </strong> in this Crop Year</h2>
            </div>
            <div class="body">

                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card product_item_list">
                                <div class="body table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Farmer Name</th>
                                                <th data-breakpoints="xs md">Number</th>
                                                <th data-breakpoints="xs md">ID Number</th>
                                                <!-- <th data-breakpoints="sm xs">Email</th>
                                                <th data-breakpoints="xs">Phone</th> -->
                                                <th data-breakpoints="xs md">Location</th>
                                                <th data-breakpoints="xs md">Crop Year</th>
                                                <!-- <th data-breakpoints="xs md">Status</th> -->
                                                <th data-breakpoints="xs md">Actions</th>

                                                <!-- <th data-breakpoints="sm xs md">Action</th> -->
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @if(null !==($farmers))

                                            @foreach($farmers as $farmer)


                                            <tr>

                                                <td>
                                                    <h5>{{$farmer->first_name}} {{ $farmer->middle_name }} {{ $farmer->last_name }} </h5>
                                                </td>
                                                <td>{{$farmer->number ?? 'No Number'}}</td>
                                                <td>{{$farmer->id_number ?? 'No id_number'}}</td>
                                                <!-- <td>{{$farmer->email ?? 'No Email' }}</td>
                                                <td>{{$farmer->phone ?? 'No phone'}}</td> -->

                                                <td>{{$farmer->city->name ?? 'No City'}}</td>
                                                <td>{{$farmer->cropyear->year ?? 'Not Assigned'}}</td>


                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-dark dropdown-toggle" type="button" aria-expanded="false">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li> <a href="{{ action('AdminController@editFarmer', $farmer->id) }}">Edit </li>
                                                            <li><a href="{{ action('AdminController@deleteFarmer', $farmer->id) }}">Delete</a> </li>

                                                        </ul>
                                                    </div>
                                                </td>


                                            </tr>
                                            @endforeach
                                            @else
                                            <h1>No Farmers Availabe</h1>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </form>
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
        $('#cropyeardropdown').on('change', function() {
            // console.log(this.value);
            // $("#cropyearlabel").val()  +=this.value;
            document.getElementById("cropyearlabel").innerText = this.value;
        });
    });
</script>
@endsection