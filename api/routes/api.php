<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('users', [UserController::class, 'users']);
Route::get('users/profile', [UserController::class, 'profile'])->middleware('auth:api');
Route::get('users/{id}', [UserController::class, 'profileById']);
Route::get('users/profile', [UserController::class, 'profile'])->middleware('auth:api');

Route::post('post/{post}', [PostController::class, 'update'])->middleware('auth:api');
Route::post('post', [PostController::class, 'add'])->middleware('auth:api');
Route::delete('post/delete/{post}', [PostController::class, 'delete'])->middleware('auth:api');
