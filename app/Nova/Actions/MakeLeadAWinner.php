<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\Text;

// use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class MakeLeadAWinner extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    // public function __construct() {
    //     $this->onConnection('redis');
    // }
    
    public function handle(ActionFields $fields, Collection $models)
    {
        // $fields->subject
        foreach ($models as $model) {
            try {
                // Mark lead as a winner
                $model->is_winner = Carbon::now();
                $model->save();
            } catch (Exception $e) {
                $this->markAsFailed($model, $e);
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
        return [
            Text::make('Subject')
        ];
    }
}
