<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertiser_id',
        'campaign_name',
        'budget_amount',
        'spent_amount',
        'start_date',
        'end_date',
        'status',
        'description'
    ];

    protected $casts = [
        'budget_amount' => 'decimal:2',
        'spent_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function getRemainingAmountAttribute()
    {
        return $this->budget_amount - $this->spent_amount;
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->budget_amount == 0) return 0;
        return min(100, ($this->spent_amount / $this->budget_amount) * 100);
    }
}
