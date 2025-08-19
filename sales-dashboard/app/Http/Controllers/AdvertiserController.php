<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertiser;
use Illuminate\Support\Facades\Auth;

class AdvertiserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,advertiser');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisers = Advertiser::orderBy('name')->paginate(15);
        
        return view('advertisers.index', compact('advertisers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advertisers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:advertisers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean'
        ]);

        Advertiser::create($request->all());

        return redirect()->route('advertisers.index')
            ->with('success', 'Advertiser created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertiser $advertiser)
    {
        return view('advertisers.show', compact('advertiser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertiser $advertiser)
    {
        return view('advertisers.edit', compact('advertiser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertiser $advertiser)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:advertisers,email,' . $advertiser->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean'
        ]);

        $advertiser->update($request->all());

        return redirect()->route('advertisers.index')
            ->with('success', 'Advertiser updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertiser $advertiser)
    {
        $advertiser->delete();

        return redirect()->route('advertisers.index')
            ->with('success', 'Advertiser deleted successfully.');
    }
}
