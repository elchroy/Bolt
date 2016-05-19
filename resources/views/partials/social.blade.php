<a href="{{url('auth', ['link' => 'facebook'])}}" class="bolt-link btn-facebook">
    <button class="bolt-button bolt-social">
    	<span class="">
        <i class="fa fa-facebook fa-lg button-icon"></i>Facebook
        </span>
    </button>
</a>

<a href="{{url('auth', ['link' => 'twitter'])}}" class="bolt-link btn-twitter">
    <button class="bolt-button bolt-social">
        <i class="fa fa-twitter fa-lg button-icon"></i>Twitter
    </button>
</a>

<a href="{{url('auth', ['link' => 'github'])}}" class="bolt-link btn-github">
    <button class="bolt-button bolt-social">
        <i class="fa fa-github fa-lg button-icon"></i>GitHub
    </button>
</a>

<style type="text/css">
	.bolt-link {
		display: block;
		margin: 5% 0;
		border-radius: 3px;
	}

	.bolt-social {
		padding: 0px;
		line-height: 60px;
		background: #312C32;
		color: #fff;
    	font-size: 150%;
	}

	.bolt-social:hover {
		background: transparent;
	}

	.button-icon {
		padding-right: 10px;
	}
</style>