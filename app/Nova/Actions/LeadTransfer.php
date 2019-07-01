<?php

namespace App\Nova\Actions;

use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\Select;
use Auth;

class LeadTransfer extends Action
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    
    public function name()
    {
        return __('Lead Transfer');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $tenant_id = $fields->tenant_id;
        if(@$fields->tenant_id)
        {
            foreach ($models as $model) {
                try 
                {
                    $model->tenant_id = $tenant_id;
                    $model->save();
                } catch (Exception $e) {
                    $this->markAsFailed($model, $e);
                }
            } 
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $user = Auth::user();
        $options = $user->tenants()->where("id","!=",$user->tenant_id)->get()->pluck("name","id")->toArray();
        return [
            Select::make(ucfirst(__("tenant")),"tenant_id")
                ->options($options)
        ];
    }
}
