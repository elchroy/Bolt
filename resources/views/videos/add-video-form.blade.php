<form method="POST" action="/videos/add" accept-charset="UTF-8" class="form-horizontal add-video-form" role="form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
        
        <div class="section-title"><h2>Add Video</h2></div>

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-12" for="title">Title:</label>
                    <div class="col-md-10 col-sm-12">
                        <input class="" required name="title" type="text" id="title">
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-12" for="url">URL:</label>
                    <div class="col-md-10 col-sm-12">
                        <input class="" required name="url" type="url" id="url">
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-12" for="Description">Description:</label>
                    <div class="col-md-10 col-sm-12">
                        <textarea class=" new-video-description" placeholder="Briefly describe the video" name="description" required maxlength="255" cols="50" rows="5"></textarea>
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-12" for="category_id">Category:</label>
                    <div class="col-md-10 col-sm-12">
                        <select class="new-video-category" name="category_id">
                            <option class="new-video-category" id="cat-0" value="">Select a category</option>
                            @foreach(Bolt\Category::all() as $category)
                                <option class="new-video-category" id="cat-{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        <button type="submit" class="bolt-button">Add</button>
</form>


<style type="text/css">

    .add-video-form {
        line-height: 30px;
        margin: 20px 0;
        background: rgb(248, 249, 249);
        border-radius: 3px;
        padding: 25px 0;
        width: 100%;
    }

    .add-video-form div label {
        font-size: 200%;
        font-weight: bolder;
    }

    .add-video-form .form-group {
        border-radius: 3px;
        padding: 10px;
    }

    .add-video-form .form-group:hover,
    .add-video-form .form-group div input:hover,
    .add-video-form .form-group div input:focus {
        background: rgb(231, 233, 234);
        cursor: pointer;
    }

    .add-video-form .form-group div input,
    .add-video-form .form-group div textarea,
    select {
        font-size: 150%;
    }

    .add-video-form .form-group div .form-control {

    }

    select {
        width: 100%;
        height: 30px;
        border: #172E35;
    }    
</style>