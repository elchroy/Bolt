@if (count($errors) > 0)
    @include('partials.errors')
@endif

{!! csrf_field() !!}

<input type="text" required maxlength="50" value="{{ $category->name or Input::old('name') }}" name="name" placeholder="name of category.">

<textarea required maxlength="255" placeholder="brief description of this category" name="brief">{{ $category->brief or Input::old('brief') }}</textarea>