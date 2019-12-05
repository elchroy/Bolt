@extends('layouts.app')

@section('scripts')
                        
@endsection

@section('content')

        <div class="row">
            @foreach($jsons as $j)
                <div class="col-md-10">
                    <pre>
                        {{ $j->data }}
                    </pre>
                </div>
                <div class="col-md-2">
                    <p>{{ \Carbon\Carbon::parse($j->created_at)->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>

@endsection


@section('styles')
    <style type="text/css">
    </style>    
@endsection