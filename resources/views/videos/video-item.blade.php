  <div class="video-box">
     <a href="/videos/{{ $video->id }}">
        <img class="img-responsive video-image" src="{{ asset('img/bolt-icon.png') }}" sgrc="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">

        <div>

        <div class="video-info">
          @unless(Request::is('/'))
            <div class="info-left">
              <p class="video-time pull-right truncate">
                <span class="pull-left">{{ $video->created_at->diffForHumans() }}</span>
                @if(Auth::user())
                  @if(Auth::user()->owns($video))
                    <span> <a href="{{ url('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a></span>
                  @endif
                @endif
                <span class="pull-right"><i class="fa fa-heart"></i> {{ $video->favorites->count() }}</span>
              </p>
            </div>
          @endunless
          <div class="info-right"><p class="video-title pull-left text-left truncate">{{ $video->title }}</p></div>
        </div>

      </div>

      @unless(Request::is('/'))
         <div class="overlay">
            <a href="{{ url('/videos/' . $video->id) }}">
              <button class="bolt-calling video-controls"><i class="fa fa-play fa-lg"></i> Play</button>
            </a>

            <div class="overlay-info">
              <p class="truncate"> <em> {{ $video->user->name }} </em></p>
              <p class="truncate"> <em> {{ $video->category->name }} </em></p>
              <p class="truncate"> <em> 1:45:23 </em></p>
            </div>
        </div>
      @endunless
    </a>
  </div>
  <!-- <p class="video-handles"><a href="{{ url('/videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a></p> -->

