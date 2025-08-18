<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'discount'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    /**
     * Get the purchase that owns the purchase item.
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Get the product that owns the purchase item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the formatted unit price.
     */
    public function getFormattedUnitPriceAttribute()
    {
        return 'Rp ' . number_format($this->unit_price, 0, ',', '.');
    }

    /**
     * Get the formatted total price.
     */
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    /**
     * Get the formatted discount.
     */
    public function getFormattedDiscountAttribute()
    {
        return 'Rp ' . number_format($this->discount, 0, ',', '.');
    }

    /**
     * Get the net price (total price - discount).
     */
    public function getNetPriceAttribute()
    {
        return $this->total_price - $this->discount;
    }

    /**
     * Get the formatted net price.
     */
    public function getFormattedNetPriceAttribute()
    {
        return 'Rp ' . number_format($this->net_price, 0, ',', '.');
    }
}
