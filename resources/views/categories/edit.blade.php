@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="section-body">
			
			<div class="section-header">
				<h2>Edit Category - <i>{{ $category->name }}</i></h2>
			</div>

			<form class="bolt-form" method="POST" action="{{ url('categories/' . $category->id) }}">
				{!! method_field('patch') !!}

				@include('categories.form-fields')

			<button type="submit">Update</button>
			
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