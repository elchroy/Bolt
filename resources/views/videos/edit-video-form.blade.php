<form method="POST" action="/videos/{{ $video->id }}/update" accept-charset="UTF-8" class="form-horizontal edit-video-form bolt-form" role="form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
        
        @if (count($errors) > 0)
            @include('videos.video-errors')
        @endif

        @include('videos.title-field', ['video' => $video])
        
        @include('videos.url-field', ['video' => $video])        
                
        @include('videos.description-field', ['video' => $video])
                
        @include('videos.category-field', ['video' => $video])

        <button type="submit" class="bolt-button button-half pull-right">Save</button>
</form>