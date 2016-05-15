<?php

namespace Bolt\Http\Middleware;

use Closure;
use Validator;

class ValidateVideo
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
        $validator = $this->validateVideo($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return $next($request);
    }

    /**
     * Get a validator for an incoming video addition request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateVideo(array $data)
    {
        return Validator::make($data, [
            'title'         => 'required|max:255',
            'description'   => 'required',
            'category_id'   => 'required',
            'url'           => array('required', 'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/i')
        ]);
    }
}
