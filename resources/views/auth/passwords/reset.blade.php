@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="video-group-title"> <h2>Reset Password</h2> </div>
                    <form class=" bolt-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> -->
                            <!-- <label class="col-md-4 control-label">E-Mail Address</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input type="email" class="" placeholder="email" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        <!-- </div> -->

                        <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> -->
                            <!-- <label class="col-md-4 control-label">Password</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input type="password" class="" placeholder="password" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        <!-- </div> -->

                        <!-- <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"> -->
                            <!-- <label class="col-md-4 control-label">Confirm Password</label> -->
                            <!-- <div class="col-md-6"> -->
                                <input type="password" class="" placeholder="retype password" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        <!-- </div> -->

                        <!-- <div class="form-group"> -->
                            <!-- <div class="col-md-6 col-md-offset-4"> -->
                                <button type="submit" class="">
                                    <i class="fa fa-btn fa-refresh"></i>Reset Password
                                </button>
                            <!-- </div> -->
                        <!-- </div> -->
                    </form>
        </div>
    </div>
</div>
@endsection
