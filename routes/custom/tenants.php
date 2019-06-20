<?php
Route::group(['prefix' => 'tenants'], function () {
    Route::get('set', 'TenantController@set')->name("custom.tenants.set");
    Route::post('post', 'TenantController@set_submit')->name("custom.tenants.set.submit");
    Route::get('get_options', 'TenantController@get_options')->name("custom.tenants.get.options");
});
