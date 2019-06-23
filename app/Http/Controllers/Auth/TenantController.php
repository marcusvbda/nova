<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\SetTenantRequest;
use Redirect;

class TenantController  extends Controller
{
    public function set()
    {
        $user = Auth::user();
        if(!$this->canAccessSelection($user)) {
            return Redirect::to(route("nova.login"))->withInput(["email"=>$user->email])->withErrors(["email"=>__("User dont have a tenant attached")]);
        }
        return view("custom.tenants.set");
    }
    
    private function canAccessSelection($user) 
    {
        if($user->tenants->count()>1)
        {
            $user->tenant_id = null;
            $user->save();
            return true;
        }
        Auth::logout();
        return false;
    }

    public function get_options() 
    {
        $tenants = Auth::user()->tenants()->enabled()->get();
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
