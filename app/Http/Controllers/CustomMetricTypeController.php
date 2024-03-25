<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomMetricType;

class CustomMetricTypeController extends Controller
{

    public function create()
    {
        return view('custom_metric_types.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string', // 'numeric' or 'text'
        ]);

        CustomMetricType::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        return redirect()->route('custom_metric_types.index')->with('success', 'Custom metric type added successfully.');
    }


    public function index()
    {
        $types = CustomMetricType::where('user_id', auth()->id())->get();
        return view('custom_metric_types.index', compact('types'));
    }

    public function edit(CustomMetricType $customMetricType)
    {
        if (auth()->id() !== $customMetricType->user_id) {
            abort(403);
        }

        return view('custom_metric_types.edit', compact('customMetricType'));
    }
 
    public function update(Request $request, CustomMetricType $customMetricType)
    {
        if (auth()->id() !== $customMetricType->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string', // 'numeric' or 'text'
        ]);

        $customMetricType->update($validated);
        return redirect()->route('custom_metric_types.index')->with('success', 'Custom metric type updated successfully.');
    }

    public function destroy(CustomMetricType $customMetricType)
    {
        if (auth()->id() !== $customMetricType->user_id) {
            abort(403);
        }

        $customMetricType->delete();
        return back()->with('success', 'Custom metric type deleted successfully.');
    }
}

