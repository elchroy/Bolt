<form class="bolt-form" method="POST" action="{{ url('videos/' . $video->id . '/delete') }}">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="delete">
        <div class="actions alert alert-warning">
        	<h6 class="">'{{$video->title}}'</h6>
        	<p class="actions"> Delete ?</p>
	        <button class="cancel close-delete-forms" for="delete-video-form-{{ $video->id }}" id="close-delete-form-{{$video->id}}">&times; No</button>
	        <button class="confirm" type="submit" id="submit-delete-form" >&check; Yes</button>
        </div>
</form>