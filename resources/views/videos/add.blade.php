<form method="POST" action="/videos/add" accept-charset="UTF-8" class="form-horizontal" role="form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add A Video</h4>
    </div>
     <div class="modal-body">
         <div class="panel-body" style="padding: 10px;">
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="form-control" name="title" type="text" id="title">
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input class="form-control" name="url" type="url" id="url">
            </div>
            <div class="form-group">
                <label for="title">Description:</label>
                <textarea class="form-control new-video-description" placeholder="Briefly describe the video" name="description" cols="50" rows="10">
                </textarea>
            </div>
            <div class="form-group">
                <select class="form-control new-video-category" name="category_id">
                        <option class="new-video-category" id="cat-0" value="">Select a category</option>
                    @foreach(Bolt\Category::all() as $category)
                        <option class="new-video-category" id="cat-{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
         </div>
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="add-video btn-teach-tech">Add</button>
    </div>
</form>