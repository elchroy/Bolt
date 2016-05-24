@extends('layouts.app')

@section('scripts')

    <script type="text/javascript" src="{{ asset('js/login-register.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            toggleDiv('show-register', 'form-register', 'bolt-home-form');
            toggleDiv('show-login', 'form-login', 'bolt-home-form');

            toggleDiv('show-page-1', 'page-1', 'bolt-home-page');
            toggleDiv('show-page-2', 'page-2', 'bolt-home-page');
        });
    </script>
@endsection

@section('welcome')
    <div class="container">
        
        <div class="row" style="background: rgba(255, 255, 255, 0.6)">
            <!-- <div class="col-md-4 col-sm- col-xs-12">
                <img src="{{ asset('uploads/bolt-logo.png') }}" class="img-responsive welcome-logo center-block">

                <div class="welcome-note bolt-div">

                    <p class="welcome-header">With Bolt</p>

                    <div class="welcome-body">
                        <p><i class="fa fa-check fa-lg"></i> Learning is fast</p>
                        <p><i class="fa fa-check fa-lg"></i> Learning is fun</p>
                        <p><i class="fa fa-check fa-lg"></i> You are in control </p>
                    </div>

                    <p>
                        <a href="#top-videos">
                            <button class="bolt-calling">
                                See Top Videos
                            </button>
                        </a>
                        <a href="#recent-videos">
                            <button class="bolt-calling">
                                Recent Videos
                            </button>
                        </a>o
                    </p>

                </div>
            </div> -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="welcome-note bolt-div bolt-form">

                    <p class="welcome-header">With Bolt</p>

                    <div class="welcome-body">
                        <p><i class="fa fa-check fa-lg"></i> Learning is fast</p>
                        <p><i class="fa fa-check fa-lg"></i> Learning is fun</p>
                        <p><i class="fa fa-check fa-lg"></i> You are in control </p>
                    </div>

                    <p>
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
            <div class="col-md-8 col-sm-8 col-xs-12">
                @if(Auth::guest())
                    <div class="bolt-form">
                        @include('auth.register-form')

                        @include('auth.login-form')

                        @include('partials.social')
                    </div>
                @else
                    <div class="bolt-form" style="background: transparent; padding: 0px; border:none;">
                    @include('videos.video-item', ['video' => $top])
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

            </div>
        </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
<style type="text/css">

    .bolt-form .register-form {
        display: none;
    }

    .bolt-form {
        /*max-width: 500px;*/
    }

    #most-liked {
        background: #B76868;
        border-radius: 3px;
        padding: 0 5px;
        color: #312C32;
        font-weight: bolder;
    }

    .welcome-logo {
        margin: 0 auto;
    }

    .welcome-note {
        padding: 20px;
        font-size: larger;
        font-weight: 300;
        background: #FFFFFF
    }

    .welcome-note p.welcome-header{
        background: #312C32;
        color: #fff;
        border-radius: 2px;
        padding: 10px;
        font-size: xx-large;
    }

    .welcome-note div.welcome-body{
        background: #FAFFBD ;
        padding: 10px;
    }

</style>
@endsection

@section('dcontent')
<div class="container">
    <div class="row bolt-home-page fadeInLeft animated" id="page-1">
        <div class="col-md-9 bolt-home-logo">
            <img class="img-responsive" src="{{ asset('uploads/banner.jpg') }}">
            <button class="bolt-button .button-half" id="show-page-2">Browse more videos</button>
        </div>
        @if(Auth::guest())
            <div class="col-md-3 bolt-home-main">
        
                <div class="bolt-home-forms">
                    <div class="bolt-home-form animated fadeInDown" style="display: block;" id="form-login">
                        <h3>Login</h3>
                        @include('auth.login-form')
                        <a id="show-register">Do not have an account? Register</a>
                    </div>
                    <div class="bolt-home-form animated fadeInUp" id="form-register">
                        <h3>Register</h3>
                        @include('auth.register-form')
                        <a id="show-login">Have an account? Login</a>
                    </div>
                </div>
                <div style="bottom: 0px; display: block;">
                    @include('partials.social')
                </div>
            </div>
        @endif
    </div>
    <div class="row bolt-home-page fadeInRight animated" id="page-2">

        @if(Auth::guest())
            <button class="bolt-button .button-half" id="show-page-1">Login or Register</button>
        @else
            <button class="bolt-button .button-full">Upload</button>
        @endif

        @foreach( Bolt\Video::latest()->take(12)->get()  as $video)
            @include('videos.video-item')
        @endforeach
    </div>
</div>
@endsection