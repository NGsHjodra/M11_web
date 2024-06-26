<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchHistoryController;
use App\Http\Controllers\LeaderboardController;

Route::get('/', [LeaderboardController::class, 'index'])->name('welcome');;

Route::get('/player/{puuid}', [PlayerController::class, 'show'])->name('player_show');

Route::post('/player', [PlayerController::class, 'store'])->name('player_store');

Route::get('/player/{puuid}/fetch-matches', [MatchHistoryController::class, 'fetch'])->name('player_fetch_matches');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
