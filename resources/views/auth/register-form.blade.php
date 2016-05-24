<form class="register-form bolt-forms" id="register" role="form" method="POST" action={{ url('/register') }}>
            {!! csrf_field() !!}

  <input type="text" class="{{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder="name" value="{{ old('name') }}" />
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif

  <input type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" placeholder="email address" value="{{ old('email') }}"/>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif

  <input type="password" class="{{ $errors->has('password') ? ' has-error' : '' }}" name="password" placeholder="password" value="{{ old('password') }}"/>
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif

  <input type="password" class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" name="password_confirmation" placeholder="retype password" value="{{ old('password_confirmation') }}"/>
    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif

  <button>Register</button>
  <p class="message">Already registered? <a href="{{ url('login') }}" for="login">Sign In</a></p>
</form>