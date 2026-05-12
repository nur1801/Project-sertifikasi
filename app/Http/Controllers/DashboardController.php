<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();
        $categoryId = $request->input('category_id');

        $baseQuery = Item::query();

        $totalItems = (clone $baseQuery)->count();
        $lowStockItems = (clone $baseQuery)
            ->where('stock', '<', 20)
            ->where('stock', '>', 0)
            ->count();
        $outOfStockItems = (clone $baseQuery)->where('stock', 0)->count();
        $totalCategories = Category::query()->count();

        $items = Item::query()
            ->with('category')
            ->when($search, fn($query) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($categoryId, fn($query) => $query->where('category_id', $categoryId))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('dashboard', [
            'items' => $items,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId,
            'total_items' => $totalItems,
            'low_stock_items' => $lowStockItems,
            'out_of_stock_items' => $outOfStockItems,
            'total_categories' => $totalCategories,
        ]);
    }
}
