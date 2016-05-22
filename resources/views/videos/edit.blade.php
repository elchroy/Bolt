@extends('layouts.app')

@section('content')
    
    <div class="container">

        <div class="section-title text-center">
            <h2> <i class="fa fa-lg fa-edit"></i> Edit</h2>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img class="img-responsive video-image" sdrc="{{ asset('uploads/banner.jpg') }}" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
                
                <div class="row">
                    <div class="col-md-8">
                        <div id="delete-video-form" class="video-forms" hidden>
                            @include('videos.delete-video-form')
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button id="delete-video-button" class="bolt-button button-half">Delete</button>
                    </div>
                </div>

            </div>
            <div class="col-md-8 col-sm-12">
                @include('videos.edit-video-form', $video)
            </div>
        </div>
    
    </div>

@endsection

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">

<style type="text/css">
    .bolt-form {
        margin: 0px;
    }
</style>

@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            toggleDiv("delete-video-button", "delete-video-form", "video-forms", 600);
        });
        
    </script>
@endsection

<form method="POST" action="/videos/{{ $video->id }}/delete">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="delete">
    <button type="submit" class="add-video btn-teach-tech">Delete</button>
</form>