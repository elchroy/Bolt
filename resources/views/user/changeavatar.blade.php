<form class="bolt-form update" enctype="multipart/form-data" method="POST" action={{ url('user/changeAvatar') }}>
	<div class="row update">
		<div class="col-lg-6 col-md-4 col-sm-12 col-xs-12 avatar">
			<img src="{{ $user->getAvatar() }}" class="img-responsive center-block">
		</div>
		<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 avatar">
		    <input type="file" name="file">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <button id="submit-new-avatar" class="bolt-button" type="submit">Upload</button>
		</div>
	</div>
</form>

<style type="text/css">

	form.update,
	form.edit {
		/*margin: 0px;*/
		padding: 10px;
	}
	.row.upsdate {
		margin: 5px;
		padding: 5px 0 !important;
	}
	.row.updsate div.avatar {
		padding: 0 !important;
	}
	.row.updsate div.avatar img {
		width: 100%;
		height: 100%;
	}

	form {
		margin: 0px;
   		padding: 0px;
	}
</style>