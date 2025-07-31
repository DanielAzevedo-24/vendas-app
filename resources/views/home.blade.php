@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="display-4 mb-4">Bem-vindo ao Sistema de Vendas</h1>
        <p class="lead mb-5">Acompanhe, gerencie e registre suas vendas com facilidade.</p>

        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Cadastrar</a>
        </div>
    </div>
</div>
@endsection
