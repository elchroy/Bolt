<div class="form-group">
    <label class="control-label col-md-2 col-sm-12" for="url">URL:</label>
    <div class="col-md-10 col-sm-12">
    	@if( Input::old('url') )
            <input class="" required name="url" placeholder="E.g https://www.youtube.com/watch?v=yp_gH3zPfbo" type="url" id="url" value="{{ Input::old('url') }}">
        @elseif($video != null)
        	<input class="" required name="url" placeholder="E.g https://www.youtube.com/watch?v=yp_gH3zPfbo" type="url" id="url" value="{{ $video->url }}">
        @else
            <input class="" required name="url" placeholder="E.g https://www.youtube.com/watch?v=yp_gH3zPfbo" type="url" id="url" value="{{ Input::old('url') }}">
        @endif
    </div>
</div>