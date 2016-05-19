@extends('layouts.app')

@section('scripts')
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
            @if(Auth::guest())

                <div class="col-md-2 col-sm-2"></div>
                
                <div class="col-md-8 col-sm-8 login-form">
                    <div class="row" id="login-modes">
                        <div class="col-md-6 col-sm-12 login-modes" id="trad-login">
                            <div class="row">
                                <div class="col-md-12 bolt-home-form fadeIn animated" id="form-login">
                                    @include('auth.login-form')
                                    <a id="show-register">Do not have an account? Register</a>
                                </div>
                                <div class="col-md-12 bolt-home-form fadeIn animated" id="form-register" hidden>
                                    @include('auth.register-form')
                                    <a id="show-login">Have an account? Login</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 login-modes" id="social-login">
                            @include('partials.social')
                        </div>
                    </div>
                    <p><a href="#top-videos">Continue as guest...</a></p>
                </div>

                <div class="col-md-2 col-sm-2"></div>
            @endif
            
        </div>

    </div>
@endsection

@section('content')
<div class="container">
    <div class="row section-title text-center" id="top-videos"> <h2>Top Videos</h2>

        <div class="col-md-12">
            <div class="row">
                
                @foreach($recent as $video)
                    @include('videos.video-item')
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    
    .login-form {
        background: #312C32;
        padding: 70px 50px;
        border-radius: 4px;
    }

    .login-elements {
        border-radius: 3px;
        line-height: 30px;
        width: 100%;
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

<style type="text/css">

    
</style>