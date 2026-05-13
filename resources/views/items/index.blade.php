@extends('layouts.app')

@section('title', 'Data Barang - Frozeria')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Data Barang</h1>
        <p class="text-secondary mb-0">Menampilkan daftar barang makanan beku yang tersimpan di sistem.</p>
    </div>
    <a href="{{ route('items.create') }}" class="btn btn-primary">+ Tambah Barang</a>
</div>

<div class="card card-soft">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Foto</th>
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
                    @php
                        $stockClass = 'text-success';
                        if ($item->stock <= 0) {
                            $stockClass = 'text-danger';
                        } elseif ($item->stock <= $item->min_stock) {
                            $stockClass = 'text-warning';
                        }
                    @endphp
                    <tr>
                        <td style="width: 64px;">
                            @if ($item->photo)
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="rounded-3 border object-fit-cover" width="48" height="48">
                            @else
                                <div class="rounded-3 border bg-light d-flex align-items-center justify-content-center text-secondary small" style="width: 48px; height: 48px;">-</div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $item->name }}</div>
                            <div class="text-secondary small">{{ $item->location ?? '-' }}</div>
                        </td>
                        <td><span class="badge rounded-pill text-secondary bg-light border border-secondary-subtle">{{ $item->category?->name ?? 'Tanpa kategori' }}</span></td>
                        <td class="fw-semibold {{ $stockClass }}">{{ $item->stock }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>Rp {{ number_format($item->selling_price, 0, ',', '.') }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Hapus</button>
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
            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">Yakin hapus <strong>{{ $item->name }}</strong>?</div>
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

        <div class="mt-3">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection