<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PersonConditionController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\ConditionFollowupController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTargetController;
use App\Http\Controllers\EventEvaluatorController;

Route::middleware(['auth'])->group(function(){
    Route::resource('persons', PersonController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('subcategories', SubcategoryController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('person-conditions', PersonConditionController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('evaluators', EvaluatorController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('condition-followups', ConditionFollowupController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('events', EventController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('event-targets', EventTargetController::class);
});

Route::middleware(['auth'])->group(function(){
    Route::resource('event-evaluators', EventEvaluatorController::class);
});
/*
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
