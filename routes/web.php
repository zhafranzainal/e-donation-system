<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('/')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('donations', DonationController::class);
    Route::resource('reports', ReportController::class);
});

Route::put('applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
Route::put('applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
Route::put('applications/{application}/payment', [ApplicationController::class, 'payment'])->name('applications.payment');

Route::get('/staffReports', [ReportController::class, 'indexStaff']);

Route::get('/bankFPX', [App\Http\Controllers\DonationController::class, 'getBankFPX'])->name('get:banks');
Route::get('/create/fee{donations}', [App\Http\Controllers\DonationController::class, 'createFee'])->name('create:fee');
Route::get('/bill/payment/{bill_code}', [App\Http\Controllers\DonationController::class, 'billPaymentLink'])->name('bill:payment');
