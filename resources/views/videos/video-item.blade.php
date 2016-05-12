<div class="col-md-3 col-sm-6 col-xs-12 single-video">
    <a href="/videos/{{ $video->id }}">
        <div class="thumbnail">
            <img class="video-image" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
            <p class="video-title">{{ $video->title }}</p>
        </div>
    </a>
</div>

<style type="text/css">

    .single-video {
        background: rgb(225, 228, 229);
        padding: 1px;
        margin: 0px;
        border-radius: 3px;
        max-height: 100vh;
    }

    .video-image {
        width: 100%;
    }
</style>