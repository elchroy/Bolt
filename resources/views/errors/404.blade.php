@extends('layouts.app')

@section('content')
	<div class="container blank">
		
		<div class="row">
			<div class="section-title text-center">

            	<img src="{{ url('img/404.png') }}">
	        </div>

	        <div class="bolt-div">
	        	<h2 class="section-header text-center">
	        		PAGE NOT FOUND
	        	</h2>

	        	<a href="{{ url('/videos') }}">
	        		<button class="bolt-calling"> Browse more videos</button>
	        	</a>
	        </div>
		</div>
    
    </div>
@endsection

@section('styles')
	<style type="text/css">
		.bolt-section {
			background: rgba(244, 247, 249, 0.7) url('uploads/noise.png') !important;
		}
	</style>
@endsection