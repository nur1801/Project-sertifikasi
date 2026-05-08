<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Daging Ayam', 'description' => 'Produk olahan dan potongan ayam beku.'],
            ['name' => 'Seafood', 'description' => 'Ikan, udang, cumi, dan produk laut beku.'],
            ['name' => 'Daging Sapi', 'description' => 'Potongan daging sapi beku.'],
            ['name' => 'Sayuran Beku', 'description' => 'Sayuran siap masak dalam kondisi frozen.'],
            ['name' => 'Olahan Beku', 'description' => 'Nugget, sosis, bakso, dan makanan beku lainnya.'],
        ])->map(fn (array $category) => Category::create($category));

        $items = [
            [
                'category_id' => $categories->firstWhere('name', 'Daging Ayam')->id,
                'name' => 'Ayam Potong Frozen 1kg',
                'unit' => 'pack',
                'stock' => 48,
                'min_stock' => 20,
                'selling_price' => 32000,
                'purchase_price' => 27000,
                'weight' => '1 kg',
                'location' => 'Freezer A1',
                'description' => 'Ayam potong beku siap masak.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Daging Ayam')->id,
                'name' => 'Chicken Nugget Premium',
                'unit' => 'box',
                'stock' => 12,
                'min_stock' => 20,
                'selling_price' => 45000,
                'purchase_price' => 38000,
                'weight' => '500 gram',
                'location' => 'Freezer A2',
                'description' => 'Nugget ayam frozen untuk stok cepat saji.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Seafood')->id,
                'name' => 'Udang Kupas Frozen',
                'unit' => 'pack',
                'stock' => 6,
                'min_stock' => 15,
                'selling_price' => 68000,
                'purchase_price' => 59000,
                'weight' => '500 gram',
                'location' => 'Freezer B1',
                'description' => 'Udang kupas beku kualitas premium.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Seafood')->id,
                'name' => 'Ikan Dori Fillet',
                'unit' => 'pack',
                'stock' => 0,
                'min_stock' => 10,
                'selling_price' => 52000,
                'purchase_price' => 44000,
                'weight' => '1 kg',
                'location' => 'Freezer B2',
                'description' => 'Fillet ikan dori beku, stok habis untuk uji dashboard.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Daging Sapi')->id,
                'name' => 'Daging Sapi Slice',
                'unit' => 'pack',
                'stock' => 30,
                'min_stock' => 12,
                'selling_price' => 92000,
                'purchase_price' => 81000,
                'weight' => '1 kg',
                'location' => 'Freezer C1',
                'description' => 'Slice daging sapi frozen untuk restoran.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Daging Sapi')->id,
                'name' => 'Bakso Sapi Frozen',
                'unit' => 'box',
                'stock' => 18,
                'min_stock' => 20,
                'selling_price' => 37000,
                'purchase_price' => 30000,
                'weight' => '500 gram',
                'location' => 'Rak C2',
                'description' => 'Bakso sapi siap saji.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Sayuran Beku')->id,
                'name' => 'Mixed Vegetables',
                'unit' => 'pack',
                'stock' => 22,
                'min_stock' => 10,
                'selling_price' => 26000,
                'purchase_price' => 21000,
                'weight' => '250 gram',
                'location' => 'Freezer D1',
                'description' => 'Campuran sayuran beku untuk menu praktis.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Sayuran Beku')->id,
                'name' => 'Edamame Frozen',
                'unit' => 'pack',
                'stock' => 9,
                'min_stock' => 15,
                'selling_price' => 28000,
                'purchase_price' => 23000,
                'weight' => '250 gram',
                'location' => 'Freezer D2',
                'description' => 'Edamame beku siap kukus.',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Olahan Beku')->id,
                'name' => 'Sosis Sapi',
                'unit' => 'pack',
                'stock' => 55,
                'min_stock' => 20,
                'selling_price' => 35000,
                'purchase_price' => 29000,
                'weight' => '500 gram',
                'location' => 'Freezer E1',
                'description' => 'Sosis sapi frozen untuk sarapan cepat.',
            ],
            [
                'category_id' => null,
                'name' => 'Stok Tanpa Kategori',
                'unit' => 'pack',
                'stock' => 4,
                'min_stock' => 10,
                'selling_price' => 15000,
                'purchase_price' => 11000,
                'weight' => '250 gram',
                'location' => null,
                'description' => 'Data dummy untuk menguji item tanpa kategori.',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
