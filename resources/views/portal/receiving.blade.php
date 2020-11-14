@extends('portal.layouts.contentLayoutMaster2')

@section('title', 'Receiving')

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
                <h2>Receiving
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
                    <li class="breadcrumb-item active">Receiving</li>
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
                            <form class="row clearfix" method="post" action="{{route('receving.add')}}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('POST')

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" id="tobacco_product" name="tobacco_product_id" required>
                                            <option value="">Select Bale</option>
                                            @foreach (\App\tobaccoProduct::all() as $tobacco_product)
                                            <option value="{{$tobacco_product->id}}">
                                                {{$tobacco_product->bale_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="tobacco_product_id" value={{$tobacco_product->id ?? 0}}>

                                        @error('tobacco_product_id')
                                        <span class="small pl-3 text-danger font-weight-light" role="alert">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select" id="transport" name="transport_id" required>
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


                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-round">Receive</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about"><b>inventory Management</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane body active" id="about">
                        <small class="btn btn-info">Main Store Inventory </small>
                        <p></p>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
</section>



<div class="modal fade" id="receiveCreateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="receiveCreateModalLabel">Please confirm this</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('receving.add')}}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label type="text" class="form-control">
                            
                          <b>  100 kg of AA will be moved to the main store,proceed?
                              
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="reset" class="btn btn-danger ">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ">Receive
                        </button>
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