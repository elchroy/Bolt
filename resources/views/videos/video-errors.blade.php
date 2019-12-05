 <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li> <i class="fa fa-bolt fa-sm"> </i> {!! $error !!}</li>
        @endforeach
    </ul>
</div>