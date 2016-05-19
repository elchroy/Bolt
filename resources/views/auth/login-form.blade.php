<form class="form-horizontal" id="login-form" role="form" method="POST" action={{ url('/login') }}>
    {!! csrf_field() !!}
    
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
    

    <div class="{{ $errors->has('remember') ? ' has-error' : '' }}">
        <p><input type="checkbox" name="remember"> Remember Me</p>
    </div>
    
    
    <button type="submit" class="bolt-button pull-right">
        <i class="fa fa-btn fa-sign-in fa-lg"></i>Login
    </button>

    <p><a href="{{ url('/password/reset') }}">Forgot Your Password?</a></p>
    
    

</form>

<link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}">



<style type="text/css">
    .input-section {
        padding: 10px 0px;
    }
</style>