<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::insert([
            ['nome' => 'Notebook', 'preco' => 3500.00],
            ['nome' => 'Mouse Gamer', 'preco' => 150.00],
            ['nome' => 'Teclado Mecânico', 'preco' => 300.00],
            ['nome' => 'Monitor 27"', 'preco' => 1200.00],
        ]);
    }
}
