<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\pagecontroller;
use App\Http\Controllers\passwordresetcontroller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\registercontroller;
use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) 
{
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [registercontroller::class, 'registerone']);

Route::post('/login', [logincontroller::class, 'login']);

Route::post('/resetpassword', [passwordresetcontroller::class, 'resetpassword']);

Route::group(['middleware' => ['auth:sanctum']], function () 
{
    Route::get('/home', [pagecontroller::class,  'homepage']);
    Route::post('/verify', [registercontroller::class, 'registerotp']);
    Route::post('resendotp', [registercontroller::class, 'resendotp']);
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/post/{post}', [PostController::class, 'show']);
    Route::post('job', [JobController::class, 'store']);
    Route::post('/job', [PostController::class, 'store']);
    Route::get('/job/{job}', [PostController::class, 'show']);
    Route::post('job', [JobController::class, 'store']);
});


//books belongs to an author

//user that created books
