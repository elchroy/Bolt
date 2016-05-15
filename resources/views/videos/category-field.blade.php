<div class="form-group">
    <label class="control-label col-md-2 col-sm-12" for="category_id">Category:</label>
    <div class="col-md-10 col-sm-12">
        <select class="new-video-category" name="category_id">
            <option class="new-video-category" id="cat-0" value="">Select a category</option>
            @foreach(Bolt\Category::all() as $category)
                @if(Input::old('category_id') == $category->id)
                    <option class="new-video-category" selected id="cat-{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                @elseif($video != null)
                    @if($video->category->id == $category->id)
                        <option class="new-video-category" selected id="cat-{{ $video->category->id }}" value="{{ $video->category->id }}">{{ $video->category->name }}</option>
                    @else
                        <option class="new-video-category" id="cat-{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @else
                    <option class="new-video-category" id="cat-{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>