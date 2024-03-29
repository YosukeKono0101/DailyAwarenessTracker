<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DailyStatController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomMetricController;
use App\Http\Controllers\CustomMetricTypeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::resource('custom_metrics', CustomMetricController::class);

Route::middleware('auth')->group(function () {
    Route::get('/dailystats', [DailyStatController::class, 'index'])->name('dailystats.index');
    Route::get('/dailystats/create', [DailyStatController::class, 'create'])->name('dailystats.create');
    Route::post('/dailystats', [DailyStatController::class,'store'])->name('dailystats.store');
    Route::get('/dailystats/{dailystat}', [DailyStatController::class, 'show'])->name('dailystats.show');
    Route::get('/dailystats/{dailystat}/edit', [DailyStatController::class, 'edit'])->name('dailystats.edit');
    Route::put('/dailystats/{dailystat}', [DailyStatController::class, 'update'])->name('dailystats.update');
    Route::delete('/dailystats/{dailystat}', [DailyStatController::class, 'destroy'])->name('dailystats.destroy');                    
});

Route::middleware('auth')->group(function () {
    Route::resource('custom_metrics', CustomMetricController::class);
    Route::resource('custom_metric_types', CustomMetricTypeController::class);    
    Route::get('/custom_metrics_types', [CustomMetricTypeController::class, 'index'])->name('custom_metrics_types.index');
    Route::get('/custom_metric_types/create', [CustomMetricTypeController::class, 'create'])->name('custom_metric_types.create');
    Route::delete('/custom_metric_types/{custom_metric}', [CustomMetricTypeController::class,'destroy'])->name('custom_metric_types.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('/goals', [GoalController::class,'store'])->name('goals.store');
    Route::get('/goals/{goal}', [GoalController::class, 'show'])->name('goals.show');
    Route::get('/goals/{goal}/edit', [GoalController::class, 'edit'])->name('goals.edit');
    Route::put('/goals/{goal}', [GoalController::class,'update'])->name('goals.update');
    Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->name('goals.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
