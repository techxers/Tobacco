@extends('layouts/contentLayoutMaster')

@section('title', 'Welcome to ')

@section('vendor-style')
<!-- Vendor css files -->
@endsection
@section('page-style')
<!-- Page css files -->
<style>
    .icon-bg {
        /*
            background: #00bfff;
            width: 60px;
            height: 60px;
            text-align: center;
            line-height: 57px;
            border-radius: 50%;
            color: #fff;
            font-size: 32px;
            */
    }

    .media .media-body {
        padding: 4em 1em !important;
        border: 1px solid rgba(128, 128, 128, 0.09);
    }

    .w3-text-shadow {
        text-shadow: 1px 1px 0 #444
    }

    .w3-text-shadow-white {
        text-shadow: 1px 1px 0 #ddd
    }
</style>
@endsection
@section('content')
<!-- SubHeader =============================================== -->
<section class="header-video" style="background-color: #197a01;;">

    <div id="hero_video">
        <div id="sub_content">


            <div id="hero_video">
                @guest
                <form action="{{route('login')}}" method="POST" class="popup-form" id="myLogin" name="loginForm">
                    @csrf
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <input type="email" class="form-control form-white" name="email" placeholder="Email address" required>
                    <input type="password" class="form-control form-white" name="password" placeholder="Password" required>
                    <div class="text-left">
                        <ul>
                            <li> <a href="#" data-toggle="modal" data-target="#register">Register </a></li>
                            <li> <a href="#">Forgot Password?</a></li>
                        </ul>



                    </div>
                    <button type="submit" class="btn btn-submit">Submit</button>
                    <div class="text-danger mt-1 alert-validation-msg animate__animated animate__wobble" role="alert" style="opacity: 1;margin-top: 1em!important;display: none" id="loginAlert">
                        <i class="icon_error-oct_alt mr-1 align-middle" style="color: white"></i>
                        <span class="" style="color: lightgray!important;">Either the username or password is incorrect</span>
                    </div>
                </form>

                @else

                @endguest

            </div>
        </div>
    </div>


    <!-- End sub_content -->


    </div>
    <img src="{{asset('landing/img/landing1.jpg')}}" alt="" class="header-video--media" data-provider="Vimeo" data-video-width="1920" data-video-height="960">
    <div id="count" class="hidden-xs">

    </div>
</section>
<!-- End Header video -->
<!-- End SubHeader ============================================ -->

<!-- Content ================================================== -->

@endsection

@section('vendor-script')
<!-- Vendor js files -->

@endsection
@section('page-script')
<!-- Page js files -->
<!-- SPECIFIC SCRIPTS -->
<script src="{{asset('landing/js/video_header.js')}}"></script>
<script>
    $(document).ready(function() {
        'use strict';
        HeaderVideo.init({
            container: $('.header-video'),
            header: $('.header-video--media'),
            videoTrigger: $("#video-trigger"),
            autoPlayVideo: true
        });

    });
</script>
<script>
    function windowLoaded() {

    }
</script>
@endsection