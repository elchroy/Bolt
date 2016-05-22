@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="video-group-title"> <h2>Reset Password</h2></div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal bolt-form" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> -->
                            <!-- <label class="col-md-4 control-label">E-Mail Address</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input type="email" class="" placeholder="email address" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        <!-- </div> -->

                                <button type="submit" class="">
                                    <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                </button>
                    </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style type="text/css">
        .bolt-form {
            /*width: 50%;*/
        }
    </style>
@endsection
