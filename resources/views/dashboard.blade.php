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
<div class="container">
    <div class="row">
        <div class="col-md-3" id="user-sidebar">
            <div class="user-info">
                <img align="center" src="{{ asset('uploads/def_profile.png') }}" gsrc="{{ $user->getAvatar() }}" class="hidden-sm hidden-xs">
                <h3 id="user-name" class="truncate">{{ $user->name }}</h3>
                <h4 id="user-email">{{ $user->email }}</h4>
            </div>

            <div class="list-group row">
                <div class="col-md-12 col-sm-6 col-xs-6"><a href="#user-videos" class="list-group-item"><span class="user-badge badge">{{ count($user->videos) }}</span><i class="fa fa-movie"></i>Your Videos</a></div>
                <div class="col-md-12 col-sm-6 col-xs-6"><a href="#fav-videos" class="list-group-item"><span class="user-badge badge">{{ $user->numFavVids() }}</span>Favorite Videos</a></div>
                <!-- <button class="list-group-item"><span class="badge">+</span>Upload Video</button> -->
            </div>
            <div>
                <button class="profile-actions" id="edit-profile"><i class="fa fa-edit"></i>Edit Profile</button>
                <div id="edit-profile-form" class="sideforms" hidden>
                    @include('user.edit-form')
                </div>
                <button class="profile-actions" id="change-avatar"><i class="fa fa-image"></i>Change Avatar</button>
                <div id="change-avatar-form" class="sideforms" hidden>
                    <form enctype="multipart/form-data" method="POST" action={{ url('user/changeAvatar') }}>
                        <input type="file" name="file">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="submit-new-avatar" class="bolt-button" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9" id="user-mainbar">

                <div>
                    <div class="section-title" id="user-videos">
                        <h2>
                            Your Videos <span id="add-new-video-button" class="add-badge badge pull-right"><i class="fa fa-lg fa-plus"></i> Upload</span>
                        </h2>
                        <div id="add-video-form" class="BounceInUp video-forms" hidden style="font-size: 100% !important;">
                            @include('videos.add-video-form')
                        </div>
                    </div>
                    <div class="row main-panel">
                        @foreach($videos as $video)
                            @include('videos.video-item')
                        @endforeach
                    </div>

                    <div class="section-title" id="fav-videos"><h2>Favorite Videos</h2></div>
                    <div class="row main-panel">
                        @foreach($favs as $video)
                            @include('videos.video-item')
                        @endforeach
                    </div>
                    <!-- {!! $videos->render() !!} -->
                </div>

        </div>
    </div>
</div>
@endsection


<style type="text/css">
    .main-panel {
        /*overflow: auto;*/
        /*max-height: 100vh;*/
    }

    .title,max-height: {
        width: auto;
        display: inline-block;
    }

    .pagination ul {
        padding: 0;
        margin: 0;

    }

    #user-sidebar {
        background: rgba(23, 46, 53, 0.32);
        border: none;
        border-radius: 3px;
        padding: 5px;
        display: block;
    }

    #user-sidebar h3,
    #user-sidebar h4 {
        text-align: center;
    }

    #user-sidebar img {
        width: 100%;
        height: auto;
        margin: 5px 0;
        /*border: solid rgba(23, 46, 53, 0.33);*/
        border-radius: 2px;
    }

    #user-sidebar .list-group {
        background: transparent;
        border: none;
        border-radius: 2px;
        padding: 2px;
        font-family: monospace;
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

    .profile-actions {
        width: 100%;
        font-family: monospace;

    }

    .user-info {
        border-radius: 2px;
        padding: 10px;
        color: #fff;
        /*background: rgb(143, 10, 10);*/
    }

    .user-info #user-name,
    .user-info #user-email {
        background: rgb(255, 255, 255);
        color: #172E35;
        width: 100%;
        border-radius: 3px;
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

</style>

@section('page')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    <form enctype="multipart/form-data" method="POST" action={{ url('user/changeAvatar') }}>
                        <input type="file" name="file">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">Upload</button>
                    </form>
                    <a href="{{ url('profile/edit') }}">Edit Profile</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
