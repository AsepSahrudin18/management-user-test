<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataTable;

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
    return view('auth.login');
});

Route::get('/auth_core', function () {
    return view('admin_backoffice.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserDataTable::class)->names('users');

Route::get('my_profile', function(){
    return view('admin_backoffice.users.my_profile');
})->name('my_profile');
// Route::resource('users', UserController::class);

// Route::get('/test-users', function () {

//     $user = App\Models\TableUser::all();

//     dd($user);

// });