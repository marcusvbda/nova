<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use App\CustomField;

class LeadController extends Controller
{
    public function search(Request $request)
    {
        $data = $request->all();
        $paginated_leads = $this->filter($data);
        return $paginated_leads;
    }

    private function filter($data)
    {
        $query = Lead::where("id",">",0);
        if(@$data["filter"])
        {
            $filter = $data["filter"];
            $query = $query->where("name","like","%$filter%");
        }
        $query = $query->with(["conversions","status","status.definition"])
            ->orderBy(@$data["_order"] ? $data["_order"] : "id", @$data["_direction"] ? $data["_direction"] : "desc")
            ->paginate(15);
        return $query;
    }

    public function detail(Lead $lead)
    {
        $customFields = CustomField::get();
        return view("custom.leads.detail",compact('lead','customFields'));
    }
}
