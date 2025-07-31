@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="bi bi-speedometer2 me-2"></i>
                    <h5 class="mb-0">Painel de Controle</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>
                            Bem-vindo! Você está logado com sucesso no sistema de <strong>Teste de Vendas</strong>.
                        </div>
                    </div>

                    <p class="text-muted mb-0">
                        Use o menu superior para navegar entre os recursos do sistema. Você pode criar novas vendas, visualizar relatórios ou editar seu perfil.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
