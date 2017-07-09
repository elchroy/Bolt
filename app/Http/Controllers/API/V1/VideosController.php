<?php

namespace Bolt\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Bolt\Http\Repositories\VideoRepository as VidRepo;

use Bolt\Http\Requests;
use Bolt\Http\Controllers\Controller;

class VideosController extends Controller
{
	protected $repo;
	public function __construct (VidRepo $repo) {
		$this->repo = $repo;
	}

    public function index () {
    	return $this->repo->getLatest(20);
    }
}
