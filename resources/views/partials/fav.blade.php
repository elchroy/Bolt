<form method="POST" id="favForm" action="/{{ $model }}/{{ $id }}/{{ $action }}">
    <button action="{{$action}}" class="bolt-button button-half fav-button button-{{ $action }}" id="button-{{ $action }}" type="submit"> <i class="fa fa-lg fa-{{Auth::user()->favors($video) ? 'heart' : 'heart-o'}}"></i></button>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
</form>

<style type="text/css">

	.button-favorite,
	.button-unfavorite {
		font-size: medium;
	    font-weight: bolder;
	    width: auto;	
	    display: inline-block;
	    right: 0;
	    float: right;
	    border: solid #C52020;
	    border-radius: 2px;
	}

	.button-favorite {
		background: #f2f2f2;
	    color: #C52020;
	}

	.button-unfavorite {
		background: #C52020;
	    color: #F2F2F2;
	}

</style>