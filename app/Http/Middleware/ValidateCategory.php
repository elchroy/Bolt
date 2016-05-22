<?php

namespace Bolt\Http\Middleware;

use Closure;
use Validator;

class ValidateCategory
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
        $validator = $this->validateCategory($request->all());
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        return $next($request);
    }

    protected function validateCategory(array $data)
    {
        return Validator::make($data, [
            'name'         => 'required|max:50|unique:categories',
            'brief'        => 'required|max:255',
        ]);
    }
}
