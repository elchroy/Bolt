<div class="cat-bar" for="{{ $category->videos->count() > 0 ? $category->id : 'no' }}" ini="{{ strtolower($category->name)[0] }}" id="bolt-{{ strtolower($category->name) }}">
	<div class="left-section pull-left">
		<a href="{{ url('categories/' . $category->id) }}"> <i class="fa fa-bars"></i> {{ $category->name }}</a>
	</div>
	<div class="middle-section pull-right" id="toggle-cat-{{ $category->id }}">
		<i class="fa fa-angle-down"></i>
	</div>
	<div class="middle-section pull-right">
		Videos : {{ $category->videos->count() }}
	</div>
	@if(Auth::user())
		@if(Auth::user()->owns($category))
			<div class="right-section" style="float: none; text-align: center;">
				<a href="{{ url('categories/' . $category->id) . '/edit' }}" style="float: right; text-align: left; text-transform: lowercase; padding-right: 10px;"> <i class="fa fa-edit"></i> Edit </a>
			</div>
		@endif
	@endif
</div>

@if(count($category->videos()) > 0)
	<div class="cat-collapse" hidden id="cat-collapse-{{ $category->id}}">
		<div class="row">
			@foreach($category->videos->take(3) as $video)
				<div class="col-md-4 col-sm-4 col-xs-6">
					@include('videos.video-item')
				</div>
			@endforeach
		</div>
	</div>
@endif