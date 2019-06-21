<?php
Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'tenants'], function () {
        Route::get('set', 'Auth\TenantController@set')->name("custom.tenants.set");
        Route::post('post', 'Auth\TenantController@set_submit')->name("custom.tenants.set.submit");
        Route::get('get_options', 'Auth\TenantController@get_options')->name("custom.tenants.get.options");
    });
});
