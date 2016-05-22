@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="section-body">
			
			<div class="section-header">
				<h2>Add Category</h2>
			</div>

			@if (count($errors) > 0)
	            @include('partials.errors')
	        @endif
	        
			
			<form class="bolt-form" method="POST" action="{{ url('categories/create') }}">
				{!! csrf_field() !!}

				<input type="text" required maxlength="50" name="name" placeholder="name of category.">

				<textarea required maxlength="255" placeholder="brief description of this category" name="brief" value="{{ $brief or old('brief') }}"></textarea>

				<button type="submit">Add</button>
			</form>

		</div>
	</div>
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bolt-form.css') }}">

	<style type="text/css">
		.bolt-form {
			width: 50%;
		}
	</style>
@endsection

@section('scripts')
@endsection