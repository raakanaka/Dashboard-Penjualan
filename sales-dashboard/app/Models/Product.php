<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sku',
        'selling_price',
        'cost_price',
        'stock_quantity',
        'reorder_level',
        'category_id',
        'image',
        'is_active'
    ];

    protected $casts = [
        'selling_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'reorder_level' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the sale items for the product.
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Get the purchase items for the product.
     */
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include low stock products.
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('stock_quantity <= reorder_level');
    }

    /**
     * Scope a query to only include out of stock products.
     */
    public function scopeOutOfStock($query)
    {
        return $query->where('stock_quantity', 0);
    }

    /**
     * Get the stock status of the product.
     */
    public function getStockStatusAttribute()
    {
        if ($this->stock_quantity == 0) {
            return 'out_of_stock';
        } elseif ($this->stock_quantity <= $this->reorder_level) {
            return 'low_stock';
        } else {
            return 'available';
        }
    }

    /**
     * Get the stock status badge class.
     */
    public function getStockStatusBadgeAttribute()
    {
        switch ($this->stock_status) {
            case 'out_of_stock':
                return 'danger';
            case 'low_stock':
                return 'warning';
            default:
                return 'success';
        }
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the formatted cost price.
     */
    public function getFormattedCostPriceAttribute()
    {
        return 'Rp ' . number_format($this->cost_price, 0, ',', '.');
    }

    /**
     * Get the total stock value.
     */
    public function getStockValueAttribute()
    {
        return $this->stock * $this->price;
    }

    /**
     * Get the formatted stock value.
     */
    public function getFormattedStockValueAttribute()
    {
        return 'Rp ' . number_format($this->stock_value, 0, ',', '.');
    }
}
