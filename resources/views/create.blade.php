@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nova Venda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control">
                <option value="">Nenhum</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <input type="text" name="forma_pagamento" id="forma_pagamento" class="form-control" required>
        </div>

        <hr>
        <h5 class="mb-3">Produtos</h5>

        <table class="table table-bordered" id="produtos-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="produtos[]" class="form-control">
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantidades[]" class="form-control" min="1" value="1">
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger remove-produto">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-sm btn-secondary mb-3" id="add-produto">+ Adicionar Produto</button>

        <div class="mb-3">
            <label for="parcelas" class="form-label">Número de Parcelas</label>
            <input type="number" name="parcelas" id="parcelas" class="form-control" min="1" value="1">
        </div>

        <div class="mb-3">
            <label class="form-label">Prévia das Parcelas</label>
            <ul id="parcelas-preview" class="list-group"></ul>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Venda</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function calcularTotal() {
        let total = 0;
        $('#produtos-table tbody tr').each(function () {
            const precoTexto = $(this).find('select option:selected').text();
            const precoMatch = precoTexto.match(/R\$ (\d+(?:[.,]\d+)?)/);
            const preco = precoMatch ? parseFloat(precoMatch[1].replace(',', '.')) : 0;
            const quantidade = parseInt($(this).find('input[name="quantidades[]"]').val()) || 1;
            total += preco * quantidade;
        });
        return total;
    }

    function gerarParcelasPreview() {
        const total = calcularTotal();
        const qtdParcelas = parseInt($('#parcelas').val()) || 1;
        const valorParcela = (total / qtdParcelas).toFixed(2);
        const dataInicial = new Date();
        const preview = $('#parcelas-preview');
        preview.empty();

        for (let i = 1; i <= qtdParcelas; i++) {
            const vencimento = new Date(dataInicial);
            vencimento.setMonth(vencimento.getMonth() + i);
            const vencFormatado = vencimento.toLocaleDateString('pt-BR');
            preview.append(`<li class="list-group-item">Parcela ${i} - Vencimento: ${vencFormatado} - Valor: R$ ${valorParcela}</li>`);
        }
    }

    $('#add-produto').on('click', function () {
        const linha = `
        <tr>
            <td>
                <select name="produtos[]" class="form-control">
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})</option>
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
        gerarParcelasPreview();
    });

    $(document).on('click', '.remove-produto', function () {
        $(this).closest('tr').remove();
        gerarParcelasPreview();
    });

    $(document).on('input change', 'input[name="quantidades[]"], #parcelas, select[name="produtos[]"]', gerarParcelasPreview);

    $(document).ready(gerarParcelasPreview);
</script>
@endsection
