<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Form\Form;

class hasFormWriteAccess
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
        $form = Form::findOrFail($request->route('id'));
        
        return $next($request);
    }
}
