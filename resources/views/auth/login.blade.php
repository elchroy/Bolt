@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="section-title text-center">
            <h2>LOGIN</h2>
            <div class="divider"><i class="fa fa-sign-in fa-lg"></i></div>
        </div>


        <div class="row bolt-login">
            <div class="col-md-6 trad-login" id="trad-login">
                @include('auth.login-form')
            </div>
            <div class="col-md-6 social-login" id="social-login">
                @include('partials.social')
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}">