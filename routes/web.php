<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){

		Route::get('/','AdminController@index')->name('admin.dashboard');
        Route::get('profile/','AdminController@profile')->name('admin.profile.show');
        Route::post('profile/update','AdminController@update')->name('admin.profile');
        Route::get('change-password/','AdminController@password_form')->name('admin.password');
        Route::post('change-password/','AdminController@password_change')->name('admin.password.change');

        Route::get('get-blood-request','AdminController@datatable_blood_request')->name('get_blood_request');
        Route::get('blood-request','AdminController@blood_request')->name('all.blood.request');

        Route::get('load-user','AdminController@user_datatable')->name('load_user');
        Route::get('load-paid-user','AdminController@paid_user_datatable')->name('load_paid_user');
        Route::get('load-unpaid-user','AdminController@unpaid_user_datatable')->name('load_unpaid_user');
        Route::post('user-detail','AdminController@user_detail')->name('show.user.detail');
        Route::get('all-users','AdminController@all_user')->name('all.users');
        Route::get('paid-users','AdminController@paid_user')->name('paid.users');
        Route::get('unpaid-users','AdminController@unpaid_user')->name('unpaid.users');
        Route::post('user-paid-status','AdminController@paid_status')->name('user.paid.status');

        Route::get('load-uncheck-user','AdminController@paid_uncheck_datatable')->name('load_paid_uncheck_user');
        Route::get('uncheck-users','AdminController@uncheck_user')->name('uncheck.users');
        Route::post('check-user','AdminController@change_check')->name('check.user');


        //
         Route::get('user.complain','AdminController@user_complain')->name('user.complain');
         Route::get('load.user.complain','AdminController@load_user_complain')->name('load.user.complain');


        // payment routes
        Route::get('load-payment','PaymentController@datatable')->name('load_payment');
        Route::get('payment','PaymentController@index')->name('payment');
        Route::get('payment/create','PaymentController@create')->name('payment.create');
        Route::post('payment/create','PaymentController@store')->name('payment.store');
        Route::post('payment/delete','PaymentController@destroy')->name('payment.delete');
        Route::get('payment/edit/{id}','PaymentController@edit')->name('payment.edit');
        Route::post('payment/update','PaymentController@update')->name('payment.update');



		// division routes
        Route::get('get-division/','DivisionController@datatable')->name('get_division');
        Route::get('division/','DivisionController@index')->name('division.index');
        Route::get('division/create','DivisionController@createForm')->name('division.create');
        Route::post('division/','DivisionController@store')->name('division.store');
        Route::get('division/edit/{id}','DivisionController@edit')->name('division.edit');
        Route::post('division/update','DivisionController@update')->name('division.update');
        Route::post('division/delete','DivisionController@destroy')->name('division.delete');

        // district routes
        Route::get('get-district/','DistrictController@datatable')->name('get_district');
        Route::get('district/','DistrictController@index')->name('district.index');
        Route::get('district/create','DistrictController@createForm')->name('district.create');
        Route::post('district/','DistrictController@store')->name('district.store');
        Route::get('district/edit/{id}','DistrictController@edit')->name('district.edit');
        Route::post('district/update','DistrictController@update')->name('district.update');
        Route::post('district/delete','DistrictController@destroy')->name('district.delete');

        // police station routes

        Route::get('load-police-station/','PoliceController@datatable')->name('load_police_station');
        Route::get('police-station/','PoliceController@index')->name('police_station.index');
        Route::get('police-station/create','PoliceController@createForm')->name('police_station.create');
        Route::post('police-station/','PoliceController@store')->name('police_station.store');
        Route::get('police-station/edit/{id}','PoliceController@edit')->name('police_station.edit');
        Route::post('police-station/update','PoliceController@update')->name('police_station.update');
        Route::post('police-station/delete','PoliceController@destroy')->name('police_station.delete');
        Route::post('get_district','PoliceController@get_district')->name('getAllDistrict');

        // police station routes

        Route::get('get_hospital/','HospitalController@datatable')->name('get.hospital');
        Route::get('hospital/','HospitalController@index')->name('hospital.index');
        Route::get('hospital/create','HospitalController@createForm')->name('hospital.create');
        Route::post('hospital/','HospitalController@store')->name('hospital.store');
        Route::get('hospital/edit/{id}','HospitalController@edit')->name('hospital.edit');
        Route::post('hospital/update','HospitalController@update')->name('hospital.update');
        Route::post('hospital/delete','HospitalController@destroy')->name('hospital.delete');
        Route::post('hospital_detail/','HospitalController@hospital_detail')->name('show.hospital.detail');


        // ambulance routes
        Route::get('load-ambulance/','AmbulanceController@datatable')->name('load_ambulance');
        Route::get('ambulance/','AmbulanceController@index')->name('ambulance.index');
        Route::get('ambulance/create','AmbulanceController@createForm')->name('ambulance.create');
        Route::post('ambulance/','AmbulanceController@store')->name('ambulance.store');
        Route::get('ambulance/edit/{id}','AmbulanceController@edit')->name('ambulance.edit');
        Route::post('ambulance/update','AmbulanceController@update')->name('ambulance.update');
        Route::post('ambulance/delete','AmbulanceController@destroy')->name('ambulance.delete');

        // touring place routes
        Route::get('get_touring_places/','TouringPlaceController@datable')->name('admin_get_touring_place');
        Route::get('touring-place/','TouringPlaceController@index')->name('touring_place.index');
        Route::get('touring-place/create','TouringPlaceController@createForm')->name('touring_place.create');
        Route::post('touring-place/','TouringPlaceController@store')->name('touring_place.store');
        Route::get('touring-place/edit/{id}','TouringPlaceController@edit')->name('touring_place.edit');
        Route::post('touring-place/update','TouringPlaceController@update')->name('touring_place.update');
        Route::post('touring-place/delete','TouringPlaceController@destroy')->name('touring_place.delete');
        Route::post('tour_detail','TouringPlaceController@tour_detail')->name('show.tour.detail');


         // Holel routes
        Route::get('load-hotel/','HotelController@datatable')->name('load_hotel');
        Route::get('hotel/','HotelController@index')->name('hotel.index');
        Route::get('hotel/create','HotelController@createForm')->name('hotel.create');
        Route::post('hotel/','HotelController@store')->name('hotel.store');
        Route::get('hotel/edit/{id}','HotelController@edit')->name('hotel.edit');
        Route::post('hotel/update','HotelController@update')->name('hotel.update');
        Route::post('hotel/delete','HotelController@destroy')->name('hotel.delete');


         // Holel routes

        Route::get('load-blood-bank/','BloodBankController@datatable')->name('load_blood_bank');
        Route::get('blood-bank/','BloodBankController@index')->name('blood_bank.index');
        Route::get('blood-bank/create','BloodBankController@createForm')->name('blood_bank.create');
        Route::post('blood-bank/','BloodBankController@store')->name('blood_bank.store');
        Route::get('blood-bank/edit/{id}','BloodBankController@edit')->name('blood_bank.edit');
        Route::post('blood-bank/update','BloodBankController@update')->name('blood_bank.update');
        Route::post('blood-bank/delete','BloodBankController@destroy')->name('blood_bank.delete');

         // Holel routes
        Route::get('load-notofication/','NotificationController@datatable')->name('load_notification');
        Route::get('notification/','NotificationController@index')->name('notification.index');
        Route::get('notification/create','NotificationController@createForm')->name('notification.create');
        Route::post('notification/','NotificationController@store')->name('notification.store');
        Route::get('notification/edit/{id}','NotificationController@edit')->name('notification.edit');
        Route::post('notification/update','NotificationController@update')->name('notification.update');
        Route::post('notification/delete','NotificationController@destroy')->name('notification.delete');
        // authentical routes


		Route::get('/login','auth\LoginController@showLoginForm')->name('admin.login');
		Route::post('/login','auth\LoginController@login')->name('admin.login.submit');
		Route::post('/logout','auth\LoginController@logout')->name('admin.logout');

        Route::get('/forget-password','auth\ForgetPasswordController@showLinkRequestForm')
        ->name('admin.forget.password');
          Route::post('/send-link','auth\ForgetPasswordController@send_link')->name('admin.send.link');
        Route::get('/password-forget/{token}','auth\ForgetPasswordController@reset_form')
        ->name('admin.password.forget');
         Route::post('/password-set','auth\ForgetPasswordController@set_password')
        ->name('admin.set.password');

});



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

