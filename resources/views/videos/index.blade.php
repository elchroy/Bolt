@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        // keepSideBar("video-sorting");

    });
</script>
                        
@endsection

@section('content')

        <div class=" row">
            <div class="col-md-2 col-sm-2 hidden-xs section-body" id="category-bar">

                        <div class="list-group">
                            <!-- <a href="{{ url('videos') }}" class="list-group-item cat-list-item">All Videos</a> -->
                            <div class="cat-list-item">Categories</div>
                            <!-- <hr> -->

                            @foreach(Bolt\Category::all() as $cat)
                                <a href="{{ url('categories/' . $cat->id) }}" class="list-group-item truncate cat-list-item {{ $cat == $category ? 'active' : ''}}">
                                    <i class="fa fa-tags fa-lg"></i>
                                    <span class="cat-name truncate">{{ $cat->name }}</span>
                                    <span class="cat-video-num badge header-badge truncate pull-right" style="right: 10px; position:absolute; background:#312C32; color: #fff;">{{ $cat->videos->count() }}
                                </a>
                            @endforeach

                           <!--  @foreach(Bolt\Category::all() as $cat)

                                @if($cat == $category)
                                    <a href="{{ url('categories/' . $cat->id) }}" class="list-group-item truncate cat-list-item active">
                                        <span class="cat-icon">+</span>
                                        <span class="cat-video-num truncate">{{ $cat->videos->count() }}</span>
                                        <span class="cat-name truncate">{{ $cat->name }}</span>
                                    </a>
                                @else
                                    <a href="{{ url('categories/' . $cat->id) }}" class="list-group-item truncate cat-list-item">
                                        <span class="cat-icon">+</span>
                                        <span class="cat-video-num truncate">{{ $cat->videos->count() }}</span>
                                        <span class="cat-name truncate">{{ $cat->name }}</span>
                                    </a>
                                @endif

                            @endforeach -->
                        </div>
                        
            </div>

            <div class="col-md-10 col-sm-10 col-xs-12 section-body" id="user-mainbar">

                        <div class="video-group-title" id="user-videos"><h2>{{ $title }} <span class="badge header-badge">+</span></h2></div>
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
                                    </p>

                                    <p>
                                        <a class="link-info" href="{{ url('/videos') }}"> <button class="bolt-button">View Other Videos</button></a>
                                    </p>

                                </div>
                            @endif
                        </div>
                        <div class="pull-right">
                            {!! $paging !!}
                        </div>
            </div>
        </div>

@endsection


@section('styles')
    <style type="text/css">
        a.cat-list-item:hover,
        a.cat-list-item.active, 
        a.cat-list-item.active:hover {
            background: #C52020;
            color: #fff;
        }

        div.cat-list-item {
            line-height: 30px;
            padding: 10px 0;
            background: #312C32;
            color: #ffffff;
            font-weight: bolder;
            text-transform: uppercase;
            text-align: center;
            vertical-align: middle;
        }
    </style>    
@endsection