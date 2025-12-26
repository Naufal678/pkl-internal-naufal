<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Menambahkan subtotal ke output JSON/Array
    protected $appends = ['subtotal'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Accessor Subtotal
     * Catatan: Pastikan selalu eager load 'product' untuk menghindari query berulang
     */
    public function getSubtotalAttribute(): float|int
    {
        return ($this->product->price ?? 0) * $this->quantity;
    }
}