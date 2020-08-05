<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

/*
|--------------------------------------------------------------------------
| Frontoffice Routes
|--------------------------------------------------------------------------
| Default Namespace : Front
| Default name : front.*
| Default recourses/views : front.*
*/

Route::get('/', function () {
    return view('front.welcome');
});
Route::group(['namespace' => 'front'], function () {
    Route::get('/home','HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Backoffice Routes
|--------------------------------------------------------------------------
| Default Namespace : Back
| Default name : admin.*
| Default recourses/views : back.*
*/
Route::namespace('Admin')->middleware('has.role')->name('admin.')->prefix('admin')->group(function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    // SYSTEM PLATFORM
    Route::resource('/users', 'UserController')->except(['show']);
    Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
    Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
    Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
    Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
    Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.set_role_permission');
    Route::delete('/users/permission/{permission}', 'UserController@destroyPermission')->name('users.destroy_permission');
    Route::resource('/roles', 'RoleController');
    Route::resource('/roles', 'RoleController')->except(['show']);
    Route::resource('/navigations', 'NavigationController')->except(['show']);
});


