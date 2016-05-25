@extends('layouts.app')

@section('scripts')

	<script type="text/javascript">
		$(document).ready( function () {

			var string = 'abcdefghijklmnopqrstuvwxyz';
			var letters = string.split('');
			var menuitems = letters.map( function (l) {
				data = '<a href="#" to="' + l + '" class="list-group-item goto">' + l + '</a>';
				return data;
			});

			var catSelect = $('#cat-select');

			catSelect.html(menuitems);
			
			var catbars = $('.cat-bar');
			
			$.each(catbars, function (catbar) {
				vc = $(this).attr('for');
				name = $(this).attr('ini');
				if (vc != 'no') {
					toggPerform("toggle-cat-" + vc, "cat-collapse-" + vc, "cat-collapse", 600);
				}
			});
			
			var count = catbars.length;
			$('.goto').click( function (e) {
				e.preventDefault();
				var target = $(this).attr('to');
				var got = $('div[id^="bolt-'+ target +'"]');
				if ( $.inArray( got[0], catbars) != -1 ) {
				    $('html,body').animate({
				    	scrollTop: $(got).offset().top - 70
				    }, 900);
				}
			});

		});
	</script>

@endsection

@section('content')

	<div class="hidden-xs" id="sidenav">
		<div class="list-group" id="cat-select">
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12" id="main">
				@foreach($categories as $category)
					@include('categories.item')
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

		#sidenav {
			margin: 0;
    		padding: 0px;
    		width: 3%;
    		float: left;
    		position: fixed;
    		left: 0;
    		bottom: 30px;
    		/*top: 30px;*/
    		z-index: 1999;
    		display: inline-block;
		}

		#main {
			width: 90%;
			display: inline-block;
		}

		#cat-select {
			line-height: 0px;
			text-align: left;
			padding: 0px;
			display: block;
		}

		#cat-select a {
			font-size: 90%;
			float: left;
			width: 100%;
			display: block;
			font-weight: bold;
			background: #C52020;
			color: #FFFFFF;
			text-transform: uppercase;
			padding: 10px 5px;
			border-radius: 0px;
		}

		#cat-select a:hover {
			background: #FFFFFF;
			color: #C52020;
		}

	</style>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/category-item.css') }}">
@endsection