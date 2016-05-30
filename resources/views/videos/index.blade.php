@extends('layouts.app')

@section('scripts')
                        
@endsection

@section('content')

        <div class=" row">
            <div class="col-md-2 col-sm-2 hidden-xs section-body" id="category-bar">

                <div class="list-group">
                    <div class="cat-list-item">Top Categories</div>
                        @foreach(Bolt\Category::hasVideo()->sortByDesc('videos')->take(10) as $cat)
                            <a href="{{ url('categories/' . $cat->id) }}" class="list-group-item truncate cat-list-item {{ ( isset($category) ) ? ($cat->id == $category->id ? 'active' : '') : '' }}">
                                <i class="devicon-{{ strtolower($cat->name) }}-plain colored"></i>
                                <span class="cat-name truncate">{{ $cat->name }}</span>
                                <span class="cat-video-num badge header-badge truncate pull-right" style="">{{ $cat->videos->count() }}
                            </a>
                        @endforeach
                    <a href="{{ url('categories') }}" class="list-group-item truncate cat-list-item" id="other-cats">
                        <i class="fa fa-tags fa-lg"></i>
                        <span class="cat-name truncate"> Other Categories </span>
                    </a>
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
        a.cat-list-item.active:hover,
        #other-cats:hover {
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

        span.cat-name {
            font-size: 80%;
            font-weight: bold;
        }

        span.cat-video-num {
            right: 10px;
            position:absolute;
            background:#312C32;
            color: #fff;
        }

        #other-cats {
            background: rgb(229, 154, 154);
            color: #312C32;
        }
    </style>    
@endsection