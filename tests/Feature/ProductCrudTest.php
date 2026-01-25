<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_products(): void
    {
        $response = $this->get('/products');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_products_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/products');
        $response->assertOk();
        $response->assertSee('Produtos');
    }

    public function test_authenticated_user_can_create_product(): void
    {
        $user = User::factory()->create();

        $payload = [
            'name' => 'Energético Premium',
            'description' => 'Teste descrição',
            'price' => '12.90',
            'stock' => 10,
        ];

        $response = $this->actingAs($user)->post('/products', $payload);

        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'name' => 'Energético Premium',
            'stock' => 10,
        ]);
    }

    public function test_authenticated_user_can_update_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Energético de Uva',
            'price' => 7.80,
            'stock' => 5,
        ]);

        $payload = [
            'name' => 'Energético de Uva (Atualizado)',
            'description' => $product->description,
            'price' => '8.10',
            'stock' => 20,
        ];

        $response = $this->actingAs($user)->put("/products/{$product->id}", $payload);

        $response->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Energético de Uva (Atualizado)',
            'stock' => 20,
        ]);
    }

    public function test_authenticated_user_can_delete_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete("/products/{$product->id}");

        $response->assertRedirect('/products');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
