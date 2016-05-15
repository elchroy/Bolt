<div class="form-group">
    <label class="control-label col-md-2 col-sm-12" for="title">Title:</label>
    <div class="col-md-10 col-sm-12">
        @if( Input::old('title') )
            <input class="" placeholder="E.g Introduction to JAVA" required name="title" type="text" id="title" value="{{ Input::old('title') }}">
        @elseif($video != null)
        	<input class="" placeholder="E.g Introduction to JAVA" required name="title" type="text" id="title" value="{{ $video->title }}">
        @else
            <input class="" placeholder="E.g Introduction to JAVA" required name="title" type="text" id="title" value="{{ Input::old('title') }}">
        @endif
    </div>
</div>