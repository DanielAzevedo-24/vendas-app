@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Detalhes da Venda #{{ $venda->id }}</h2>
        <div class="flex gap-3">
            <a href="{{ route('vendas.pdf', $venda->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Baixar PDF
            </a>
            <a href="{{ route('vendas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Voltar
            </a>
        </div>
    </div>

    <div class="mb-4">
        <p><strong class="text-gray-700">Cliente:</strong> {{ $venda->cliente->nome ?? 'Não informado' }}</p>
        <p><strong class="text-gray-700">Usuário:</strong> {{ $venda->user->name ?? 'Desconhecido' }}</p>
        <p><strong class="text-gray-700">Forma de pagamento:</strong> {{ $venda->forma_pagamento }}</p>
    </div>

    <hr class="my-4">

    <h3 class="text-lg font-semibold text-gray-800 mb-2">Produtos</h3>
    <table class="min-w-full table-auto border text-sm mb-4">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 border">Produto</th>
                <th class="px-4 py-2 border">Quantidade</th>
                <th class="px-4 py-2 border">Preço Unitário</th>
                <th class="px-4 py-2 border">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($venda->itens as $item)
            @php $subtotal = $item->preco * $item->quantidade; $total += $subtotal; @endphp
            <tr class="text-center">
                <td class="px-4 py-2 border">{{ $item->produto->nome }}</td>
                <td class="px-4 py-2 border">{{ $item->quantidade }}</td>
                <td class="px-4 py-2 border">R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                <td class="px-4 py-2 border">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="font-bold bg-gray-100">
                <td colspan="3" class="px-4 py-2 border text-right">Total:</td>
                <td class="px-4 py-2 border text-center">R$ {{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3 class="text-lg font-semibold text-gray-800 mb-2">Parcelas</h3>
    <ul class="list-disc ml-5 text-sm text-gray-700">
        @foreach($venda->parcelas as $parcela)
            <li>Parcela {{ $loop->iteration }} - Vencimento: {{ \Carbon\Carbon::parse($parcela->data_vencimento)->format('d/m/Y') }} - Valor: R$ {{ number_format($parcela->valor, 2, ',', '.') }}</li>
        @endforeach
    </ul>

</div>
@endsection
