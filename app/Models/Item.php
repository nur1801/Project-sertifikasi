<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'photo',
        'unit',
        'stock',
        'min_stock',
        'selling_price',
        'purchase_price',
        'weight',
        'location',
        'description',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'stock' => 'integer',
        'min_stock' => 'integer',
        'selling_price' => 'integer',
        'purchase_price' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}