<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('paypal/standard')->group(function () {

        Route::get('/redirect', 'Swim\Paypal\Http\Controllers\StandardController@redirect')->name('paypal.standard.redirect');

        Route::get('/success', 'Swim\Paypal\Http\Controllers\StandardController@success')->name('paypal.standard.success');

        Route::get('/cancel', 'Swim\Paypal\Http\Controllers\StandardController@cancel')->name('paypal.standard.cancel');
    });
});

Route::get('paypal/standard/ipn', 'Swim\Paypal\Http\Controllers\StandardController@ipn')->name('paypal.standard.ipn');

Route::post('paypal/standard/ipn', 'Swim\Paypal\Http\Controllers\StandardController@ipn')->name('paypal.standard.ipn');
