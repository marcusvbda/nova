<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use App\Status;
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
        if(@$data["status_id"])
        {
            $status_id = $data["status_id"];
            if($status_id!="all") $query = $query->where("status_id","$status_id");
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

    public function getStatus()
    {
        return Status::get();
    }
}
