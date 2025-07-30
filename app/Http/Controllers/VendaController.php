<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\ItemVenda;
use App\Models\Parcela;
use App\Models\Produto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'user', 'parcelas', 'itens'])->latest()->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'forma_pagamento' => 'required|string',
            'produtos' => 'required|array|min:1',
            'produtos.*' => 'exists:produtos,id',
            'quantidades' => 'required|array|min:1',
            'quantidades.*' => 'integer|min:1',
            'parcelas' => 'required|integer|min:1',
        ]);

        $venda = Venda::create([
            'user_id' => Auth::id(),
            'cliente_id' => $request->cliente_id,
            'forma_pagamento' => $request->forma_pagamento,
        ]);

        $totalVenda = 0;

        foreach ($request->produtos as $index => $produtoId) {
            $produto = Produto::find($produtoId);
            $quantidade = $request->quantidades[$index] ?? 1;

            ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $produto->id,
                'quantidade' => $quantidade,
                'preco' => $produto->preco,
            ]);

            $totalVenda += $produto->preco * $quantidade;
        }

        $valorParcela = round($totalVenda / $request->parcelas, 2);
        $dataInicial = now();

        for ($i = 1; $i <= $request->parcelas; $i++) {
            Parcela::create([
                'venda_id' => $venda->id,
                'data_vencimento' => $dataInicial->copy()->addMonths($i),
                'valor' => $valorParcela,
            ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function show($id)
    {
        $venda = Venda::with(['cliente', 'user', 'itens.produto', 'parcelas'])->findOrFail($id);
        return view('vendas.show', compact('venda'));
    }

    public function edit($id)
    {
        $venda = Venda::with('itens', 'parcelas')->findOrFail($id);
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'forma_pagamento' => 'required|string',
            'produtos' => 'required|array|min:1',
            'produtos.*' => 'exists:produtos,id',
            'quantidades' => 'required|array|min:1',
            'quantidades.*' => 'integer|min:1',
            'parcelas' => 'required|integer|min:1',
        ]);

        $venda = Venda::findOrFail($id);
        $venda->update([
            'cliente_id' => $request->cliente_id,
            'forma_pagamento' => $request->forma_pagamento,
        ]);

        $venda->itens()->delete();
        $venda->parcelas()->delete();

        $totalVenda = 0;

        foreach ($request->produtos as $index => $produtoId) {
            $produto = Produto::find($produtoId);
            $quantidade = $request->quantidades[$index] ?? 1;

            ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $produto->id,
                'quantidade' => $quantidade,
                'preco' => $produto->preco,
            ]);

            $totalVenda += $produto->preco * $quantidade;
        }

        $valorParcela = round($totalVenda / $request->parcelas, 2);
        $dataInicial = now();

        for ($i = 1; $i <= $request->parcelas; $i++) {
            Parcela::create([
                'venda_id' => $venda->id,
                'data_vencimento' => $dataInicial->copy()->addMonths($i),
                'valor' => $valorParcela,
            ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }

    public function pdf($id)
    {
        $venda = Venda::with(['cliente', 'user', 'itens.produto', 'parcelas'])->findOrFail($id);
        $pdf = Pdf::loadView('vendas.pdf', compact('venda'));

        return $pdf->download("venda_{$venda->id}.pdf");
    }
}
