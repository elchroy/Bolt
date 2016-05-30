<form class="bolt-form" enctype="multipart/form-data" method="POST" action={{ url('user/changeAvatar') }}>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
			<img src="{{ $user->getAvatar() }}" class="img-responsive center-block" style="width: 100%;">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
		    <input type="file" name="file">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <button id="submit-new-avatar" class="bolt-button" type="submit">Upload</button>
		</div>
	</div>
</form>

<style type="text/css">
	.row {
		padding: 0;
	}

	form {
		margin: 0px;
   		padding: 0px;
	}
</style>