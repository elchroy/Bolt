<?php

namespace Bolt\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Validator;

class ValidateUserUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = $this->validateUserUpdate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return $next($request);
    }

    protected function validateUserUpdate(array $data)
    {
        return Validator::make($data, [
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users,email,'.Auth::user()->id,
        ]);
    }
}
