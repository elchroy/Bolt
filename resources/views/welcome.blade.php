@extends('layouts.app')

@section('scripts')

    <script type="text/javascript" src="{{ asset('js/login-register.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var login = $('.title>a#login');

            login.attr('href', function () {
                return '#to-welcome';
            });
        
            login.attr('id', function () {
                return 'to-login';
            });
        
            $('#to-login').click(function (e) {
                e.preventDefault();
                $('html,body').animate({
                  scrollTop: $('#to-welcome').offset().top - 70
                }, 1000);
            });
        
            toggleDiv('show-register', 'form-register', 'bolt-home-form');
            toggleDiv('show-login', 'form-login', 'bolt-home-form');

            toggleDiv('show-page-1', 'page-1', 'bolt-home-page');
            toggleDiv('show-page-2', 'page-2', 'bolt-home-page');
        });
    </script>
@endsection

@section('landing')
    
    <div class="hero clearfix">
    
        <div class="wrapperBeta clearfix">

            <div class="row landing">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right">
                    <div class="title">
                        <h1>Learn with Bolt</h1>
                        <a href="#top-videos" class="hidden-xs hidden-sm"><h2> Browse to videos </h2></a> 
                        <!-- <a href="#top-video" id="see-top" class="hidden-xs hidden-sm"><h2> <i class="fa fa-star"></i> </h2></a>  -->
                        <a href="{{ url('videos') }}" class="hidden-md hidden-lg"><h2> Browse to videos </h2></a> 
                        &nbsp;
                        @if(Auth::guest())
                           <a href="{{ url('login') }}" id="login" class="hidden-xs"> <h2 class="login"> Login </h2></a> 
                           <a href="{{ url('login') }}" class="hidden-sm hidden-md hidden-lg"> <h2 class="login"> Login </h2></a> 
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('welcome')
    <div class="container hidden-xs">
        
            <div class="row">
                
                <div class="col-md-12 col-sm-12 col-xs-12 welcome-section" id="to-welcome">
                    @if(Auth::guest())
                        <div class="bolt-form home-form">
                            @include('auth.register-form')

                            @include('auth.login-form')

                            @include('partials.social')
                        </div>
                    @else
                        <div class="hidden-xs hidden-sm" id="top-video">
                            <img src="{{ asset('uploads/monitor.png') }}" class="img-responsive monitor-frame">
                            <div class="img-responsive monitor-screen">
                                <div class="video-box" id="video-screen">
                                    <iframe id="video-frame" src="{{ $top->srcFrame() }}" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
        </div>
    </div>
@endsection

@section('content')
<div class="container hidden-xs">
        <div class="col-md-12">
            <div class="row">

                <div id="top-videos">
                    <h2 class="video-group-title">Top Videos</h2>
                    <hr />

                    <div class="trending-videos">
                        <div class="row">
                            @foreach($mostLikedVideos as $video)
                                 <div class="col-md-3 col-sm-4 col-xs-12">
                                    @include('videos.video-item')
                                </div>
                            @endforeach                 
                        </div>
                    </div>
                </div>

                <div id="recent-videos">
                    <h2 class="video-group-title">Most Recent Videos</h2>
                    <hr />

                    <div class="recent-videos">
                        <div class="row">
                            @foreach($recent as $video)
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    @include('videos.video-item')
                                </div>
                            @endforeach                  
                        </div>
                    </div>
                </div>

                <div class="bolt-div">
                    <a href="{{ url('/videos') }}"><button class="bolt-calling">Browse more videos</button></a>
                </div>

            </div>
        </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/home-page.css') }}">
@endsection