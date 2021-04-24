<?php
  use App\Http\Controllers\LanguageController;

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


// Route url
Route::get('/', 'DashboardController@dashboardAnalytics');

// Route Dashboards
Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@showLoginForm')->name('login');

// Route Components
Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

// acess controller
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

// Users Pages
// Route::get('/app-user-list', 'UserPagesController@user_list');
// Route::get('/app-user-view', 'UserPagesController@user_view');
// Route::get('/app-user-edit/{id}', 'UserPagesController@user_edit')->name('app-user-edit/{id}');
// Route::get('/app-user-create', 'UserPagesController@user_create');
// Route::post('/app-user-create', 'UserPagesController@create')->name('app-user-create');
Route::resource('users', 'UserPagesController');

// Auth::routes();

// locale Route
Route::get('lang/{locale}',[LanguageController::class,'swap']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
