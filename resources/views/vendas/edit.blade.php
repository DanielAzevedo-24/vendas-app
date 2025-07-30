@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Venda #{{ $venda->id }}</h2>

    <form action="{{ route('vendas.update', $venda->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Cliente</label>
            <select name="cliente_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $venda->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Forma de Pagamento</label>
            <input type="text" name="forma_pagamento" class="form-control" value="{{ $venda->forma_pagamento }}" required>
        </div>

        <hr>
        <h5>Produtos</h5>
        <table class="table" id="produtos-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($venda->itens as $item)
                    <tr>
                        <td>
                            <select name="produtos[]" class="form-control">
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}" {{ $item->produto_id == $produto->id ? 'selected' : '' }}>
                                        {{ $produto->nome }} (R$ {{ $produto->preco }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantidades[]" class="form-control" value="{{ $item->quantidade }}" min="1">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-produto">X</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-sm btn-secondary" id="add-produto">+ Adicionar Produto</button>

        <hr>
        <div class="mb-3 mt-3">
            <label>Número de Parcelas</label>
            <input type="number" name="parcelas" class="form-control" min="1" value="{{ $venda->parcelas->count() }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Venda</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#add-produto').on('click', function () {
        let linha = `
        <tr>
            <td>
                <select name="produtos[]" class="form-control">
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ $produto->preco }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="quantidades[]" class="form-control" min="1" value="1">
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger remove-produto">X</button>
            </td>
        </tr>`;
        $('#produtos-table tbody').append(linha);
    });

    $(document).on('click', '.remove-produto', function () {
        $(this).closest('tr').remove();
    });
</script>
@endsection
