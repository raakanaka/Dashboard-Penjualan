<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Admin can access everything
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Check if user has permission for the current route
        $routeName = $request->route()->getName();
        $permission = $this->getPermissionFromRoute($routeName);
        
        if ($permission && $user->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }

    private function getPermissionFromRoute($routeName)
    {
        $permissions = [
            'dashboard' => 'dashboard',
            'customers.index' => 'customers',
            'customers.create' => 'customers',
            'customers.store' => 'customers',
            'customers.show' => 'customers',
            'customers.edit' => 'customers',
            'customers.update' => 'customers',
            'customers.destroy' => 'customers',
            'suppliers.index' => 'suppliers',
            'suppliers.create' => 'suppliers',
            'suppliers.store' => 'suppliers',
            'suppliers.show' => 'suppliers',
            'suppliers.edit' => 'suppliers',
            'suppliers.update' => 'suppliers',
            'suppliers.destroy' => 'suppliers',
            'inventory.index' => 'inventory',
            'inventory.create' => 'inventory',
            'inventory.store' => 'inventory',
            'inventory.show' => 'inventory',
            'inventory.edit' => 'inventory',
            'inventory.update' => 'inventory',
            'inventory.destroy' => 'inventory',
            'inventory.stock-alert' => 'inventory',
            'sales.index' => 'sales',
            'sales.create' => 'sales',
            'sales.store' => 'sales',
            'sales.show' => 'sales',
            'sales.edit' => 'sales',
            'sales.update' => 'sales',
            'sales.destroy' => 'sales',
            'purchases.index' => 'purchases',
            'purchases.create' => 'purchases',
            'purchases.store' => 'purchases',
            'purchases.show' => 'purchases',
            'purchases.edit' => 'purchases',
            'purchases.update' => 'purchases',
            'purchases.destroy' => 'purchases',
            'advertisers.index' => 'advertisers',
            'advertisers.create' => 'advertisers',
            'advertisers.store' => 'advertisers',
            'advertisers.show' => 'advertisers',
            'advertisers.edit' => 'advertisers',
            'advertisers.update' => 'advertisers',
            'advertisers.destroy' => 'advertisers',
            'budgets.index' => 'budgets',
            'budgets.create' => 'budgets',
            'budgets.store' => 'budgets',
            'budgets.show' => 'budgets',
            'budgets.edit' => 'budgets',
            'budgets.update' => 'budgets',
            'budgets.destroy' => 'budgets',
            'users.index' => 'users',
            'users.create' => 'users',
            'users.store' => 'users',
            'users.show' => 'users',
            'users.edit' => 'users',
            'users.update' => 'users',
            'users.destroy' => 'users',
        ];

        return $permissions[$routeName] ?? null;
    }
}
