<form method="POST" action="/videos/add" accept-charset="UTF-8" class="form-horizontal add-video-form" role="form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
        
        @if (count($errors) > 0)
           @include('videos.video-errors')
        @else
            <div class="alert alert-info">
                <p class="alert-info text-center"> Note: All fields are required.</p>
            </div>
        @endif

        @include('videos.title-field', ['video' => null])
        
        @include('videos.url-field', ['video' => null])
        
        @include('videos.description-field', ['video' => null])
        
        @include('videos.category-field', ['video' => null])

        <button type="submit" class="bolt-button">Add</button>

</form>