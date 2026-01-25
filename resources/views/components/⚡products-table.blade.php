<?php

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public string $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if (!in_array($field, ['price', 'stock'], true)) {
            return;
        }

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }

        $this->sortField = $field;
        $this->sortDirection = 'asc';

        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'products' => Product::query()
                ->when($this->search !== '', function ($q) {
                    $q->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $this->search . '%']);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
        ];
    }

    public function paginationView(): string
    {
        return 'vendor.pagination.tailwind';
    }
};
?>

<div class="bg-white shadow rounded overflow-hidden p-4">

    {{-- Busca (agora funciona) --}}
    <div class="mb-4">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Buscar produto..."
            class="w-full sm:max-w-sm border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
        >
    </div>

    <table class="w-full table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Nome</th>

                <th class="p-3 text-left">
                    <button wire:click="sortBy('price')"
                        class="inline-flex items-center gap-1 text-blue-700 hover:text-blue-900 font-semibold">
                        Preço
                        @if($sortField === 'price')
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @else
                            ↕
                        @endif
                    </button>
                </th>

                <th class="p-3 text-left">
                    <button wire:click="sortBy('stock')"
                        class="inline-flex items-center gap-1 text-blue-700 hover:text-blue-900 font-semibold">
                        Estoque
                        @if($sortField === 'stock')
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @else
                            ↕
                        @endif
                    </button>
                </th>

                <th class="p-3 text-right">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr class="border-t">
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="p-3">{{ $product->stock }}</td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('products.edit', $product) }}"
                           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm shadow">
                            Editar
                        </a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
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

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
