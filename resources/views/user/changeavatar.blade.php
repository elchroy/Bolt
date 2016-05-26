<form class="bolt-form" enctype="multipart/form-data" method="POST" action={{ url('user/changeAvatar') }}>
	<div>
		<img src="{{ $user->getAvatar() }}" class="img-responsive center-block" style="width: 100%;">
	</div>
    <input type="file" name="file">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button id="submit-new-avatar" class="bolt-button" type="submit">Upload</button>
</form>