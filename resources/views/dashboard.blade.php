<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Painel de Controle
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium">Total de Vendas</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                            {{ \App\Models\Venda::count() }}
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium">Clientes Cadastrados</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                            {{ \App\Models\Cliente::count() }}
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <h3 class="text-gray-500 dark:text-gray-300 text-sm font-medium">Produtos Ativos</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                            {{ \App\Models\Produto::count() }}
                        </p>
                    </div>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Últimas Vendas</h4>
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="pb-2">ID</th>
                                <th class="pb-2">Cliente</th>
                                <th class="pb-2">Data</th>
                                <th class="pb-2">Pagamento</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-100">
                            @foreach(\App\Models\Venda::with('cliente')->latest()->take(5)->get() as $venda)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="py-2">{{ $venda->id }}</td>
                                    <td>{{ $venda->cliente->nome ?? 'N/A' }}</td>
                                    <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $venda->forma_pagamento }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
