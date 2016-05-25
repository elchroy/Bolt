<?php

namespace Bolt\Http\Middleware;

use Closure;
use Validator;
use Illuminate\Http\Request;


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
        $validator = $this->validateCategory($request);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        return $next($request);
    }

    protected function validateCategory(Request $request)
    {
        $data = $request->all();
        $id = $request->id;
        return Validator::make($data, [
            'name'         => 'required|max:50|unique:categories,name,' . $id,
            'brief'        => 'required|max:255',
        ]);
    }
}
