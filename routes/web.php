<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ProfileController;

// Página inicial redireciona para a lista de vendas (ou crie nova venda se preferir)
Route::get('/', function () {
    return redirect()->route('vendas.index'); // ou 'vendas.create'
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/{id}', [VendaController::class, 'show'])->name('vendas.show');
    Route::get('/vendas/{id}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::put('/vendas/{id}', [VendaController::class, 'update'])->name('vendas.update');
    Route::delete('/vendas/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy');
    Route::get('/vendas/{id}/pdf', [VendaController::class, 'pdf'])->name('vendas.pdf');
});

// Rotas de autenticação
require __DIR__.'/auth.php';
