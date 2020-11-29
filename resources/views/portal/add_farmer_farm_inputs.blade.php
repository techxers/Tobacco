@extends('portal.layouts.contentLayoutMaster2')

@section('title', 'Add Farm input to Farmer')

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
                <h2>Farmer Farm Inputs
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
                                <h5 class="text"> How it works</h5>

                                <hr>
                                <small class="text"> 1. Search Farmer </small>
                                <hr>

                                <small class="text"> 2. Select Farm Input</b> </small>
                                <hr>

                                <small class="text"> 3. Add Input to Farmer </small>
                                <hr>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">

                            <div class="col-lg-12 col-md-6">
                                <label class="header"><b>Search Farmer </b></label>
                                <form action="{{route('farmer.search.onfarmInput')}}" method="get">
                                    <div class="input-group">
                                        <input style="background: white;" type="text" name="term" class="form-control" placeholder="Search...">
                                        <span style="background: white;" class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                                    </div>
                                </form>
                            </div>
                            <form class="row" action="{{route('add.farmer.inputs')}}" method="post" enctype="multipart/form-data" autocomplete="off">
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
                                    <label class="header"><b>Select Farm Input</b> </label>
                                    <hr>
                                    <div>
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" id="farminputdropdown" value="" name="farm_input_id" required>
                                            <option value="">Select Farm Input</option>
                                            @foreach (\App\FarmInput::all() as $input)
                                            <option value="{{$input->id}}">
                                                {{$input->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('farm_input_id')
                                        <span class="small pl-3 text-danger font-weight-light" role="alert">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <div class="col-12 col-md-6">
                                        <label> <b>Issue Date </label>
                                        <div class="form-group">
                                            <input type="date" id="issue_date" name="issued_date" value="2020-01-01">
                                            @error('issue_date')
                                            <span class="small pl-3 text-danger font-weight-light" role="alert">
                                                <strong>{{$message}}.</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label> <b>Comments </label>
                                            <input type="text" class="form-control" placeholder="Any Comments" name="description">
                                            @error('name')
                                            <span class="small pl-3 text-danger font-weight-light" role="alert">
                                                <strong>{{$message}}.</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="body">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <button style="width: 250px;" class="btn btn-info" type="submit" class="form-control"> add <span class="iconify" data-icon="zmdi:plus-square" data-inline="false"></span></span>
                                                </button>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <form method="get" action="/admin/manage/users">
                                                    <button style="width: 250px;" class="btn btn-danger" type="submit" class="form-control"> exit <span class="iconify" data-icon="zmdi:plus-square" data-inline="false"></span></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
                <h2><strong>Farm Inputs </strong> Issued</h2>
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

                                                <th data-breakpoints="xs md">Farmer</th>
                                                <th data-breakpoints="xs md">Farm  Input</th>
                                                <th data-breakpoints="xs md">Issued Date</th>
                                                <th data-breakpoints="xs md">Status </th>
                                                <th data-breakpoints="xs md">Description</th>
                                                <th data-breakpoints="xs md">Action</th>


                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @if(null !==($inputs))

                                            @foreach($inputs as $input)


                                            <tr>

                                                <td>{{$input->farmer_profiles_id}}</td>
                                                <td>{{$input->farm_inputs_id}}</td>
                                                <td>{{$input->issued_date}}</td>
                                                <td>{{$input->status}}</td>
                                                <td>{{$input->description}}</td>


                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-dark dropdown-toggle" type="button" aria-expanded="false">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="{{ action('AdminController@deleteFarmerInput', $input->id) }}">Delete</a> </li>

                                                        </ul>
                                                    </div>
                                                </td>


                                            </tr>
                                            @endforeach
                                            @else
                                            <h5>No Farm Inputs</h5>
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