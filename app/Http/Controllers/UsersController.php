<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Http\Controllers\BoltUploader as Uploader;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * The authenticated user instance.
     * 
     * @var [type]
     */
    protected $user;

    public function __construct()
    {
        $this->middleware('avatar', ['only' => [
            'changeAvatar',
        ]]);

        $this->middleware('auth', ['only' => [
            'edit',
            'update',
        ]]);

        $this->middleware('userUpdate', ['only' => [
            'update',
        ]]);

        $this->user = Auth::user();
    }

    public function changeAvatar(Request $request, Uploader $uploader)
    {
        $result = $uploader->uploadAvatar($request->file('file'));

        $this->user->update(['avatar' => $result['url']]);

        return redirect()->back();
    }

    public function edit()
    {
        $data = [
            'user' => $this->user,
            'title' => 'Edit Your Profile',
        ];

        return view('user.edit', $data);
    }

    public function update(Request $request)
    {
        $this->user->update($request->all());

        return redirect('dashboard');
    }
}
