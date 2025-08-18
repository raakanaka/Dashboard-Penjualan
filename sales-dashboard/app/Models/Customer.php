<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'customer_code',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the sales for the customer.
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Scope a query to only include active customers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the total sales count for the customer.
     */
    public function getTotalSalesAttribute()
    {
        return $this->sales()->count();
    }

    /**
     * Get the total amount spent by the customer.
     */
    public function getTotalSpentAttribute()
    {
        return $this->sales()->sum('final_amount');
    }

    /**
     * Get the average order value for the customer.
     */
    public function getAverageOrderValueAttribute()
    {
        $totalSales = $this->total_sales;
        return $totalSales > 0 ? $this->total_spent / $totalSales : 0;
    }

    /**
     * Get the formatted total spent.
     */
    public function getFormattedTotalSpentAttribute()
    {
        return 'Rp ' . number_format($this->total_spent, 0, ',', '.');
    }

    /**
     * Get the formatted average order value.
     */
    public function getFormattedAverageOrderValueAttribute()
    {
        return 'Rp ' . number_format($this->average_order_value, 0, ',', '.');
    }

    /**
     * Get the last order date for the customer.
     */
    public function getLastOrderDateAttribute()
    {
        $lastSale = $this->sales()->latest()->first();
        return $lastSale ? $lastSale->created_at : null;
    }

    /**
     * Get the formatted last order date.
     */
    public function getFormattedLastOrderDateAttribute()
    {
        return $this->last_order_date ? $this->last_order_date->format('M d, Y') : 'Never';
    }
}
