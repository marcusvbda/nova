<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TenantController  extends Controller
{
    public function set()
    {
        return view("custom.tenants.set");
    }

    public function get_options() 
    {
        $tenants = Auth::user()->tenants;
        return response()->json($tenants);
    }
    
    public function set_submit(Request $request) 
    {
        $route = "/admin";
        $user = Auth::user();
        $user->tenant_id = $request->only("tenant")["tenant"];
        $user->save();
        return redirect($route);
    }
}
