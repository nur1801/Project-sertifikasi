@extends('layouts.app')

@section('title', 'Bantuan - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Bantuan Aplikasi</h1>
        <p class="text-secondary mb-0">Panduan singkat penggunaan sistem informasi stok opname Frozeria.</p>
    </div>
</div>

<div class="card card-soft mb-4">
    <div class="card-body p-4">
        <h2 class="h5 fw-bold mb-3">Panduan Singkat</h2>
        <ol class="mb-0 ps-3">
            <li class="mb-2">Gunakan menu Dashboard untuk melihat total barang, stok menipis, stok habis, dan daftar item.</li>
            <li class="mb-2">Menu Kategori dipakai untuk menambah, mengubah, dan menghapus kelompok barang.</li>
            <li class="mb-2">Menu barang menyediakan input foto, stok, harga, lokasi, dan deskripsi produk.</li>
            <li class="mb-2">Gunakan tombol Detail untuk melihat informasi lengkap suatu barang.</li>
            <li>Hapus data hanya jika sudah dipastikan tidak diperlukan lagi. Kategori yang dihapus tidak akan menghapus item terkait.</li>
        </ol>
    </div>
</div>

<div class="card card-soft">
    <div class="card-body p-4">
        <h2 class="h5 fw-bold mb-3">Biodata Developer</h2>
        <div class="row g-3">
            <div class="col-md-6"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Nama</div><div class="fw-semibold">Nurhidayah</div></div></div>
            <div class="col-md-6"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">NIM</div><div class="fw-semibold">2241760044</div></div></div>
            <div class="col-md-6"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Kelas</div><div class="fw-semibold">SIB 4E</div></div></div>
            <div class="col-md-6"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Alamat</div><div class="fw-semibold">JL. L.A Sucipto</div></div></div>
            <div class="col-md-6"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">No Telp</div><div class="fw-semibold">089662703416</div></div></div>
            <div class="col-md-6"><div class="p-3 bg-light rounded-4"><div class="text-secondary small">Email</div><div class="fw-semibold">nurhid180701@gmail.com</div></div></div>
        </div>
    </div>
</div>
@endsection