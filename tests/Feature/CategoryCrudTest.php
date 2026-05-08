<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_update_and_delete_category_without_removing_items(): void
    {
        $createResponse = $this->post('/categories', [
            'name' => 'Daging Ayam',
            'description' => 'Kategori ayam beku',
        ]);

        $createResponse->assertRedirect('/categories');

        $category = Category::query()->where('name', 'Daging Ayam')->firstOrFail();

        $updateResponse = $this->put('/categories/' . $category->id, [
            'name' => 'Daging Ayam Premium',
            'description' => 'Kategori ayam beku premium',
        ]);

        $updateResponse->assertRedirect('/categories');

        $item = Item::create([
            'category_id' => $category->id,
            'name' => 'Ayam Potong Frozen',
            'photo' => null,
            'unit' => 'pack',
            'stock' => 12,
            'min_stock' => 8,
            'selling_price' => 35000,
            'purchase_price' => 29000,
            'weight' => '1 kg',
            'location' => 'Freezer A1',
            'description' => 'Item untuk tes delete kategori',
        ]);

        $deleteResponse = $this->delete('/categories/' . $category->id);
        $deleteResponse->assertRedirect('/categories');

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'category_id' => null,
        ]);
    }
}