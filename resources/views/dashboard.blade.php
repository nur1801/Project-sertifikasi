@extends('layouts.app')

@section('title', 'Dashboard - Frozeria')

@section('content')
<div class="hero-panel p-4 p-lg-5 mb-4 card-soft">
    <div class="row align-items-center g-4 position-relative" style="z-index: 1;">
        <div class="col-lg-8">
            <span class="badge rounded-pill text-bg-light text-dark mb-3">Sistem Informasi Stok Opname</span>
            <h1 class="display-6 fw-bold mb-3">Frozeria</h1>
            <p class="mb-4 text-white-50 fs-6">
                Pantau stok makanan beku, kategori barang, dan kondisi persediaan secara cepat dalam satu dashboard.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('items.create') }}" class="btn btn-light fw-semibold">+ Tambah Barang</a>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-light fw-semibold">Kelola Kategori</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row g-3">
                <div class="col-6">
                    <div class="hero-stat p-3 h-100">
                        <div class="text-white-50 small">Total Barang</div>
                        <div class="fs-3 fw-bold text-light">{{ $total_items }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="hero-stat p-3 h-100">
                        <div class="text-white-50 small">Total Kategori</div>
                        <div class="fs-3 fw-bold text-info">{{ $total_categories }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="hero-stat p-3 h-100">
                        <div class="text-white-50 small">Stok Menipis</div>
                        <div class="fs-3 fw-bold text-warning">{{ $low_stock_items }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="hero-stat p-3 h-100">
                        <div class="text-white-50 small">Stok Habis</div>
                        <div class="fs-3 fw-bold text-danger">{{ $out_of_stock_items }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-soft mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end" method="GET" action="{{ route('dashboard') }}">
            <div class="col-lg-6">
                <label class="form-label fw-semibold">Cari nama barang</label>
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Contoh: Ayam, Nugget, Udang">
            </div>
            <div class="col-lg-4">
                <label class="form-label fw-semibold">Filter kategori</label>
                <select name="category_id" class="form-select">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 d-grid gap-2">
                <button class="btn btn-primary">Cari</button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card card-soft">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h2 class="page-title h4 mb-1">Data Barang</h2>
                <div class="text-secondary">Menampilkan daftar barang makanan beku yang tersimpan di sistem.</div>
            </div>
            <a href="{{ route('items.create') }}" class="btn btn-primary">+ Tambah Barang</a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th style="width: 80px;">Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th class="text-end">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>
                            <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center overflow-hidden" style="width: 60px; height: 60px;">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <svg class="text-secondary" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l2.828 2.828a2 2 0 0 1 .586 1.414V9.5a.5.5 0 0 1-1 0V6.414a1 1 0 0 0-.293-.707L5.586 3.586A1 1 0 0 0 5.172 3H2.5a1 1 0 0 0-1 1v.5a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5v-.5z"/>
                                        <path d="M16 12.5V4.032a2 2 0 0 0-.656-1.414L14.828.586A2 2 0 0 0 13.414 0H2.5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11.5a2 2 0 0 0 2-2zm-1-12.5h-2v6h2V.5zM2 3a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h6V2H2zm7 0v10h2a1 1 0 0 0 1-1V3h-3z"/>
                                    </svg>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $item->name }}</div>
                            <div class="text-secondary small">{{ $item->location ?? '-' }}</div>
                        </td>
                        <td>
                            @if ($item->category)
                                <span class="badge rounded-pill badge-soft-primary">{{ $item->category->name }}</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Tanpa kategori</span>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold @if ($item->stock == 0) text-danger @elseif ($item->stock < 20) text-warning @else text-success @endif">
                                {{ $item->stock }}
                            </span>
                        </td>
                        <td>{{ $item->unit }}</td>
                        <td>Rp {{ number_format($item->selling_price, 0, ',', '.') }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end action-links">
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteItemModal{{ $item->id }}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-secondary">Belum ada data barang.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @foreach ($items as $item)
            <div class="modal fade" id="deleteItemModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus <strong>{{ $item->name }}</strong>? Tindakan ini tidak bisa dibatalkan.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('items.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
            <div class="text-secondary small">
                Menampilkan {{ $items->firstItem() ?? 0 }} sampai {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} data.
            </div>
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
