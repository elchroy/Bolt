@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="section-title text-center">
            <h2> <i class="fa fa-lg fa-plus"></i> Add Video Learning Resource</h2>
        </div>

        @include('videos.add-video-form')
    
    </div>

@endsection