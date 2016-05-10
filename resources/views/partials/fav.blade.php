<form method="POST" action="/{{ $model }}/{{ $id }}/{{ $action }}">
    <button type="submit">{{ $button }}</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>