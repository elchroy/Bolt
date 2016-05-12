<form class="" role="form" method="POST" action="{{ url('/profile/update') }}">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <!-- <label class="col-md-4 control-label">Name</label> -->
        <input type="text" class="" name="name" value="{{ $user->name }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <!-- <label class="col-md-4 control-label">E-Mail Address</label> -->
        <input type="email" class="" name="email" value="{{ $user->email }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="bolt-button">
            <i class="fa fa-btn fa-user"></i>Update
        </button>
    </div>
</form>