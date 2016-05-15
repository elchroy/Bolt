<form method="POST" action="{{ url('videos/' . $video->id . '/delete') }}">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="delete">
        <div class="alert alert-warning">Are you sure you want to delete <h6 class="">'{{$video->title}}'?</h6>
        <button class="bolt-button button-half pull-right" type="submit" id="submit-delete-form"><i class="fa fa-lg fa-tick"></i> Confirm</button>
        <!-- <button class="bolt-button button-half pull-left" type="button" id="cancel-delete-form"><i class="fa fa-lg fa-bad"></i> Cancel</button> -->
        </div>
</form>