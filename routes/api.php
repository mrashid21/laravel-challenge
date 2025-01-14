<?php

use App\Http\Controllers\InternetServiceProviderController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts', [PostController::class, 'list']);
    Route::post('posts/reaction', [PostController::class, 'toggleReaction']);

    // Route::post('mpt/invoice-amount', [InternetServiceProviderController::class, 'getMptInvoiceAmount']);
    // Route::post('ooredoo/invoice-amount', [InternetServiceProviderController::class, 'getOoredooInvoiceAmount']);
    Route::post('{serviceProvider}/invoice-amount', [InternetServiceProviderController::class, 'getInvoiceAmount']);

    Route::post('job/apply', [JobController::class, 'apply']);

    Route::post('staff/salary', [StaffController::class, 'payroll']);
});
