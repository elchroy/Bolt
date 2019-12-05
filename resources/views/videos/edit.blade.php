@extends('layouts.app')

@section('content')
    
    <div class="container">

        <div class="row">

            <div class="section-header text-center">
                <h2> <i class="fa fa-lg fa-edit"></i> Edit</h2>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-sm-12">
                    @include('videos.edit-video-form', $video)
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-sm-12">
                    <img class="img-responsive video-image hidden-xs" title="{{ $video->title }}" src="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg" alt="http://img.youtube.com/vi/{{ $video->linkId() }}/2.jpg">
                    
                    <div class="dele-section row">
                        <div class="col-md-12">
                            <button id="delete-video-button" class="bolt-button center-block"><i class="fa fa-trash fa-lg"></i></button>
                        </div>
                        <div class="col-md-12">
                            <div id="delete-video-form" class="video-forms" hidden>
                                @include('videos.delete-video-form')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    
    </div>

@endsection

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">

<style type="text/css">
    .bolt-form {
        margin: 0px;
    }

    #delete-video-button {
        width: auto;
        background: #c30e0e;
    }

    #delete-video-form {
        color: #8a6d3b;
        background-color: var(--bolt-hovr);
        border-color: #faebcc;
        top: 0;
        left: 0;
        width: 100%;
        border: solid 1px;
        margin: 0px;
    }

    #delete-video-form form {
        background-color: #fcf8e3;
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