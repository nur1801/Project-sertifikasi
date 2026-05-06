<?php

namespace App\Http\Controllers;

use App\Models\DaftarBarang;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $barang = DaftarBarang::query()
            ->latest()
            ->get();

        $kategoriList = DaftarBarang::query()
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori')
            ->values();

        $totalBarang = DaftarBarang::count();
        $totalStok = DaftarBarang::sum('stok');
        $nilaiPersediaan = DaftarBarang::sum('stok' ) * (float) DaftarBarang::avg('harga');

        return view('dashboard', compact('barang', 'kategoriList', 'totalBarang', 'totalStok', 'nilaiPersediaan'));
    }
}