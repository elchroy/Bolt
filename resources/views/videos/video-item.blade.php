  <div class="video-box">
     <a href="/videos/{{ $video->id }}">
        <img class="img-responsive video-image" sdrc="{{ asset('uploads/def_profile.png') }}" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">

        <div>
      <!-- <p class="video-time pull-right truncate"> 1:45:00</p> -->
        <p class="video-title pull-left text-left truncate">{{ $video->title }}</p>
      </div>

       <div class="overlay">
          <a href="{{ url('/videos/' . $video->id) }}">
            <!-- <h4 class="vid-title">{{ $video->title }}</h4></a> -->
            <h4 class="vid-likes"><i class="fa fa-heart"></i> {{ $video->favorites->count() }}</h4>
            <button class="bolt-calling video-controls"><i class="fa fa-play fa-lg"></i> Play</button>
            <!-- <p class="text-left truncate">{{ $video->category->name }}</p> -->
            <!-- <p class="text-left truncate">{{ $video->user->name }}</p> -->
            <!-- <p class="text-left truncate">{{ $video->category->name }}</p> -->
          </a>
      </div>
    </a>
  </div>
  <!-- <p class="video-handles"><a href="{{ url('/videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a></p> -->

