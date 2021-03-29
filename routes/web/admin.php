<?php

use Illuminate\Support\Facades\Route;



Route::get('/admin','AdminController@dashboard')->name('dashboard');
Route::resource('users','User\UserController');
Route::get('/users/{user}/permissions','User\PermissionController@create')->name('users.permissions')->middleware('can:staff-user-permissions');
Route::post('/users/{user}/permissions','User\PermissionController@store')->name('users.permissions.store')->middleware('can:staff-user-permissions');
Route::resource('permissions','PermissionController');
Route::resource('roles','RoleController');

Route::resource('zones','ZoneController');
Route::resource('provinces','ProvinceController');
Route::resource('provincial-zones','ProvincialZoneController');

Route::resource('covered_populations','CoveredPopulationController');
Route::resource('customers','CustomerController');
Route::resource('leakages','LeakageController');
Route::resource('illegal_customers','IllegalCustomerController');
Route::resource('faucet_changes','FaucetChangeController');
Route::resource('meter_changes','MeterChangeController');
Route::resource('signboards','SignboardController');
Route::resource('faucet_diameter_customers','FaucetDiameterCustomerController');
Route::resource('assets','AssetController');

Route::get('get-province-list','DropdownController@getProvinceList');
Route::get('get-provincial-zone-list','DropdownController@getProvincialZoneList');
Route::get('get-provincial-zone-list-for-role','DropdownController@getProvincialZoneListForRole');
Route::get('get-meter-reader-list','DropdownController@getMeterReaderList');

Route::resource('debts','DebtController');
Route::resource('sources','SourceController');
Route::resource('source_types','SourceTypeController');
Route::resource('impaired_pumps','ImpairedPumpController');
Route::resource('water_productions','WaterProductionController');
Route::resource('water_storages','WaterStorageController');
Route::resource('meter_readers','MeterReaderController');
Route::resource('meter_readings','MeterReadingController');
Route::resource('printed_bills','PrintedBillController');
Route::resource('distributed_bills','DistributedBillController');
Route::resource('water_distributions','WaterDistributionController');
Route::resource('water_wastages','WaterWastageController');
Route::resource('storage_cleans','StorageCleanController');
Route::resource('incomes','IncomeController');
Route::get('settings','SettingController@index')->name('settings');
Route::post('settings/update','SettingController@update')->name('settings.update');
Route::resource('web_lengths','WebLengthController');
Route::resource('develop_web_lengths','DevelopWebLengthController');
Route::resource('change_web_lengths','ChangeWebLengthController');

Route::resource('planning_incomes','PlanningIncomeController');
Route::resource('water_tests','WaterTestController');

Route::resource('wall_chambers','WallChamberController');
Route::resource('wall_controllings','WallControllingController');


Route::match(['get','post'],'/','AdminController@login');
