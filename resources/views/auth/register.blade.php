@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bolt-login">
            <div class="col-md-12 trad-register" id="trad-register">
                <div class="bolt-form">
                    @if (count($errors) > 0)
                       @include('videos.video-errors')
                    @endif
                    
                    @include('auth.login-form')

                    @include('auth.register-form')

                    @include('partials.social')
                </div>
                    
            </div>
        </div>
    </div>
@endsection



@section('scripts')
<script type="text/javascript" src="{{ asset('js/login-register.js') }}"></script>
<script type="text/javascript">
    $('.register-form button').click( function () {
        {!! count($errors) > 0 ? '$(".message a[for=register]").trigger("click");' : '' !!}
    });
</script>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);
    .bolt-form {
        max-width: 500px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .bolt-form .register-form {
        display: block;
    }
    .bolt-form .login-form {
        display: none;
    }
</style>
@endsection