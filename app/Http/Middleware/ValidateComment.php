<?php

namespace Bolt\Http\Middleware;

use Closure;
use Validator;

class ValidateComment
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
        $validator = $this->validateComment($request->all());

        if ($validator->fails()) {
            dd($validator->messages());
            return redirect()->back()->withErrors($validator->messages());
        }
        return $next($request);
    }

    /**
     * Get a validator for an incoming video addition request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateComment(array $data)
    {
        return Validator::make($data, [
            'comment'         => 'required|max:255',
        ]);
    }
}
