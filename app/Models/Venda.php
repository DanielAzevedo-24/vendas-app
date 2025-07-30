<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cliente;
use App\Models\User;
use App\Models\ItemVenda;
use App\Models\Parcela;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cliente_id', 'forma_pagamento'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
}
