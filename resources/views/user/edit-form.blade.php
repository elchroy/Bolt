<form class="bolt-form" role="form" method="POST" action="{{ url('/profile/update') }}">
    {!! csrf_field() !!}

    <input type="text" class="" name="name" value="{{ $user->name }}">

    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
    <input type="email" class="" name="email" value="{{ $user->email }}">

    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <button type="submit" class="bolt-button">
        <i class="fa fa-btn fa-user"></i>Update
    </button>
</form>