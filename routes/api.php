<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'API\AuthController@login');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('me', 'API\AuthController@me');
    Route::post('register', 'API\RegisterController@register')->name('register');
    Route::post('verify_phone_number', 'API\RegisterController@verify_phone_number')->name('verify.user.account');
    Route::post('sent_forget_otp', 'API\RegisterController@forget_otp')->name('forget.otp');
    Route::post('forget_password', 'API\RegisterController@forget_password')->name('forget_password');
});


Route::group(['prefix'=>'user'],function(){

	Route::get('view_profile','API\ProfileController@view_profile')->name('user.profile');
	Route::post('update_profile','API\ProfileController@update')->name('user.update');
	Route::post('change-password','API\ProfileController@change_password')->name('change.password');

});

Route::group(['prefix'=>'bike'],function(){

	Route::get('bike','API\BikeRiderController@index')->name('bike.index');
	Route::post('bike_store','API\BikeRiderController@store')->name('bike.store');
	Route::post('bike-update','API\BikeRiderController@update')->name('bike.update');
	Route::get('bike-show/{id}','API\BikeRiderController@show')->name('bike.show');
	Route::delete('bike-delete/{id}','API\BikeRiderController@destroty')->name('bike.delete');
	Route::get('generate-qr-code/{id}','API\BikeRiderController@generate_qr')->name('generate.qr.code');
	Route::get('search-bike/{b_number}','API\BikeRiderController@search_bike')->name('search.bike');
	Route::get('check-exist-bike-register','API\BikeRiderController@exist_bike_register')->name('exist.bike');
});


Route::group(['prefix'=>'payment'],function(){
    Route::get('get_payment_method','API\PaymentController@get_method')->name('payment.method');
    Route::post('become_paid_user','API\PaymentController@paid_user')->name('payment.paided');
});

// search police station, ambulance, hotel, blood bank, touring place

Route::group(['prefix'=>'search'],function(){

	Route::post('police-station','API\SearchController@search_police_station')->name('search.police.station');
	Route::post('ambulance','API\SearchController@ambulance_search')->name('search.ambulance');
	Route::post('touring-place','API\SearchController@touring_place_search')->name('search.touring.place');
	Route::post('search_touring_place','API\SearchController@search_place')->name('search.place');
	Route::post('hotel','API\SearchController@hotel_search')->name('search.hotel');
	Route::post('blood-bank','API\SearchController@blood_bank_search')->name('search.blood.bank');
	Route::post('blood-request','API\SearchController@blood_request')->name('blood.request');
	Route::get('blood-notification','API\SearchController@get_blood_request')->name('blood.notification');
    Route::get('blood-last-notification','API\SearchController@get_last_blood_request')->name('blood.last.notification');
	Route::get('notification','API\SearchController@notification')->name('user.notification');
	Route::post('hospital','API\SearchController@search_hospital')->name('search.hospital');
	Route::get('get_division','API\SearchController@get_division')->name('user.get_division');
	Route::get('get_district/{id}','API\SearchController@get_district')->name('user.get_district');

	Route::get('get_push_notification','API\SearchController@get_push_notify')->name('user.push_notification');
	Route::post('update_push_notification','API\SearchController@update_push')->name('user.update.push_notify');
    Route::post('donate_blood/{id}','API\SearchController@donate_blood')->name('donate.blood');
    Route::get('donner_list/{id}','API\SearchController@donner_list')->name('donner.list');
    Route::post('check_donner','API\SearchController@check_donner')->name('check.donner');

});

Route::group(['prefix'=>'complain'],function(){
	Route::post('complain-store','API\ComplainController@store')->name('user.complain');

});
