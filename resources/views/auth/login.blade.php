@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="section-title text-center">
            <h2>LOGIN</h2>
            <div class="divider"><i class="fa fa-sign-in fa-lg"></i></div>
        </div>


        <div class="row bolt-login">
            <div class="col-md-6 trad-login" id="trad-login">
                <form class="form-horizontal" role="form" method="POST" action={{ url('/login') }}>
                    {!! csrf_field() !!}
                    
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="" name="email">
                        <label class="">Email</label>
                        
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="" name="password">
                        <label class="">Password</label>
                        

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                    <div class="{{ $errors->has('remember') ? ' has-error' : '' }}">
                        <input type="checkbox" name="remember"> Remember Me
                    </div>
                    <a class="pull-right" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    
                    <button type="submit" class="bolt-button pull-right">
                        <i class="fa fa-btn fa-sign-in fa-lg"></i>Login
                    </button>

                    <a class="pull-right" href="{{ url('/register') }}">Register</a>
                    
                    

                </form>
            </div>
            <div class="col-md-6 social-login" id="social-login">
                @include('partials.social')
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}">