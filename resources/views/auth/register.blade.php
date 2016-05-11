@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="section-title text-center">
            <h2>Register</h2>
            <div class="divider"><i class="fa fa-user fa-lg"></i></div>
        </div>


        <div class="row bolt-login">
            <div class="col-md-6 trad-register" id="trad-register">
                <form class="form-horizontal" role="form" method="POST" action={{ url('/register') }}>
                    {!! csrf_field() !!}

                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" class="" name="name" value="{{ old('name') }}">
                            <label class="">Name</label>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>
                    
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

                    <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" class="" name="password_confirmation">
                        <label class="">Confirm Password</label>
                        

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="bolt-button pull-right">
                        <i class="fa fa-btn fa-user fa-lg"></i>Register
                    </button>
                    

                </form>
            </div>
            <div class="col-md-6 social-login" id="social-login">
                @include('partials.social')
            </div>
        </div>
    </div>
@endsection
<link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}">

@section('page')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                    
                                <button type="submit" class="bolt-button pull-right">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
