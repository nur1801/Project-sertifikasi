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
            <div class="hero-stat p-3 mb-3">
                <div class="text-white-50 small">Total Barang</div>
                <div class="stat-number">{{ $total_items }}</div>
            </div>
            <div class="row g-3">
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
                            @if ($item->stock == 0)
                                <span class="badge rounded-pill badge-soft-danger">Habis</span>
                            @elseif ($item->stock < 20)
                                <span class="badge rounded-pill badge-soft-warning">Menipis</span>
                            @else
                                <span class="badge rounded-pill text-bg-success">{{ $item->stock }}</span>
                            @endif
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
                        <td colspan="6" class="text-center py-5 text-secondary">Belum ada data barang.</td>
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
