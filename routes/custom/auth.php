<?php
use Auth;
Route::get('logout', function () {
    $user = Auth::user();
    $user->tenant_id = null;
    $user->save();
    Auth::logout();
    return redirect("/admin");
})->name("logout");