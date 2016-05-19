<form class="form-horizontal" role="form" method="POST" action={{ url('/register') }}>
    {!! csrf_field() !!}

    <div class="input-section {{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="">Name</label>
            <input type="text" class="login-elements" name="name" value="{{ old('name') }}">
            
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
    </div>
    
    <div class="input-section {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="">Email</label>
        <input type="email" class="login-elements" name="email">
        
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="input-section {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="">Password</label>
        <input type="password" class="login-elements" name="password">
        

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>


    <div class="input-section {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="">Confirm Password</label>
        <input type="password" class="login-elements" name="password_confirmation">
        

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

<link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}">

<style type="text/css">
    

    .input-section {
        padding: 5px 0px;
    }


</style>