@extends('layouts.app')

@section('title', 'Bantuan - Frozeria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title h3 mb-1">Bantuan Aplikasi</h1>
        <p class="text-secondary mb-0">Panduan singkat penggunaan sistem informasi stok opname Frozeria.</p>
    </div>
</div>

<h2 class="h5 fw-bold mb-3">Panduan Penggunaan Sistem</h2>

<div class="card card-soft mb-4">
    <div class="card-body p-4">
        <h3 class="h6 fw-bold mb-3">Cara menambah barang baru</h3>
        <ol class="mb-0 ps-3">
            <li class="mb-2">Buka halaman Dashboard. Klik tombol <span class="badge bg-primary">+ Tambah Barang</span></li>
            <li class="mb-2">Unggah foto barang, isi formulir nama, kategori, satuan jumlah stok, harga, dan lainnya.</li>
            <li class="mb-0">Klik Simpan Barang. Barang akan muncul di daftar dashboard.</li>
        </ol>
    </div>
</div>

<div class="card card-soft mb-4">
    <div class="card-body p-4">
        <h3 class="h6 fw-bold mb-3">Cara update stok barang masuk</h3>
        <ol class="mb-0 ps-3">
            <li class="mb-2">Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.</li>
            <li class="mb-2">Klik tombol <span class="badge bg-warning">Edit</span> pada baris barang tersebut.</li>
            <li class="mb-0">Ubah nilai Jumlah stok sesuai kondisi saat ini. Klik Simpan Barang.</li>
        </ol>
    </div>
</div>

<div class="card card-soft mb-4">
    <div class="card-body p-4">
        <h3 class="h6 fw-bold mb-3">Cara mengelola kategori</h3>
        <ol class="mb-0 ps-3">
            <li class="mb-2">Buka halaman <span class="badge bg-info">Kategori</span> dari navigasi atas.</li>
            <li class="mb-2">Tambah, edit, atau hapus kategori sesuai kebutuhan loka.</li>
            <li class="mb-0">Menghapus kategori tidak akan menghapus barang — barang akan menjadi tidak berkategori.</li>
        </ol>
    </div>
</div>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" viewBox="0 0 16 16" fill="currentColor"></svg>
    <strong>Catatan:</strong> Satuan barang diberi besaran kebutuhan — misalnya pcs, pack, box, kg, liter, dan lain-lain.
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