<?php

namespace Bolt\Http\Middleware;

use Auth;
use Closure;

class CheckOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $id, $class)
    {
        $model = $class::find($id);

        if ($this->isNotOwner($model)) {
            return redirect()->to('dashboard');
        }

        return $next($request);
    }

    protected function isOwner(\Illuminate\Database\Eloquent\Model $model)
    {
        return Auth::user()->id == $model->user_id;
    }

    protected function isNotOwner(\Illuminate\Database\Eloquent\Model $model)
    {
        return !($this->isOwner($model));
    }
}
