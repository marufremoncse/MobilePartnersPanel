<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'/','middleware'=>'auth'],function(){
    Route::get('/',function(){
        return redirect('/dashboard');
    });
    Route::get('/home',function(){
        return redirect('/dashboard');
    });
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});


Route::group(['prefix'=>'/','middleware'=>'auth'],function() {
    Route::group(['middleware' => ['role:Super Admin|Integration']], function () {
        Route::get('/editor-inhouse','EditorInhouseController@index');
        Route::get('/editor-inhouse/{org}/{start_time}/{end_time}','EditorInhouseController@index');
        Route::get('/editor-inhouse-details/{org}/{date}/{device_type}','EditorInhouseController@activation_details');
        Route::get('/editor-inhouse-search-list','EditorInhouseController@mo_search');
        Route::resource('/config','ConfigurationController');
        Route::resource('/games-details','GamesDetailsController');
    });
});

Route::group(['prefix'=>'/','middleware'=>'auth'],function(){
    Route::group(['middleware' => ['permission:Company Can View']], function () {

        Route::get('/sales/activation', 'DeviceActivationController@index');
        Route::get('/sales/activation/active', 'DeviceActivationController@total_active')->name('active');
        Route::get('/sales/activation/models', 'DeviceActivationController@total_model')->name('models');
        Route::get('/sales/activation/models/{device_model}', 'DeviceActivationController@device_details');
        Route::get('/sales/activation/feature', 'DeviceActivationController@total_feature')->name('feature');
        Route::get('/sales/activation/smart', 'DeviceActivationController@total_smart')->name('smart');
        Route::get('/sales/activation/downloads', 'DeviceActivationController@downloads')->name('downloads');
        Route::get('/sales/projection', 'TargetController@index');
        Route::get('/sales/projection/create', 'TargetController@create');
        Route::post('/sales/projection/store', 'TargetController@store');
        Route::get('/activation_export/{from}/{to}', 'DeviceActivationController@export')->name('activation_export');
        Route::get('/revenue/games', 'GamesRevenueController@index');
        Route::get('/revenue/report', 'GamesRevenueController@revenue_report');
        Route::get('/revenue/total-game', 'GamesRevenueController@total_game');
        Route::get('/revenue/total-game/{details}', 'GamesRevenueController@total_game_each_details');
        Route::get('/revenue/total-revenue', 'GamesRevenueController@total_revenue');
        Route::get('/revenue/total-revenue/{month}/{year}', 'GamesRevenueController@total_revenue_each_details');
        Route::get('/revenue_export/{from}/{to}', 'GamesRevenueController@export')->name('revenue_export');
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::resource('/organise', 'OrganizationController');
            Route::resource('/role', 'RoleController');
            Route::resource('/permission', 'PermissionController');
        });
        Route::group(['middleware' => ['role:Super Admin|Company Admin']], function () {
            Route::resource('/user', 'UserController');
        });

        Route::get('/profile/{id}', 'UserProfileController@index');
        Route::put('/profile/edit/{id}', 'UserProfileController@update');
        Route::get('/activationChartYear/{model}', 'ActivationChartController@getYearlyMobileCount');
        Route::get('/activationChartPreviousYear/{model}', 'ActivationChartController@getPreviousYearlyMobileCount');
        Route::get('/activationChartCurrentMonth/{model}', 'ActivationChartController@getCurrentMonthMobileCount');
        Route::get('/activationChartPreviousMonth/{model}', 'ActivationChartController@getPreviousMonthMobileCount');
        Route::get('/activationChartCurrentWeek/{model}', 'ActivationChartController@getCurrentWeekMobileCount');
        Route::get('/activationChartPreviousWeek/{model}', 'ActivationChartController@getPreviousWeekMobileCount');
        Route::get('/activationChartTwentyFour/{model}', 'ActivationChartController@getTwentyFourMobileCount');
        Route::get('/activationChartLastSevenDays/{model}', 'ActivationChartController@getLastSevenDaysMobileCount');
        Route::get('/activationChartLastThirtyDays/{model}', 'ActivationChartController@getLastThirtyDaysMobileCount');

        Route::get('/pieChartYearDivision/{model}','PieChartController@getYearlyDivisionMobileCount');
        Route::get('/pieChartPreviousYearDivision/{model}','PieChartController@getPreviousYearlyDivisionMobileCount');
        Route::get('/pieChartCurrentMonthDivision/{model}','PieChartController@getCurrentMonthDivisionMobileCount');
        Route::get('/pieChartPreviousMonthDivision/{model}','PieChartController@getPreviousMonthDivisionMobileCount');

        Route::get('/pieChartYearDivisionFeature/{model}','PieChartControllerFeature@getYearlyDivisionFeatureMobileCount');
        Route::get('/pieChartPreviousYearDivisionFeature/{model}','PieChartControllerFeature@getPreviousYearlyDivisionFeatureMobileCount');
        Route::get('/pieChartCurrentMonthDivisionFeature/{model}','PieChartControllerFeature@getCurrentMonthDivisionFeatureMobileCount');
        Route::get('/pieChartPreviousMonthDivisionFeature/{model}','PieChartControllerFeature@getPreviousMonthDivisionFeatureMobileCount');
    });
});


Auth::routes();

