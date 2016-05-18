@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="section-title text-center">
            <h2> <i class="fa fa-lg fa-plus"></i> Add Video Learning Resource</h2>
        </div>

        @include('videos.add-video-form')
    
    </div>

@endsection

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">

@endsection