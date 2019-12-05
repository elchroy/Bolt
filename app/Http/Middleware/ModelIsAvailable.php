<?php

namespace Bolt\Http\Middleware;

use Closure;

class ModelIsAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $class)
    {
        if ($this->findModel($class, $request->id)) {
            return $next($request);
        }

        $className = explode('\\', $class)[1];

        $message = "This $className is not available.";

        return view('errors.404', compact('message'));
    }

    protected function findModel($class, $id)
    {
        return $class::find($id);
    }
}
