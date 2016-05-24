@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="section-body">
				@foreach($categories as $category)
					<a href="{{ url('categories/' . $category->id ) }}">
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="video-box cat-box">
								<img src="{{ asset('uploads/def_profile.png') }}" class="">
								<div class="cat-overlay">
									<p>{{ $category->name }}</p>
									<p>Number of Videos : {{ $category->videos->count() }}</p>
									
								</div>
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>
	</div>

@endsection


@section('styles')
	<style type="text/css">
		.cat-box {
			box-shadow: none;
		}

		.cat-overlay {
			position: absolute;
			bottom: 0;
			text-align: left;
			vertical-align: middle;
			background: rgba(111, 111, 111, 0.6);
			display: block;
			width: 100%;
		}
	</style>
@endsection