<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Form\Form;

class formAdminAccess
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
        
        if(!$form->creator_id == $request->user()->id){
            $tes  = FormMaintainer::where('status',1)->whereIn('maintainer_roles_id',[1,2])->where('form_id',$form->id)->count();
            if($tes <= 0){
                return abort(403);
            }
        }
        $request->attributes->add(['theForm' => $form]);
        return $next($request);
    }
}
