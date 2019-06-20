<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\SetTenantRequest;

class TenantController  extends Controller
{
    public function set()
    {
        $this->canAccessSelection();
        return view("custom.tenants.set");
    }
    
    private function canAccessSelection() 
    {
        $user = Auth::user();
        if($user->tenants->count()>1)
        {
            $user->tenant_id = null;
            $user->save();
            return true;
        }
        abort(404);
    }

    public function get_options() 
    {
        $tenants = Auth::user()->tenants;
        return response()->json($tenants);
    }
    
    public function set_submit(SetTenantRequest $request) 
    {
        $route = "/admin";
        $user = Auth::user();
        $user->tenant_id = $request->only("tenant")["tenant"];
        $user->save();
        return redirect($route);
    }
}
