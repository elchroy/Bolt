<div>

    <div class="video-group-title" id="user-videos"><h2>{{ $title }}</h2></div>

    <hr>
    <div class="row main-panel">
        @if( count($videos) )
            @foreach($videos as $video)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    @include('videos.video-item')
                </div>
            @endforeach
        @else
            <div class="bolt-div">
                <h2 class="s">Sorry. There are no videos available. </h2>

                <p>
                    <a class="link-info" href="{{ url('videos/add') }}"> <button class="bolt-calling">Upload</button></a>
                    <a class="link-info" href="{{ url('/videos') }}"> <button class="bolt-button">View Other Videos</button></a>
                </p>

            </div>
        @endif
    </div>

    <div class="pull-right">
        {!! $paging !!}
    </div>

</div>  