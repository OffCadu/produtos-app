<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Produto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="POST"
                  action="{{ route('products.update', $product) }}"
                  class="bg-white p-6 shadow rounded">
                @csrf
                @method('PUT')

                @include('products.partials.form', ['product' => $product])

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('products.index') }}"
                       class="mr-4 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
                        Cancelar
                    </a>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
