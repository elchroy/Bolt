@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="user-mainbar">

                <div>
                    <div class="section-title" id="user-videos"><h2>{{ $title }}</h2></div>
                    <div class="row main-panel">
                        @foreach($videos as $video)
                            @include('videos.video-item')
                        @endforeach
                    </div>
                    {!! $videos->render() !!}
                </div>

        </div>
    </div>
</div>
@endsection