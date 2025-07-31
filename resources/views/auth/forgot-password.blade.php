@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Redefinir Senha</h5>
            </div>

            <div class="card-body">
                <p class="mb-3 text-muted">
                    Esqueceu sua senha? Sem problemas. Informe seu e-mail abaixo e enviaremos um link para redefinir sua senha.
                </p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ __('Enviamos um link de redefinição de senha para o seu e-mail.') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required autofocus value="{{ old('email') }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Enviar link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
