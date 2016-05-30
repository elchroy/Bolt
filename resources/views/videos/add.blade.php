@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="section-header text-center">
            <h2> <i class="fa fa-lg fa-plus"></i> Add Video Learning Resource</h2>
        </div>

        <div class="row">
        	<div class="col-lg-"></div>
        </div>
        @include('videos.add-video-form')
    
    </div>

@endsection

@section('scripts')

<script type="text/javascript">
    
    var showError = function () {
    	$('#url-check').removeClass('alert-success').addClass('alert-danger').html('<i class="fa fa-timesfa-lg"></i>Video Not Found. Please Verify video url. It must be a YouTube video.');
    }

    var showSuccess = function () {
    	$('#url-check').removeClass('alert-danger').addClass('alert-success').html('<i class="fa fa-check fa-lg"></i>');
    }

    $(document).ready( function () {

        $('.video-fields#url').on('change', function () {
        	vurl = $(this).val();
        	var url = '/check?url=' + vurl;
        	
        	$.get(url, function (d) {

        		console.log(d.trim() == "found");
        		if (d.trim() == "found") {
    				showSuccess();
    			} else {
    				showError();
    			}
        	});
        });
    });


</script>


@endsection

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('css/video-add-edit.css') }}">

@endsection