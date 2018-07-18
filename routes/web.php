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
Route::post('/employees/edit', 'EmployeeController@edit');
Route::post('/employees/store', 'EmployeeController@store');
Route::delete('/employees/destroy', 'EmployeeController@destroy');
Route::post('/employees/edit', 'EmployeeController@update');
Route::get('/employees/table', 'EmployeeController@getEmp');

Route::resource('employees', 'EmployeeController');

Route::get('login', ['as' => 'login', 'uses' => 'AuthenticationController@loginIndex']);
Route::post('login', 'AuthenticationController@loginProcess');
Route::get('logout', 'AuthenticationController@logout');