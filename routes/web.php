<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendaController;

// Redireciona a home para a criação de vendas
Route::get('/', function () {
    return redirect()->route('vendas.create');
});

// Dashboard padrão do Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas de perfil (padrão do Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas protegidas de vendas
Route::middleware(['auth'])->group(function () {
    Route::get('/vendas/{id}/pdf', [VendaController::class, 'pdf'])->name('vendas.pdf');
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/{id}', [VendaController::class, 'show'])->name('vendas.show');
    Route::get('/vendas/{id}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::put('/vendas/{id}', [VendaController::class, 'update'])->name('vendas.update');
    Route::delete('/vendas/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy');
});

// Rotas de autenticação geradas pelo Breeze
require __DIR__.'/auth.php';
