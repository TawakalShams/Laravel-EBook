<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\AddBookController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\UpdateStatus;
use App\Http\Controllers\UpdateStatusUnpaid;
use App\Http\Controllers\RegisterUsersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GetAllPaymentsController;
use App\Http\Controllers\GetBooksUserController;


Route::group(['middleware' => 'api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::resource('/users', UserController::class);
        Route::resource('/books', AddBookController::class);
        Route::resource('/carts', ShoppingCartController::class);
        Route::resource('/images', ImageController::class);
        Route::resource('/changepassword', UpdatePasswordController::class);
        Route::resource('/paid', UpdateStatus::class);
        Route::resource('/unpaid', UpdateStatusUnpaid::class);
        Route::resource('/allpayments', GetAllPaymentsController::class);

        //users
        // Route::get('/saveBooks', CustomerOrderController::class);
        // Route::get('/saveBooks', CustomerOrderController::class);
        Route::resource('/payments', PaymentController::class);
        Route::resource('/getBooks', GetBooksUserController::class);
        Route::resource('/saveMyBooks', CustomerOrderController::class);


    });
    
});

Route::resource('/registerUsers', RegisterUsersController::class);




