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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController', ['except' => 'index'])->middleware('auth');

Route::get('users', 'UserController@index');

Route::post('users/search', 'UserController@search')->name('users.search');

Route::resource('skills', 'SkillController', ['except' => 'index'])->middleware('auth');

Route::get('skills', 'SkillController@index');

Route::post('skills/{id}/logo', 'SkillController@updateLogo');

Route::match(['put', 'patch'], 'users/{id}/skills', 'UserController@updateSkills')->middleware('auth');

Route::post('users/{id}/skills', 'UserController@addSkill');

Route::delete('users/{id}/skills', 'UserController@destroySkill');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{user}', function (\App\User $user) {
   event(new App\Events\SuccessEvent($user));
});
