<?php

use Illuminate\Support\Facades\Route;
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

$controller_path = 'App\Http\Controllers';

// Main Page Route

Route::get('/', $controller_path . '\authentications\LoginBasic@index')->name('Login.index');
Route::post('/Login', $controller_path . '\authentications\LoginBasic@login')->name('Login.auth');
Route::post('/Logout', $controller_path . '\authentications\LoginBasic@logout')->name('Logout');

// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages

// chart
Route::get('/chart', $controller_path . '\pages\ChartController@index')->name('chart');
Route::post('/chart',$controller_path . '\pages\ChartController@store')->name('chart.store');
Route::get('/getLastData',$controller_path . '\pages\ChartController@getLastData')->name('getLastData');
Route::get('/getchart',$controller_path . '\pages\ChartController@getchart')->name('getchart');
Route::get('/ipfilter', $controller_path . '\pages\IpFilterController@index')->name('ipfilter.index');
Route::get('/rdp', $controller_path . '\pages\RdpChartController@index')->name('rdp.index');
Route::post('/rdp', $controller_path . '\pages\RdpChartController@store')->name('rdp.store');
Route::get('/getLastDatardp', $controller_path . '\pages\RdpChartController@getLastDatardp')->name('getLastDatardp');
Route::get('/getprintrdp',$controller_path . '\pages\RdpChartController@getprintrdp')->name('getprintrdp');

Route::get('/cases', $controller_path . '\pages\CasesController@index')->name('cases');
Route::get('/events', $controller_path . '\pages\EventsController@index')->name('events.index');
Route::post('/events', $controller_path . '\pages\EventsController@store')->name('events.store');
Route::delete('/events/{id}', $controller_path . '\pages\EventsController@delete')->name('events.delete');
Route::get('/endpoint', $controller_path . '\pages\EndpointController@index')->name('endpoint.index');
Route::post('/endpoint', $controller_path . '\pages\EndpointController@store')->name('endpoint.store');
Route::delete('/endpoint/{id}', $controller_path . '\pages\EndpointController@delete')->name('endpoint.delete');
Route::get('/workbench', $controller_path . '\pages\WorkbenchController@index')->name('workbench.index');


// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');

Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::post('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@store')->name('register.store');

//json upload

Route::middleware(['auth', 'role:admin'])->group(function () {
    $controller_path = 'App\Http\Controllers';
    Route::get('/Dashboard', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
});

// vtotal
Route::get('/vtotal', $controller_path . '\pages\VirusTotalController@index')->name('vtotal');
Route::post('/vtotal', $controller_path . '\pages\VirusTotalController@iphash')->name('vtotal.iphash');