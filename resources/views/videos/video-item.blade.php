<div class="col-md-3 col-sm-6 col-xs-12 single-video">
    <a href="/videos/{{ $video->id }}">
        <div class="thumbnail">
            <img class="video-image" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
            <p class="video-title">{{ $video->title }}</p>
        </div>
    </a>
</div>