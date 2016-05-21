@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row bolt-login">
            <div class="col-md-12 trad-login" id="trad-login">
                @include('auth.login-form')
            </div>
        </div>
    </div>
@endsection



@section('scripts')
<script type="text/javascript" src="{{ asset('js/login-register.js') }}"></script>
@endsection

