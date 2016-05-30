<?php

namespace Bolt\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Validator;

class ValidateCategory
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
        $nameVal = $id == null ? 'required|max:50|unique:categories' : 'required|max:50|unique:categories,name,'.$id;

        return Validator::make($data, [
            'name'         => $nameVal,
            'brief'        => 'required|max:255',
        ]);
    }
}
