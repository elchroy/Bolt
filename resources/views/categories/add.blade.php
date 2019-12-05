@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="section-body">
			
			<div class="section-header">
				<h2>Add Category</h2>
			</div>

			<form class="bolt-form" method="POST" action="{{ url('categories/create') }}">
				@include('categories.form-fields')

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