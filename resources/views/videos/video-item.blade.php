<div class="col-md-3 col-sm-6 col-xs-12 single-video {{ randomFader() }} animated">
  <div class="video-box">
     <a href="/videos/{{ $video->id }}">
        <img class="img-responsive video-image" src="{{ asset('uploads/def_profile.png') }}" srdc="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
      <p class="video-title text-left truncate">{{ $video->title }}</p>
     
       <div class="overlay">
          <a href="{{ url('/videos/' . $video->id) }}"><button class="bolt-button video-controls"><i class="fa fa-play fa-lg"></i> Play</button>
            <h4 class="vid-title truncate">{{ $video->title }}</h4></a>
            <h4 class="vid-likes"><i class="fa fa-heart"></i> {{ count($video->favorites()) }}</h4>
          </a>

          @if(Auth::user())
              @if(Auth::user()->owns($video))
                <a href="{{ url('/videos/' . $video->id . '/edit') }}"><button class="bolt-button video-controls"><i class="fa fa-edit fa-lg"></i> Edit</button></a>
              @endif
          @endif
      </div>
    </a>

    
  </div>
  <!-- <p class="video-handles"><a href="{{ url('/videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a></p> -->
</div>

