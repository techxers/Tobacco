@extends('layouts/contentLayoutMaster')

@section('title', 'Reset Password')

@section('vendor-style')
    <!-- Vendor css files -->
@endsection
@section('page-style')
    <!-- Page css files -->
@endsection
@section('content')
    <!-- Full Background BG
        ============================================= -->
    <section class="login-full dark clearfix" >
        <!-- Bg Full Bg -->
        <div class="fullheight full-bg background40">
            <div class="bg-transparent">
                <!-- Slider content -->
                <div class="slider-content">
                    <h1>Reset Password</h1>
                    <span class="welcome ">Enter email to continue</span>
                    <div class="form-group padding-45">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                            <label for="email" class="" style="display: none">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror


                            <button type="submit" class="btn form-control btn-white"> {{ __('Send Password Reset Link') }}</button>
                        </form>
                    </div>
                </div>
                <!-- End Slider content -->
            </div>
            <!-- End Bg Transparent -->
        </div>
        <!-- End Full Bg -->
    </section>
    <!-- End Full Screen BG -->
@endsection

@section('vendor-script')
    <!-- Vendor js files -->

@endsection
@section('page-script')
    <!-- Page js files -->

@endsection


