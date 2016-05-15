<div class="form-group">
    <label class="control-label col-md-2 col-sm-12" for="Description">Description:</label>
    <div class="col-md-10 col-sm-12">
    	@if( Input::old('description') )
            <textarea class=" new-video-description" placeholder="Briefly describe the video resource" name="description" required maxlength="255" cols="50" rows="5">{{ Input::old('description') }}</textarea>
        @elseif($video != null)
        	<textarea class=" new-video-description" placeholder="Briefly describe the video resource" name="description" required maxlength="255" cols="50" rows="5">{{ $video->description }}</textarea>
        @else
            <textarea class=" new-video-description" placeholder="Briefly describe the video resource" name="description" required maxlength="255" cols="50" rows="5">{{ Input::old('description') }}</textarea>
        @endif
    </div>
</div>