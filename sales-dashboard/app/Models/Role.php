<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission($permission)
    {
        $permissions = [
            'admin' => ['dashboard', 'customers', 'suppliers', 'inventory', 'sales', 'purchases', 'reports', 'advertisers', 'budgets', 'users'],
            'crm' => ['customers', 'sales', 'purchases'],
            'advertiser' => ['budgets', 'sales'],
            'warehouse' => ['inventory']
        ];

        return in_array($permission, $permissions[$this->name] ?? []);
    }
}
