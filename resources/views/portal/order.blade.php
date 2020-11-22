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
             <div class="col-lg-7 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#ordersettings">New Order </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane  active" id="ordersettings">
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
                        <form class="row clearfix" action="{{route('order.create')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                            @method('POST')
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control"  readonly id="orderID" placeholder="Order ID" name="order_number" value="{{$order->order_number??old('order_number')}}">
                                    @error('order_number')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="farmer_id" name="farmer_id" required>
                                        <option value="">Select Customer</option>
                                        @foreach (\App\FarmerProfile::all() as $farmer)
                                        <option value="{{$farmer->id}}">
                                            {{$farmer->first_name}}  {{$farmer->first_name}}
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
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="product" name="product_id" required>
                                        <option value="">Select Product</option>
                                        @foreach (\App\Product::all() as $product)
                                        <option value="{{$product->id}}">
                                            {{$product->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="amount" name="amount" value="{{$order->amount??old('amount')}}">
                                    @error('amount')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="grade_id" name="grade_id" required>
                                        <option value="">Select Grade</option>
                                        @foreach (\App\Grade::all() as $grade)
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
                                    <input type="text" class="form-control" placeholder="processing parameters" name="params" value="{{$order->params??old('params')}}">
                                    @error('params')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="packaging" name="packaging" value="{{$order->packaging??old('packaging')}}">
                                    @error('packaging')
                                    <span class="small pl-3 text-danger font-weight-light" role="alert">
                                        <strong>{{$message}}.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <button class="btn btn-primary btn-round" type="submit">Create Order</button>
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
function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 10);
        n += randomNumber.toString();
    }
    return n;
}
document.getElementById("orderID").value = randomNumber(9);

</script>


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