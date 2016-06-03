    @extends('layouts.app')

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        // keepSideBar('user-sidebar');

        // toggleDiv("add-new-video-button", "add-video-form", "video-forms", 600);
        // toggleDiv("edit-profile", "edit-profile-form", "sideforms", 600);
        // toggleDiv("change-avatar", "change-avatar-form", "sideforms", 600);
        // toggleDiv("add-video", "add-video-form", "sideforms", 600);
        // toggleDiv("delete-video", "delete-video-form", "video-forms");

        $('.delete-video-openers').click( function (e) {
            e.preventDefault();

            id = $(this).attr('id');
            divID = $(this).attr('for');
            performToggle(id, divID, "video-delete-form", 600);
        });

        $('.close-delete-forms').click( function (e) {
            e.preventDefault();
            closeFormID = $(this).attr('for');
            $('#' + closeFormID).fadeToggle(600);
        });

    });
</script>
                        
@endsection

@section('content')
    <div class="row bolt-puppy">
        <div class="col-md-2 col-sm-2" id="user-sidebar">

            <div class="user-info video-title">
                <img align="center" src="{{ $user->getAvatar() }}" class="center-block img-responsive hidden-xs">
                <div class="user-image-overlay">
                    <h3 id="user-name" class="truncate hidden-sm hidden-xs">{{ $user->name }}</h3>
                    <p id="user-manage">
                        <a href="{{ url('profile/edit') }}" class="hidden-xs hidden-sm"> <span id="edit-profile"> <i class="fa fa-edit" title="Edit Profile"></i> <span class="">Edit Profile</span></span></a>
                        <a href="{{ url('profile/edit') }}" class="hidden-xs hidden-sm"> <span  id="change-avatar"> <i class="fa fa-image" title="Change Avatar"></i> <span class=" ">Change Avatar</span></span></a>
                    </p>
                </div>
            </div>

            <div class="list-group row">
                <div class="col-md-12 col-sm-12 col-xs-3"><a href="#user-videos" class="list-group-item"> <i class="fa fa-bars"></i> <span class="user-badge badge">{{ count($user->videos) }}</span><span class="user-badge badge"></span><i class="fa fa-movie"></i>Your Videos</a></div>
                <div class="col-md-12 col-sm-12 col-xs-3"><a href="#fav-videos" class="list-group-item"> <i class="fa fa-bars"></i> <span class="user-badge badge">{{ $user->numFavVids() }}</span>Favorites</a></div>
                <div class="col-md-12 col-sm-12 col-xs-3"><a href="#user-cats" class="list-group-item"> <i class="fa fa-bars"></i> <span class="user-badge badge">{{ $user->categories->count() }}</span>Categories</a></div>
                <div class="col-md-12 col-sm-12 col-xs-3"> <a href="{{ url('videos/add') }}"> <button id="add-new-video-button" class="list-group-item"> <i class="fa fa-plus"></i> <span class="user-badge badge">+</span>Upload Video</button></div></a>
                <div class="col-md-12 col-sm-12 col-xs-3"><a href="{{ url('categories/add') }}" id="add-category" class="list-group-item"> <i class="fa fa-plus"></i> <span class="user-badge badge">+</span>Add Category</a></div>
                <div class="col-md-12 col-sm-12 col-xs-3 hidden-md hidden-lg"><a href="{{ url('profile/edit') }}" class="list-group-item"> <i class="fa fa-edit"></i> Edit Profile</a></div>
            </div>

            <div hidden>
                <div id="edit-profile-form" class="sideforms" hidden>
                    @include('user.edit-form')
                </div>
                <div id="change-avatar-form" class="sideforms" hidden>
                    @include('user.changeavatar')
                </div>
            </div>
        </div>

        <div class="col-md-10 col-sm-10" id="user-mainbar">                    
                <div>
                    
                    <div id="add-video-form" class="BounceInUp video-forms" hidden style="font-size: 100% !important;">
                        <buttom class="pull-right close close-form" id="add-video-form"> Close </buttom>
                        @include('videos.add-video-form')
                    </div>

                    <div class="video-group-title" id="user-videos"><h2>Your Videos</h2></div>
                    <div class="row main-panel">
                         @if(count($videos))
                            @foreach($videos as $video)
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    @include('videos.video-item')
                                        <span class="pull-left"> <a href="{{ url('videos/'. $video->id .'/edit') }}" title="Edit Video"> <i class="fa fa-edit fa-lg"></i> Edit</a> </span>
                                        <span class="pull-right"> <a href="" title="Delete Video" class="delete-video-openers" for="delete-video-form-{{$video->id}}" id="open-del-form-{{ $video->id }}"> <i class="fa fa-trash fa-lg"></i> Delete</a> </span>
                                    <div class="video-delete-form" id="delete-video-form-{{ $video->id }}" hidden>
                                        @include('videos.delete-video-form')
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @include('partials.empty-collection', ['model' => 'videos'])
                        @endif
                    </div>

                    <div class="video-group-title" id="fav-videos"><h2>Favorite Videos</h2></div>
                    <div class="row main-panel">

                        @if(count($favs))
                            @foreach($favs as $video)
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    @include('videos.video-item')
                                </div>
                            @endforeach
                        @else
                            @include('partials.empty-collection', ['model' => 'favorite videos'])
                        @endif

                        
                    </div>

                    <div class="section-header" id="user-cats"><h2>Your Categories</h2></div>
                    
                        <div class="row main-panel">
                            @if(count($categories))
                                @foreach($categories as $category)
                                    @include('categories.item')
                                @endforeach
                            @else
                                @include('partials.empty-collection', ['model' => 'categories'])
                            @endif
                        </div>
                </div>

        </div>
    </div>
<!-- </div> -->
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/category-item.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">
@endsection