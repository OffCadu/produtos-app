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

            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="{{ route('products.index') }}">
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar produto..."
                        value="{{ request('search') }}"
                        class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    >
                </form>

                <a href="{{ route('products.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                    + Novo Produto
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Nome</th>
                            <th class="p-3 text-left">Preço</th>
                            <th class="p-3 text-left">Estoque</th>
                            <th class="p-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-t">
                                <td class="p-3">{{ $product->name }}</td>
                                <td class="p-3">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </td>
                                <td class="p-3">{{ $product->stock }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm shadow">
                                        Editar
                                    </a>

                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm shadow"
                                            onclick="return confirm('Deseja remover este produto?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">
                                    Nenhum produto encontrado
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $products->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
