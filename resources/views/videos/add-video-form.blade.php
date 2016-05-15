<form method="POST" action="/videos/add" accept-charset="UTF-8" class="form-horizontal add-video-form" role="form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
        
        @if (count($errors) > 0)
           @include('videos.video-errors')
        @else
            <div class="alert alert-info">
                <p class="alert-info text-center"> Note: All fields are required.</p>
            </div>
        @endif

        @include('videos.title-field', ['video' => null])
        
        @include('videos.url-field', ['video' => null])
        
        @include('videos.description-field', ['video' => null])
        
        @include('videos.category-field', ['video' => null])

        <button type="submit" class="bolt-button">Add</button>

</form>


<style type="text/css">

    .add-video-form {
        /*line-height: 30px;*/
        margin: 20px 0;
        background: rgba(248, 249, 249, 0.5);
        border-radius: 3px;
        padding: 20px;
        width: 100%;
    }
    
    

    .add-video-form div label {
        font-weight: bolder;
        text-align: left;
    }

    ./*add-video-form .form-group {
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

    }*/

    select {
        width: 100%;
        height: 30px;
        border: #172E35;
    }    
</style>