@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        keepSideBar("video-sorting");

    });
</script>
                        
@endsection

@section('content')
    <div class="container">

        <div class=" row">
            <div class="col-md-12" id="user-mainbar">

                        <div class="video-group-title" id="user-videos"><h2>{{ $title }}</h2></div>
                        <div class="row main-panel">
                            @foreach($videos as $video)
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                @include('videos.video-item')
                                </div>
                            @endforeach
                        </div>
                        {!! $paging !!}


            </div>
        </div>
    </div>
@endsection