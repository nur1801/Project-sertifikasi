<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ItemCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_update_and_delete_item_with_photo(): void
    {
        Storage::fake('public');

        $category = Category::create([
            'name' => 'Olahan Beku',
            'description' => 'Kategori uji',
        ]);

        $createResponse = $this->post('/items', [
            'category_id' => $category->id,
            'name' => 'Nugget Ayam Premium',
            'photo' => UploadedFile::fake()->image('nugget.jpg'),
            'unit' => 'box',
            'stock' => 20,
            'min_stock' => 10,
            'selling_price' => 46000,
            'purchase_price' => 38000,
            'weight' => '500 gram',
            'location' => 'Freezer B1',
            'description' => 'Data create item',
        ]);

        $createResponse->assertRedirect('/items');

        $item = Item::query()->where('name', 'Nugget Ayam Premium')->firstOrFail();
        Storage::disk('public')->assertExists($item->photo);

        $updateResponse = $this->put('/items/' . $item->id, [
            'category_id' => $category->id,
            'name' => 'Nugget Ayam Super',
            'photo' => UploadedFile::fake()->image('nugget-baru.jpg'),
            'unit' => 'box',
            'stock' => 18,
            'min_stock' => 10,
            'selling_price' => 49000,
            'purchase_price' => 40000,
            'weight' => '500 gram',
            'location' => 'Freezer B2',
            'description' => 'Data update item',
        ]);

        $updateResponse->assertRedirect('/items');

        $item->refresh();
        $this->assertSame('Nugget Ayam Super', $item->name);

        $deleteResponse = $this->delete('/items/' . $item->id);
        $deleteResponse->assertRedirect('/items');

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}