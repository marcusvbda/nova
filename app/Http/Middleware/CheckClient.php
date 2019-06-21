<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckClient
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
        if($request->route()->uri=="admin/logout")
            return $next($request);
        $user = Auth::user();
        if(!$user->tenant_id)
        {
            $tenants = $user->tenants;
            if($tenants->count()==1)
               return $this->setUniqueTenatAndContinue($user,$tenants,$request,$next);
            return redirect(route('custom.tenants.set'));
        }
        return $next($request);
    }

    private function setUniqueTenatAndContinue($user,$tenants,$request,$next)
    {
        $user->tenant_id = $tenants->first()->id;
        $user->save();
        return $next($request);
    }
}
