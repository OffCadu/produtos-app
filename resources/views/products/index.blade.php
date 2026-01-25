<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Produtos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end items-center mb-4">
                <a href="{{ route('products.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                    + Novo Produto
                </a>
            </div>

            <livewire:products-table />

        </div>
    </div>
</x-app-layout>
