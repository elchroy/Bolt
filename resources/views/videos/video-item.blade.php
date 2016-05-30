  <div class="video-box" title="{{ $video->title }}">
    <div>
      <img class="img-responsive video-image" srcd="{{ asset('uploads/def_pr') }}" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
      <div class="video-info">
        <p class="video-details">
            <span class="pull-left video-likes"><i class="fa fa-heart"></i> {{ $video->favorites->count() }}</span>
            <span class="pull-right video-time truncate">{{ $video->created_at->diffForHumans() }}</span>
        </p>

        <a href="/videos/{{ $video->id }}"><p class="truncate video-title">{{ $video->title }}</p></a>
      </div>
    </div>
    <div class="overlay">
      <a href="/videos/{{ $video->id }}">
        <button class="bolt-calling"><i class="fa fa-play fa-lg"></i> Play</button>
      </a>
    </div>
  </div>