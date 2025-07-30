@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Vendas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Nova Venda</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Usuário</th>
                <th>Forma Pagamento</th>
                <th>Parcelas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->cliente->nome ?? 'N/A' }}</td>
                    <td>{{ $venda->user->name ?? 'N/A' }}</td>
                    <td>{{ $venda->forma_pagamento }}</td>
                    <td>{{ $venda->parcelas->count() }}</td>
                    <td>
                        <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('vendas.pdf', $venda->id) }}" class="btn btn-sm btn-secondary">PDF</a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
