<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;

Route::get('/contacts', [ContactController::class, 'index']); // List contact
Route::post('/contacts', [ContactController::class, 'store']); // Add contact
Route::put('/contacts/{id}', [ContactController::class, 'update']); // Update contact
Route::delete('/contacts/{id}', [ContactController::class, 'destroy']); // Delete contact

Route::get('/events', [EventController::class, 'index']); // List events
Route::post('/events', [EventController::class, 'store']); // Add event
Route::put('/events/{id}', [EventController::class, 'update']); // Update event
Route::delete('/events/{id}', [EventController::class, 'destroy']); // Delete event

Route::get('/tours', [TourController::class, 'index']);        // List tours
Route::post('/tours', [TourController::class, 'store']);       // Add a new tour
Route::put('/tours/{id}', [TourController::class, 'update']);  // Update a tour
Route::delete('/tours/{id}', [TourController::class, 'destroy']);  // Delete a tour

Route::get('/users', [UserController::class, 'index']);        // List users
Route::post('/users', [UserController::class, 'store']);       // Add a new user
Route::put('/users/{id}', [UserController::class, 'update']);  // Update a user
Route::delete('/users/{id}', [UserController::class, 'destroy']);  // Delete a user
