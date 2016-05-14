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

@section('content')
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

    body {
        /*background: url({{ asset('uploads/bolt.png') }}) no-repeat center top fixed;*/
    }

    .bolt-home-main {
        background: transparent;
        padding: 20px;
        border-radius: 10px;
        margin: 5% 0;
    }

    .bolt-home-form,
    .bolt-home-page {
        display: none;
        position: static;
    }

    .bolt-home-forms {
        /*min-height: 30px;*/
    }

    #form-login,
    #page-1 {
        display: block;
    }

    #show-login,
    #show-register {
        cursor: pointer;
        font-size: 150%;
    }
</style>
