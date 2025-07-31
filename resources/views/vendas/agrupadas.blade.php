@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Resumo de Vendas por Cliente</h2>

    @if ($vendasAgrupadas->isEmpty())
        <div class="alert alert-info">Nenhuma venda encontrada.</div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Total de Vendas</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendasAgrupadas as $grupo)
                    <tr>
                        <td>{{ $grupo->cliente->name ?? 'Cliente não encontrado' }}</td>
                        <td>{{ $grupo->total_vendas }}</td>
                        <td>R$ {{ number_format($grupo->total_valor, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
