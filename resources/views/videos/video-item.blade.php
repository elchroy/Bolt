<div class="col-md-3 col-sm-6 col-xs-12 single-video {{ randomFader() }} animated" data-wow-duration="20000ms" data-wow-delay="900ms">
    
    <div class="single-video">
        <a href="/videos/{{ $video->id }}">
            <div class="video-box">
                <div class="overlay">
                    <button class="bolt-button button-half"><i class="fa fa-play fa-lg"></i> Play</button>
                    @if(Auth::user())
                        @if(Auth::user()->owns($video))
                          <button class="bolt-button button-half"><i class="fa fa-play fa-lg"></i> Edit</button>
                        @endif
                    @endif

                    <h4 class="vid-cat">{{ $video->title }}</h4>
                    <!-- <p class="vid-cat truncate">{{ $video->category->name }}</p> -->

                                    <!-- <li class="button-half"><i class="fa fa-twitter fa-lg"></i></li>
                                    <li class="button-half"><i class="fa fa-facebook fa-lg"></i></li>
                                    <li class="button-half"><i class="fa fa-google-plus fa-lg"></i></li> -->
                </div>
                <img class="video-image" src="{{ asset('uploads/def_profile.png') }}" srdc="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
                <p class="video-title truncate">{{ $video->title }}</p>
            </div>
        </a>
        <p class="video-handles"><a href="{{ url('/videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i> Edit</a></p>
    </div>
</div>

<style type="text/css">
  

.overlay {
    background-color: rgba(170, 137, 110, 0.78);
    text-align: center;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    
    opacity: 0;
    filter: alpha(opacity=0);
    
    -webkit-transition: all 450ms ease-out 0s;  
       -moz-transition: all 450ms ease-out 0s;
         -o-transition: all 450ms ease-out 0s;
            transition: all 450ms ease-out 0s;
          
    -webkit-transform: rotateY(180deg) scale(0.5,0.5);
       -moz-transform: rotateY(180deg) scale(0.5,0.5);
        -ms-transform: rotateY(180deg) scale(0.5,0.5);
         -o-transform: rotateY(180deg) scale(0.5,0.5);
            transform: rotateY(180deg) scale(0.5,0.5);
}

.video-box:hover .overlay {
    opacity: 1;
    filter: alpha(opacity=100);
    
    -webkit-transform: rotateY(0deg) scale(1,1);
       -moz-transform: rotateY(0deg) scale(1,1);
        -ms-transform: rotateY(0deg) scale(1,1);
         -o-transform: rotateY(0deg) scale(1,1);
            transform: rotateY(0deg) scale(1,1);
}
</style>

<!-- <style type="text/css">

    .single-video {
        border-radius: 2px;
        border: 1px solid rgba(5, 25, 26, 0.26); 
        background: rgba(237, 237, 238, 0.92);
    }

    .single-video a {
        display: block;
        width: 100%;
        background: #fff;   
        font-size: 120%;
    }

    .video-image {
        width: 100%;
    }



.overlay ul li {
  background-color: #0d7c67;
  color: #fff;
  display: inline-block;
  width: 30%;
}




.video-box {
    width: 100%;
    position: relative;
}

.video-box > img {
  display: block;
  height: auto;
}

.overlay {
    background-color: rgba(14,180,147,.5);
    text-align: center;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    color: #fff;
    
    opacity: 0;
    filter: alpha(opacity=0);
    
    -webkit-transition: all 450ms ease-out 0s;  
       -moz-transition: all 450ms ease-out 0s;
         -o-transition: all 450ms ease-out 0s;
            transition: all 450ms ease-out 0s;
          
    -webkit-transform: rotateY(180deg) scale(0.5,0.5);
       -moz-transform: rotateY(180deg) scale(0.5,0.5);
        -ms-transform: rotateY(180deg) scale(0.5,0.5);
         -o-transform: rotateY(180deg) scale(0.5,0.5);
            transform: rotateY(180deg) scale(0.5,0.5);
}

.video-box:hover .overlay {
    opacity: 1;
    filter: alpha(opacity=100);
    
    -webkit-transform: rotateY(0deg) scale(1,1);
       -moz-transform: rotateY(0deg) scale(1,1);
        -ms-transform: rotateY(0deg) scale(1,1);
         -o-transform: rotateY(0deg) scale(1,1);
            transform: rotateY(0deg) scale(1,1);
}

.video-box .overlay a {
  border: 1px solid #fff;
  display: inline-block;
  margin-top: 20%;
  padding: 7px 10px;
}

.video-box .overlay a:hover {
  color: #fff;
}

.video-box .overlay h4 {
  height: 20px;
  overflow: hidden;
  
}

.video-box .overlay p {
  font-size: 14px;
  line-height: 24px;
}

h4.truncate {
    white-space: nowrap;
    overflow: hidden;
}


</style> -->