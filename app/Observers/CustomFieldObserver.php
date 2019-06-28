<?php
namespace App\Observers;
use App\CustomField;

class CustomFieldObserver
{
    private $data = null;
    
    public function deleted($model)
    {
        $customFields = CustomField::get();
        foreach($customFields as $customField)
        {
            CustomFieldValue::where("lead_id",$model->id)->where("custom_field_id",$customField->id)->delete();
        }
    }

    public function creating($model)
    {
        $model = $this->updateValue($model);
    }

    public function updating($model)
    {
        $model = $this->updateValue($model);
    }

    private function updateValue($model)
    {
        $customFields = CustomField::get();
        $data = $model->getAttributes();
        $custom_values = $model->custom_values ? $model->custom_values : [];
        foreach($customFields as $customField)
        {
            $custom_values[$customField->id] =  @$data[str_replace(" ","_",strtolower($customField->name))];
            unset($data[str_replace(" ","_",strtolower($customField->name))]);
        }
        $data["custom_values"] = json_encode($custom_values);
        $model->setRawAttributes($data);
        return $model;
    }
}