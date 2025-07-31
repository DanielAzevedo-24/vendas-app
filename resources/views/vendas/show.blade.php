@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalhes da Venda</h2>
        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">← Voltar</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informações Gerais</h5>
            <p><strong>ID:</strong> {{ $venda->id }}</p>
            <p><strong>Cliente:</strong> {{ $venda->cliente->nome ?? 'N/A' }}</p>
            <p><strong>Usuário:</strong> {{ $venda->user->name ?? 'N/A' }}</p>
            <p><strong>Forma de Pagamento:</strong> {{ $venda->forma_pagamento }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Produtos</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($venda->itens as $item)
                        @php $subtotal = $item->preco * $item->quantidade; $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $item->produto->nome ?? 'N/A' }}</td>
                            <td>R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                            <td>{{ $item->quantidade }}</td>
                            <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="fw-bold">
                    <tr>
                        <td colspan="3" class="text-end">Total:</td>
                        <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @if($venda->parcelas->count())
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Parcelas</h5>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vencimento</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venda->parcelas as $index => $parcela)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($parcela->data_vencimento)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($parcela->valor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <a href="{{ route('vendas.pdf', $venda->id) }}" class="btn btn-outline-dark">
        📄 Baixar PDF
    </a>
</div>
@endsection
