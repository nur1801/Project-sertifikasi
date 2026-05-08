@extends('layouts.app')

@section('title', 'Detail Barang - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Detail Barang</h1>
        <p class="text-secondary mb-0">Informasi lengkap item beserta foto dan lokasinya.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-secondary">Edit</a>
        <a href="{{ route('items.index') }}" class="btn btn-outline-primary">Kembali</a>
    </div>
</div>

<div class="card card-soft mb-4">
    <div class="card-body p-4">
        <div class="row g-4 align-items-start">
            <div class="col-md-4 col-lg-3">
                <div class="border rounded-4 bg-light d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 280px;">
                    @if ($item->photo)
                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="text-center text-secondary p-4">
                            <div class="fw-semibold">Tidak ada foto</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge rounded-pill badge-soft-primary">{{ $item->category?->name ?? 'Tanpa kategori' }}</span>
                    <span class="badge rounded-pill text-bg-light text-dark">{{ $item->unit }}</span>
                </div>
                <h2 class="h3 fw-bold mb-2">{{ $item->name }}</h2>
                <p class="text-secondary mb-4">{{ $item->description ?? 'Tidak ada deskripsi.' }}</p>

                <div class="row g-3">
                    <div class="col-sm-6 col-xl-4"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Stok</div><div class="fw-bold fs-5">{{ $item->stock }}</div></div></div>
                    <div class="col-sm-6 col-xl-4"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Stok Minimum</div><div class="fw-bold fs-5">{{ $item->min_stock }}</div></div></div>
                    <div class="col-sm-6 col-xl-4"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Harga Jual</div><div class="fw-bold fs-5">Rp {{ number_format($item->selling_price, 0, ',', '.') }}</div></div></div>
                    <div class="col-sm-6 col-xl-4"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Harga Beli</div><div class="fw-bold fs-5">Rp {{ number_format($item->purchase_price, 0, ',', '.') }}</div></div></div>
                    <div class="col-sm-6 col-xl-4"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Berat / Ukuran</div><div class="fw-bold fs-5">{{ $item->weight ?? '-' }}</div></div></div>
                    <div class="col-sm-6 col-xl-4"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Lokasi</div><div class="fw-bold fs-5">{{ $item->location ?? '-' }}</div></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection