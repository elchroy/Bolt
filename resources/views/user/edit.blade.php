@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            @include('user.changeavatar')
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            @include('user.edit-form')
        </div>
    </div>
</div>
@endsection
