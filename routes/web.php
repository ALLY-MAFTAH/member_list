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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/search', [App\Http\Controllers\MemberController::class, 'search'])->name('search');
Route::get('/', [App\Http\Controllers\MemberController::class, 'index'])->name('welcome');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add_member', [App\Http\Controllers\MemberController::class, 'addMember'])->name('add_member');
Route::put('edit_member/{memberId}', [App\Http\Controllers\MemberController::class, 'editMember'])->name('edit_member');
Route::get('delete_member/{memberId}', [App\Http\Controllers\MemberController::class, 'deleteMember'])->name('delete_member');
Route::post('file_import', [App\Http\Controllers\MemberController::class, 'fileImport'])->name('file_import');

