@extends('layouts.app')

@section('title', 'Edit Barang - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Edit Barang</h1>
        <p class="text-secondary mb-0">Perbarui data barang yang sudah tersimpan.</p>
    </div>
    <a href="{{ route('items.show', $item) }}" class="btn btn-outline-secondary">Detail</a>
</div>

<div class="card card-soft">
    <div class="card-body p-4">
        <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('items._form')
            @if ($item->photo)
                <div class="mt-4">
                    <div class="form-label fw-semibold">Foto Saat Ini</div>
                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="rounded border object-fit-cover" style="width: 180px; height: 180px;">
                </div>
            @endif
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('items.show', $item) }}" class="btn btn-outline-secondary">Batal</a>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection