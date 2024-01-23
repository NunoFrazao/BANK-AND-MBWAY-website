<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\VcardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\api\AuthController;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'insert']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('vcards/me', [VcardController::class, 'show_me']);

    // Users routes
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);

    // Transactions routes
    Route::get('transactions', [TransactionController::class, 'index']);
    Route::get('transactions/{transaction}', [TransactionController::class, 'show']);

    // Vcards routes
    Route::get('vcards', [VcardController::class, 'index']);
    Route::get('vcards/{vcard}', [VcardController::class, 'show']);
    Route::get('vcards/{vCard}/transactions', [VcardController::class, 'getTransactionsOfvCard']);
    Route::get('vcards/{vCard}/transactions/unread', [VcardController::class, 'getUnreadTransactionsOVcard']);
    Route::post('vcards/{vcard}/delete', [VcardController::class, 'delete']);
    Route::post('vcards/{vcard}/destroy', [VcardController::class, 'destroy']);

    // ApiResource routes
    Route::apiResource('users', UserController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('vcards', VcardController::class);
});
