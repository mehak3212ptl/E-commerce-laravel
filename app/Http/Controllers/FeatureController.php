<?php
namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function create(Request $request)
    {
        $plan_id = $request->query('plan_id');
        $plan = Plan::findOrFail($plan_id);
        return view('features.create', compact('plan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'description' => 'required|string|max:255',
        ]);

        Feature::create($validated);
        return redirect()->route('plans.index')->with('success', 'Feature added successfully.');
    }

    public function edit(Feature $feature)
    {
        return view('features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $feature->update($validated);
        return redirect()->route('plans.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('plans.index')->with('success', 'Feature deleted successfully.');
    }
}
