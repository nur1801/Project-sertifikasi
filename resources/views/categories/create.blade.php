@extends('layouts.app')

@section('title', 'Tambah Kategori - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Tambah Kategori</h1>
        <p class="text-secondary mb-0">Buat kategori baru untuk barang makanan beku.</p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card card-soft">
    <div class="card-body p-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection