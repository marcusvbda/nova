<?php
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'lead-operator'], function () {
        Route::post('search', 'LeadController@search')->name("custom.leads.search");
    });
});
