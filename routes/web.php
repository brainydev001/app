<?php

use App\Bi\Dashboards\UserDashboard;
use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMemberTypeController;
use App\Http\Controllers\AdminModulesController;
use App\Http\Controllers\AdminRegionController;
use App\Http\Controllers\AdminSecurityController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FarmerDashboardController;
use App\Http\Controllers\KinController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\UserLogsController;
use Illuminate\Support\Facades\Route;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\Apis\DashboardController;

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

/**
 * Route to access welcome blade
 */
Route::controller(SetupController::class)
    ->group(function () {
        // landing page
        Route::get('/', 'landing');
        // run set up to create setup authentication
        Route::get('setup', 'setup');
        /**
         * authenticates and creates: 
         * Admin type, user setup, system permission,
         * system role, sync system role to all permissions
         * attaches system role to user system.
         */
         Route::post('setupAuth', 'setupAuth')->name('setupAuth');
});

// admin pages routes

/**
 * Route to access admin dashboard and admin components
 */
Route::controller(AdminDashboardController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('dashboard_index', 'dashboard');
});

/**
 * Route to access admin membership types and membertype CRUD functions
 */
Route::controller(AdminMemberTypeController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('type_index', 'index')->middleware('permission:access type');
        Route::post('type_create', 'create')->name('type_create')->middleware('permission:create type');
        Route::get('type_delete/{id}', 'destroy')->middleware('permission:delete_type');
});

/**
 * Route to access regions and region CRUD functions
 */
Route::controller(AdminRegionController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('region/{type}', 'index')->middleware('permission:access region');
        Route::post('region_create/{type}', 'create')->name('region_create')->middleware('permission:create region');
        Route::get('region_delete/{id}/{type}', 'destroy')->middleware('permission:delete region');
});

/**
 * Route to access users and user CRUD functions
 */
Route::controller(AdminUserController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('user/{type}', 'index')->middleware('permission:access user');
});

/**
 * Route to access access control and security
 */
Route::controller(AccessControlController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('access_control', 'index')->middleware('permission:access access control');
        Route::get('list/{type}', 'lists')->middleware('permission:access access control');
        Route::get('create_role', 'create')->middleware('permission:access access control');
        Route::post('role_create/{origin}', 'store')->name('role_create')->middleware('permission:create role');
});

/**
 * Route to access events, activities and modules
 */
Route::controller(AdminModulesController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('module/{type}', 'index');
        Route::get('module/create/{type}', 'create');
        
});

/**
 * Route to access user logs on the eco system
 */
Route::controller(UserLogsController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('user_logs', 'index');
});


// farmer routes

/**
 * Route to register kin 
 */
Route::controller(KinController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('kin', 'index');
        Route::post('kin_create/{id}', 'create')->name('kin_create');
});

/**
 * Routes to farmer dashboard
 */
Route::controller(FarmerDashboardController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('dashboard_farmer', 'index');
});

// business intelligence
Route::controller(AnalyticsController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('user_analysis', 'userAnalysis');
});


// Route::group( function () {
//     Route::get('/dashboards', 'DashboardController@getDashboards');
//     Route::get('/{dashboard}/widgets', 'DashboardController@getWidgets');

//     Route::get('/{dashboard}/widgets/{widget}', 'WidgetController@getWidget');
//     Route::get('/{dashboard}/widgets/{widget}/csv', 'WidgetController@download');
//     Route::get('/{dashboard}/filters/{filter}', 'FilterController@getFilter');
// });

// authentication routes 
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
