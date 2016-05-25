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
        
        <div class="row">
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
                    <div class="bolt-form" id="top-video">
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

                <div class="pull-right bolt-div">
                    <a href="{{ url('/videos') }}"><button class="bolt-calling button-half">Browse more videos</button></a>
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

    .bolt-form#top-video {
        background: transparent;
        padding: 0px;
        border:none;
        border-radius: 5px;
    }

    .bolt-form#top-video .video-box {
        background: transparent;
        padding: 0px;
        border:none;
    }

    .bolt-form#top-video .video-box a {
        margin: 0px;
    }

    .bolt-form#top-video .video-box a p {
        background: rgba(192, 32, 32, 0.7);
        line-height: 50px;
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