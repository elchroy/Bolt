@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="section-header text-center">
            <h2> <i class="fa fa-lg fa-plus"></i> Add Video </h2>
        </div>

        @include('videos.add-video-form')
    
    </div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('js/video-add.js') }}"></script>

@endsection

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">

@endsection