<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Album;

// Rota de fallback
Route::fallback(function () {
    return view('falback');
});

// Rota users
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');
Route::post('/create-user', [UserController::class, 'createUser'])->name('users.create');

// Rota home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rota bandas
Route::get('/bandas', [BandController::class, 'index'])->name('bandas.index');
Route::get('/create-bandas', [BandController::class, 'create'])->name('bandas.create'); // Formulário de criação
Route::post('/store-bandas', [BandController::class, 'store'])->name('bandas.store'); // Salvar nova banda
Route::get('/edit-bandas/{id}', [BandController::class, 'edit'])->name('bandas.edit');
Route::put('/update-bandas/{id}', [BandController::class, 'update'])->name('bandas.update');
Route::delete('/bandas/{id}', [BandController::class, 'destroy'])->name('bandas.destroy');

// Rotas para álbuns (aninhadas com bandas)
Route::get('/create-albuns/{id}', [AlbumController::class, 'create'])->name('albuns.create'); // Formulário de criação
Route::post('/store-albuns', [AlbumController::class, 'store'])->name('albuns.store'); // Salvar nova banda
Route::get('/edit-albuns/{id}', [AlbumController::class, 'edit'])->name('albuns.edit');
Route::put('/update-albuns/{id}', [AlbumController::class, 'update'])->name('albuns.update');
Route::get('/view-albuns/{id}', [AlbumController::class, 'view'])->name('albuns.view');
Route::delete('/delete-albuns/{id}', [AlbumController::class, 'destroy'])->name('albuns.destroy');

// Dashboard
Route::get('/home-dashboard', [DashboardController::class, 'indexDashboard'])->name('home.dashboard')->middleware('auth');
