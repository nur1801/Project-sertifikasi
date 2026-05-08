<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_summary_and_filtered_items(): void
    {
        $this->withoutExceptionHandling();

        $category = Category::create([
            'name' => 'Seafood',
            'description' => 'Produk laut beku',
        ]);

        Item::create([
            'category_id' => $category->id,
            'name' => 'Udang Kupas Frozen',
            'photo' => null,
            'unit' => 'pack',
            'stock' => 5,
            'min_stock' => 10,
            'selling_price' => 65000,
            'purchase_price' => 54000,
            'weight' => '500 gram',
            'location' => 'Freezer A1',
            'description' => 'Data uji dashboard',
        ]);

        Item::create([
            'category_id' => null,
            'name' => 'Sosis Frozen',
            'photo' => null,
            'unit' => 'box',
            'stock' => 0,
            'min_stock' => 10,
            'selling_price' => 42000,
            'purchase_price' => 35000,
            'weight' => '1 kg',
            'location' => 'Freezer A2',
            'description' => 'Data uji stok habis',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Total Barang');
        $response->assertSee('Stok Menipis');
        $response->assertSee('Stok Habis');
        $response->assertSee('Udang Kupas Frozen');
        $response->assertSee('Sosis Frozen');
    }
}