<?php

namespace App\Http\Controllers;


use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $service
    ) {}

    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->service->update($product, $request->validated());
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso');
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return redirect()->route('products.index')->with('success', 'Produto removido com sucesso');
    }
}
