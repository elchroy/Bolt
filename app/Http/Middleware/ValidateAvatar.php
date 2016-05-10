<?php

namespace Bolt\Http\Middleware;

use Closure;
use Validator;

class ValidateAvatar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $file = $request->input('file');
        $fileArray = ['image' => $file];

        $validator = $this->validateAvatar($fileArray);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        return $next($request);
    }

    protected function validateAvatar(array $data)
    {
        return Validator::make($data, [
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:150' // max 150kb
        ]);
    }
}
