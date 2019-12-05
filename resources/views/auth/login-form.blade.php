<form class="login-form bolt-forms" id="login" role="form" method="POST" action={{ url('/login') }}>
{!! csrf_field() !!}
  <input type="email" name="email" placeholder="email" value="{{ old('email') }}"/>

  <input type="password" name="password" placeholder="password" value="{{ old('password') }}"/>
  
  <p class="message text-left">
    <input type="checkbox" name="remember">
    Remember Me
  </p>  
  <button>Login</button>
  <a href="{{ url('/password/reset') }}">Forgot Password?</a>
  <p class="message">Not registered? <a href="{{ url('/register') }}" for="register">Create an account</a></p>

</form>