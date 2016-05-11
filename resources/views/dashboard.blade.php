@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3" id="user-sidebar">
            <div class="user-info">
                <img align="center" src="{{ $user->getAvatar() }}" class="hidden-sm hidden-xs">
                <h3 id="user-name">{{ $user->name }}</h3>
                <h4 id="user-email">{{ $user->email }}</h4>
            </div>

            <div class="list-group">
                <a href="#user_videos" class="list-group-item"><span class="badge">{{ count($user->videos) }}</span><i class="fa fa-movie"></i>Your Videos</a>
                <a href="#fav-videos" class="list-group-item"><span class="badge">45</span>Favorite Videos</a>
                <!-- <button class="list-group-item"><span class="badge">+</span>Upload Video</button> -->
            </div>
            <div>
                <button class="user-actions" id="edit-profile"><i class="fa fa-edit"></i>Edit Profile</button>
                <button class="user-actions" id="change-avatar"><i class="fa fa-image"></i>Change Avatar</button>
            </div>
        </div>

        <div class="col-md-9" id="user-mainbar">

                <div id="user-videos">
                        <div class="title"><h3>Your Videos</h3></div>
                    <div class="row main-panel">
                        @foreach($videos as $video)
                            <div class="col-md-3 col-sm-6 col-xs-12 single-video">
                                <div class="thumbnail">
                                    <img class="video-image" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
                                    <p class="video-title">{{ $video->title }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {!! $videos->render() !!}
                </div>

        </div>
    </div>
</div>
@endsection


<style type="text/css">
    .main-panel {
        /*overflow: auto;*/
        /*max-height: 70vh;*/
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
    }

    .list-group .list-group-item:hover {
        background: #8F0A0A;
        color: #fff;
    }

    ul.pagination li {
        border: none;
        border-radius: 0px;
    }

    ul.pagination li.active {
        color: #fff;
        background: #fff;
    }

    .user-actions {
        width: 100%;
    }

    .user-info {
        border-radius: 2px;
        padding: 10px;
        color: #fff;
        background: rgb(143, 10, 10);
    }

    .user-info #user-name,
    .user-info #user-email {
    }

    .single-video {
        /*background: rgb(23, 46, 53);*/
        padding: 1px;
        margin: 0px;
        border-radius: 3px;
        max-height: 100vh;
    }

    .video-image {
        width: 100%;
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
