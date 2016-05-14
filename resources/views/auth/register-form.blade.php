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