@extends('layouts.app')

@section('title', 'Tambah Barang - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Tambah Barang</h1>
        <p class="text-secondary mb-0">Lengkapi data barang makanan beku baru.</p>
    </div>
    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card card-soft">
    <div class="card-body p-4">
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @include('items._form')
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection