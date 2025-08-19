<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Advertiser;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
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
        $budgets = Budget::with('advertiser')->orderBy('created_at', 'desc')->paginate(15);
        
        return view('budgets.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advertisers = Advertiser::where('is_active', true)->orderBy('name')->get();
        return view('budgets.create', compact('advertisers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'advertiser_id' => 'required|exists:advertisers,id',
            'campaign_name' => 'required|string|max:255',
            'budget_amount' => 'required|numeric|min:0',
            'spent_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,paused,completed,cancelled',
            'description' => 'nullable|string'
        ]);

        Budget::create($request->all());

        return redirect()->route('budgets.index')
            ->with('success', 'Budget created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        return view('budgets.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        $advertisers = Advertiser::where('is_active', true)->orderBy('name')->get();
        return view('budgets.edit', compact('budget', 'advertisers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'advertiser_id' => 'required|exists:advertisers,id',
            'campaign_name' => 'required|string|max:255',
            'budget_amount' => 'required|numeric|min:0',
            'spent_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,paused,completed,cancelled',
            'description' => 'nullable|string'
        ]);

        $budget->update($request->all());

        return redirect()->route('budgets.index')
            ->with('success', 'Budget updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budgets.index')
            ->with('success', 'Budget deleted successfully.');
    }
}
