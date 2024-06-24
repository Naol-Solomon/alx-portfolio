<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use PHPUnit\Framework\Attributes\PostCondition;

//user related Routes
Route::get('/', [UserController::class, 'showCorrectPage']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//post related posts
Route::get('/create-post', [PostController::class, 'showCreateForm']);
Route::post('/storeFormData', [PostController::class, 'storeFormData']);