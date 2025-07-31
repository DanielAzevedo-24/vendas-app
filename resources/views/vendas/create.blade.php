@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Nova Venda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-select">
                    <option value="">Nenhum</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-select" required>
                    <option value="">Selecione</option>
                    <option value="Cartão">Cartão</option>
                    <option value="À Vista">À Vista</option>
                </select>
            </div>
        </div>

        <hr>

        <h5 class="mt-4">Produtos</h5>
        <table class="table table-bordered" id="produtos-table">
            <thead class="table-light">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="produtos[]" class="form-select">
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantidades[]" class="form-control" min="1" value="1">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-produto">Remover</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="add-produto">+ Adicionar Produto</button>

        <div class="mb-3" id="parcelas-group">
            <label for="parcelas" class="form-label">Número de Parcelas</label>
            <input type="number" name="parcelas" id="parcelas" class="form-control" min="1" value="1" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar Venda</button>
        </div>
    </form>

    <!-- Produto select template escondido -->
    <template id="produto-select-template">
        <select name="produtos[]" class="form-select">
            @foreach($produtos as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})</option>
            @endforeach
        </select>
    </template>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Controla exibição de parcelas
        function toggleParcelas() {
            const valor = $('#forma_pagamento').val();
            if (valor === 'À Vista') {
                $('#parcelas-group').hide();
                $('#parcelas').val(1);
            } else {
                $('#parcelas-group').show();
            }
        }

        $('#forma_pagamento').on('change', toggleParcelas);
        toggleParcelas();

        // Adicionar nova linha de produto
        $('#add-produto').on('click', function () {
            const selectHtml = $('#produto-select-template').html();
            const linha = `
                <tr>
                    <td>${selectHtml}</td>
                    <td><input type="number" name="quantidades[]" class="form-control" min="1" value="1"></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-produto">Remover</button></td>
                </tr>
            `;
            $('#produtos-table tbody').append(linha);
        });

        // Remover linha de produto
        $(document).on('click', '.remove-produto', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection
