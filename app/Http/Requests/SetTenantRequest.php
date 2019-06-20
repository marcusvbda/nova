<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SetTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "tenant" => ["required",function ($attribute, $value, $fail)  {
                $tenants = Auth::user()->tenants->pluck("id")->toArray();
                if( !in_array($value,$tenants) ) 
                    $fail('Nome do grupo de acesso deve ser único.');
            }]
        ];


    }
}
