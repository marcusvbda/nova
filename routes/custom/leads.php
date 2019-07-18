<?php
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'lead-operator'], function () {
        Route::post('search', 'LeadController@search')->name("custom.leads.search");
        Route::post('getStatus', 'LeadController@getStatus')->name("custom.leads.getStatus");
        Route::post('detail/{lead}', 'LeadController@detail')->name("custom.leads.detail");
    });
});
