<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/users/info' , function(){
    return view('main_dashboard.users');
})->name('users');

Route::middleware('auth')->group(function(){
    Route::get('/home' , 'App\Http\Controllers\OwnerDashboardController@index')->name('home');
    Route::get('/tasks' , 'App\Http\Controllers\TaskController@index')->name('tasks');
    Route::get( 'task/details/{taskSlug}', 'App\Http\Controllers\TaskController@show')->name('task_details');
    Route::get('/teams' , 'App\Http\Controllers\TeamController@index')->name('teams');
    Route::get( 'teams/details/{slug}', 'App\Http\Controllers\TeamController@show');
    Route::get( 'invited/team/{slug}','App\Http\Controllers\TeamController@createMember' )->name('invite_link')->middleware('signed');
    Route::middleware('CheckUserPerMission')->group(function(){
        Route::post('/tasks/store/{teamSlug?}' , 'App\Http\Controllers\TaskController@store')->name('task_store');
        Route::get('/tasks/create/{teamSlug?}' , 'App\Http\Controllers\TaskController@create')->name('create_task');
        Route::get('/teams/createTeam' , 'App\Http\Controllers\TeamController@create')->name('create_teams');
        Route::post('/teams/store' , 'App\Http\Controllers\TeamController@store')->name('team_store');
    });
});



Route::get('/profile' , function(){
    return view('main_dashboard.profile');
})->name('profile');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
