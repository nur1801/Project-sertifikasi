@extends('layouts.app')

@section('title', 'Detail Kategori - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Detail Kategori</h1>
        <p class="text-secondary mb-0">Informasi kategori dan jumlah item yang terhubung.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-secondary">Edit</a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Kembali</a>
    </div>
</div>

<div class="card card-soft">
    <div class="card-body p-4">
        <h2 class="h3 fw-bold mb-3">{{ $category->name }}</h2>
        <div class="mb-3">
            <span class="badge rounded-pill badge-soft-primary">{{ $category->items_count ?? $category->items()->count() }} item</span>
        </div>
        <p class="text-secondary mb-0">{{ $category->description ?? 'Tidak ada deskripsi.' }}</p>
    </div>
</div>
@endsection