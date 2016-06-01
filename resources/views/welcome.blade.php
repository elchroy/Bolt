@extends('layouts.app')

@section('scripts')

    <script type="text/javascript" src="{{ asset('js/login-register.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('h2.login>a').attr('href', function () {
                return '#to-welcome';
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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left hidden-xs">
                    <img src="{{ asset('uploads/big-logo.png') }}" class="img-responsive image">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 right">
                    <div class="title">
                        <h1>Learn with Bolt</h1>
                        <h2> <a href="#top-videos"> Browse to Videos </a> </h2>
                        @if(Auth::guest())
                            <h2 class="login"> <a href="{{ url('login') }}"> Login</a> </h2>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('welcome')
    <div class="container" id="to-welcome">
        
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 welcome-section">
                    <div class="welcome-note bolt-form">

                        <p class="welcome-header">With Bolt</p>

                        <div class="welcome-body">
                            <p><i class="fa fa-check fa-lg"></i> Learning is fast</p>
                            <p><i class="fa fa-check fa-lg"></i> Learning is fun</p>
                            <p><i class="fa fa-check fa-lg"></i> You are in control </p>
                        </div>

                        <p>`
                            <a href="#top-videos">
                                <button class="bolt-calling">
                                    See Top Videos
                                </button>
                            </a>
                            <a href="#recent-videos">
                                <button class="bolt-calling">
                                    Recent Videos
                                </button>
                            </a>
                        </p>

                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 welcome-section">
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
<div class="container">
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