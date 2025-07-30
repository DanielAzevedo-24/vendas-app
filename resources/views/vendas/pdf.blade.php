<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Venda #{{ $venda->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h1>Venda #{{ $venda->id }}</h1>
    <p><strong>Cliente:</strong> {{ $venda->cliente->nome ?? 'N/A' }}</p>
    <p><strong>Forma de pagamento:</strong> {{ $venda->forma_pagamento }}</p>
    <p><strong>Data:</strong> {{ $venda->created_at->format('d/m/Y') }}</p>

    <h3>Itens</h3>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venda->itens as $item)
                <tr>
                    <td>{{ $item->produto->nome }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Parcelas</h3>
    <ul>
        @foreach($venda->parcelas as $parcela)
            <li>Vencimento: {{ \Carbon\Carbon::parse($parcela->data_vencimento)->format('d/m/Y') }} - R$ {{ number_format($parcela->valor, 2, ',', '.') }}</li>
        @endforeach
    </ul>
</body>
</html>
