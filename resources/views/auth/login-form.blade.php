

        <div class="bolt-form">

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



            <form class="login-form bolt-forms" id="login" role="form" method="POST" action={{ url('/login') }}>
            {!! csrf_field() !!}
              <input type="email" name="email" placeholder="email" value="{{ old('email') }}"/>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

              <input type="password" name="password" placeholder="password" value="{{ old('password') }}"/>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              
              <p class="message text-left">
                <input type="checkbox" name="remember">
                Remember Me
              </p>  
              <button>Login</button>
              <a href="{{ url('/password/reset') }}">Forgot Password?</a>
              <p class="message">Not registered? <a href="{{ url('login') }}" for="register">Create an account</a></p>

            </form>

            <a href="{{url('auth', ['link' => 'facebook'])}}" class="bolt-link btn-facebook">
                <button class="bolt-button bolt-social">
                    <i class="fa fa-facebook fa-lg button-icon"></i> Facebook
                </button>
            </a>
            <a href="{{url('auth', ['link' => 'twitter'])}}" class="bolt-link btn-twitter">
                <button class="bolt-button bolt-social">
                    <i class="fa fa-twitter fa-lg button-icon"></i> twitter
                </button>
            </a>
            <a href="{{url('auth', ['link' => 'github'])}}" class="bolt-link btn-github">
                <button class="bolt-button bolt-social">
                    <i class="fa fa-github fa-lg button-icon"></i> github
                </button>
            </a>

</div>


<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
  <style type="text/css">
      @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    
  </style>


  <!-- <form class="form-horizontal" id="login-form" role="form" method="POST" action={{ url('/login') }}>
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

<link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}"> -->