@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        // keepSideBar("user-sidebar");
        toggleDiv("add-new-video-button", "add-video-form", "video-forms", 600);
        toggleDiv("edit-profile", "edit-profile-form", "sideforms", 600);
        toggleDiv("change-avatar", "change-avatar-form", "sideforms", 600);
        
        {!! count($errors) > 0 ? '$("#add-new-video-button").trigger("click");' : '' !!}

    });
</script>
                        
@endsection

@section('content')
<!-- <div class="container"> -->
    <div class="row bolt-puppy">
        <div class="col-md-2 bolt-div" id="user-sidebar">

            <div class="user-info video-tidtle">
                <img align="center" sdrc="{{ asset('uploads/def_profile.png') }}" src="{{ $user->getAvatar() }}" class="hidden-sm hidden-xs">
                <div class="user-image-overlay">
                    <h3 id="user-name" class="truncate">{{ $user->name }}</h3>
                    <h4 id="user-email" class="truncate">{{ $user->email }}</h4>
                    <p id="user-manage">
                        <span id="edit-profile"> <i class="fa fa-edit" title="Edit Profile"></i> <span class="hidden-sm hidden-xs">Edit Profile</span></span>
                        <span  id="change-avatar"> <i class="fa fa-image" title="Change Avatar"></i> <span class="hidden-sm hidden-xs">Change Avatar</span></span>
                    </p>
                </div>
            </div>

            <div class="list-group row">
                <div class="col-md-12 col-sm-6 col-xs-6"><a href="#user-videos" class="list-group-item"> <i class="fa fa-bars"></i> <span class="user-badge badge">{{ count($user->videos) }}</span><i class="fa fa-movie"></i>Your Videos</a></div>
                <div class="col-md-12 col-sm-6 col-xs-6"><a href="#fav-videos" class="list-group-item"> <i class="fa fa-bars"></i> <span class="user-badge badge">{{ $user->numFavVids() }}</span>Favorites</a></div>
                <div class="col-md-12 col-sm-6 col-xs-6"><a href="#user-cats" id="add-category" class="list-group-item"> <i class="fa fa-bars"></i> <span class="user-badge badge">{{ $user->categories->count() }}</span>Categories</a></div>
                <div class="col-md-12 col-sm-6 col-xs-6"><button id="add-new-video-button" class="list-group-item"> <i class="fa fa-plus"></i> <span class="user-badge badge">+</span>Upload Video</button></div>
                <div class="col-md-12 col-sm-6 col-xs-6"><a href="{{ url('categories/add') }}" id="add-category" class="list-group-item"> <i class="fa fa-plus"></i> <span class="user-badge badge">+</span>Add Category</a></div>
            </div>
            <div>
                <div id="edit-profile-form" class="sideforms" hidden>
                    @include('user.edit-form')
                </div>
                <div id="change-avatar-form" class="sideforms" hidden>
                    <form class="bolt-form" enctype="multipart/form-data" method="POST" action={{ url('user/changeAvatar') }}>
                        <input type="file" name="file">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="submit-new-avatar" class="bolt-button" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-10" id="user-mainbar">

                <div>
                    
                    <div id="add-video-form" class="BounceInUp video-forms" hidden style="font-size: 100% !important;">
                        @include('videos.add-video-form')
                    </div>

                    <div class="video-group-title" id="user-videos"><h2>Your Videos</h2></div>
                    <hr>
                    <div class="row main-panel">
                        @foreach($videos as $video)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                @include('videos.video-item')
                            </div>
                        @endforeach
                    </div>

                    <div class="video-group-title" id="fav-videos"><h2>Favorite Videos</h2></div>
                    <hr>
                    <div class="row main-panel">
                        @foreach($favs as $video)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                @include('videos.video-item')
                            </div>
                        @endforeach
                    </div>

                    <div class="section-header" id="user-cats"><h2>Your Categories</h2></div>
                    <div class="row main-panel">
                        @foreach($categories as $category)
                            @include('categories.item')
                        @endforeach
                    </div>
                    <!-- {!! $videos->render() !!} -->
                </div>

        </div>
    </div>
<!-- </div> -->
@endsection

<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/category-item.css') }}">


<style type="text/css">

    .main-panel {
        /*overflow: auto;*/
        /*max-height: 100vh;*/
    }
    .sideforms .bolt-form {
        padding: 10px 5px !important;
        margin: 0 !important;
        line-height: 80%; 
    }

    .title,max-height: {
        width: auto;
        display: inline-block;
    }

    .pagination ul {
        padding: 0;
        margin: 0;

    }

    p#user-manage {
        padding: 10px;
        background: rgb(49, 44, 50);
        color: #fff;
        font-weight: bolder;
        border-radius: 1px;
        font-size: 78%;

    }

    p#user-manage span {
        padding: 2px 1px;
        border-radius: 2px;
    }

    p#user-manage span:hover {
        background: #F2F2F2;
        color: #312C32;
    }

    p#user-manage i,
    p#user-manage span {
        cursor: pointer;
    }

    div.user-info:hover #user-manage-overlay {
        opacity: 1;
    }

    /*div.user-info:hover #user-manage-overlay h3,*/
    div.user-info:hover #user-manage-overlay button {
        width: auto;
    }

    .bolt-puppy {
        padding: 5px;
        margin-right: 0px !important;
        margin-left: 0px !important;
    }

    #user-sidebar {
        border-radius: 3px;
        padding: 5px;
        display: block;
    }

    #user-sidebar h3,
    #user-sidebar h4 {
        text-align: center;
    }

    #user-sifdebar img {
    }

    .user-info img {
        width: 100%;
        height: auto;
        margin: 5px 0;
        /*border: solid rgba(23, 46, 53, 0.33);*/
        border-radius: 2px;
    }

    .user-info div {
        padding: 2px 3px;
        width: 100%;
        font-weight: bold;
        border-radius: 2px;
    }

    #user-sidebar .list-group {
        background: transparent;
        padding: 2px;
        margin-bottom: 0px;
    }

    .list-group .list-group-item:hover {
        /*background: #0F372E;*/
        background: rgb(154, 209, 204);
        /*color: #fff;*/
    }

    ul.pagination li {
        border: none;
        border-radius: 0px;
    }

    ul.pagination li.active {
        color: #fff;
        background: #fff;
    }

    .user-info {
        border-radius: 2px;
        padding: 5px;
        color: #fff;
        background: #312C32;
    }


    .sideforms {
        background: #fff;
        padding: 10px;
        margin: 2px;
        border-radius: 3px;
    }

    .user-badge, .add-badge {
        background-color: #8F0A0A !important;
        border-radius: 3px !important;
    }

    .add-badge {
        line-height: 3 !important;
        cursor: pointer;
    }

    .image { 
        position: relative; 
        width: 100%; /* for IE 6 */
    }

    .image h3,
    .image h4 { 
        position: absolute; 
        top: 200px; 
        left: 0; 
        width: 100%; 
    }

</style>