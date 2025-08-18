<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_number',
        'supplier_id',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'final_amount',
        'payment_method',
        'status',
        'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];

    /**
     * Get the supplier that owns the purchase.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the purchase items for the purchase.
     */
    public function items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Scope a query to only include completed purchases.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include pending purchases.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include cancelled purchases.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Get the formatted total amount.
     */
    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Get the formatted tax amount.
     */
    public function getFormattedTaxAmountAttribute()
    {
        return 'Rp ' . number_format($this->tax_amount, 0, ',', '.');
    }

    /**
     * Get the formatted discount amount.
     */
    public function getFormattedDiscountAmountAttribute()
    {
        return 'Rp ' . number_format($this->discount_amount, 0, ',', '.');
    }

    /**
     * Get the formatted final amount.
     */
    public function getFormattedFinalAmountAttribute()
    {
        return 'Rp ' . number_format($this->final_amount, 0, ',', '.');
    }

    /**
     * Get the status badge class.
     */
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'completed':
                return 'success';
            case 'pending':
                return 'warning';
            case 'cancelled':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    /**
     * Get the payment method badge class.
     */
    public function getPaymentMethodBadgeAttribute()
    {
        switch ($this->payment_method) {
            case 'cash':
                return 'success';
            case 'credit_card':
                return 'info';
            case 'bank_transfer':
                return 'warning';
            default:
                return 'secondary';
        }
    }

    /**
     * Get the total items count.
     */
    public function getTotalItemsAttribute()
    {
        return $this->items()->sum('quantity');
    }

    /**
     * Get the items count.
     */
    public function getItemsCountAttribute()
    {
        return $this->items()->count();
    }
}
