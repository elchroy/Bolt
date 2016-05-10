<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Bolt\Http\Requests;
use Bolt\Http\Controllers\BoltUploader as Uploader;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('avatar', ['only' => [
			'changeAvatar'
		]]);
	}
    public function changeAvatar(Request $request, Uploader $uploader)
    {
        $file  = Input::file('file');

        $result = $uploader->uploadAvatar($file);

        $user = Auth::user();
        $user->avatar = $result['url'];
        $user->save();
        return redirect()->back();
    }
}
