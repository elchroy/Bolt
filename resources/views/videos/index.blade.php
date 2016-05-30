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
                    <div class="cat-list-item">Top Categories</div>
                    @foreach(Bolt\Category::hasVideo()->sortBy('name') as $cat)
                        <a href="{{ url('categories/' . $cat->id) }}" class="list-group-item truncate cat-list-item {{ ( isset($category) ) ? ($cat->id == $category->id ? 'active' : '') : '' }}">
                            <i class="fa fa-tags fa-lg"></i>
                            <span class="cat-name truncate">{{ $cat->name }}</span>
                            <span class="cat-video-num badge header-badge truncate pull-right" style="right: 10px; position:absolute; background:#312C32; color: #fff;">{{ $cat->videos->count() }}
                        </a>
                    @endforeach
                </div>
                        
            </div>

            <div class="col-md-10 col-sm-10 col-xs-12 section-body" id="user-mainbar">
                @include('videos.listing')
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