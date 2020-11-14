@extends('layouts/contentLayoutMaster')

@section('title', 'Welcome to ')

@section('vendor-style')
    <!-- Vendor css files -->
@endsection
@section('page-style')
    <!-- Page css files -->
    <style>
        .icon-bg {/*
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
           padding: 4em 1em!important;
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
    <section class="header-video" style="background-color: #197a01;">
        
        <div id="hero_video">
            <div id="sub_content">
                <h2 style="color:white">Welcome to Leaf</h2>
                <!-- <p style="font-weight: 200!important;margin-top: 2em">
                 or browse restaurants
                </p> -->
                <div id="form-group">
                <img id="logo_img1" src="{{asset('images/logo/leaf.jpg')}}" width="auto" height="100" alt="" data-retina="true" class="hidden-xs" style="padding-bottom: 10px!important;">

                <div>
            
       
                   

        <a href=""  data-toggle="modal" data-target="#login_2" id="openDiagLogin" class="button_intro outline">Login</a>
      </div>
            </div>
            <!-- End sub_content -->
         
       
        </div>
        <img src="{{asset('landing/img/landing1.jpg')}}" alt="" class="header-video--media"
             data-provider="Vimeo" data-video-width="1920" data-video-height="960">
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
        $(document).ready(function () {
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


