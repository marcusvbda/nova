<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

class LeadController extends Controller
{
    public function search(Request $request)
    {
        $filter = $request->all();
        $paginated_leads = $this->filter($filter);
        return $paginated_leads;
    }

    private function filter($filter)
    {
        $leads = Lead::where("id",">",0);
        $leads = $leads->with(["conversions","status","status.definition"])->paginate(12);
        return $leads;
    }
}
