<div class="mb-4">
    <label class="block font-medium text-gray-700 mb-1">Nome</label>
    <input
        type="text"
        name="name"
        value="{{ old('name', $product->name ?? '') }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
    >
    @error('name')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-medium text-gray-700 mb-1">Descrição</label>
    <textarea
        name="description"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
    >{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block font-medium text-gray-700 mb-1">Preço</label>
    <input
        type="number"
        step="0.01"
        name="price"
        value="{{ old('price', $product->price ?? '') }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
    >
    @error('price')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-medium text-gray-700 mb-1">Estoque</label>
    <input
        type="number"
        name="stock"
        value="{{ old('stock', $product->stock ?? '') }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
    >
    @error('stock')
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
