<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemVenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'preco',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
