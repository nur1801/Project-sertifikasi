<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarBarang extends Model
{
    use HasFactory;

    protected $table = 'daftar_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'satuan',
        'stok',
        'harga',
        'deskripsi',
    ];

    protected $casts = [
        'stok' => 'integer',
        'harga' => 'decimal:2',
    ];
}