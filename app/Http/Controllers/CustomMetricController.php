<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStat;
use App\Models\CustomMetric;
use App\Models\CustomMetricType;
use Illuminate\Support\Facades\Auth;

class CustomMetricController extends Controller
{

    public function create()
    {
        $metricTypes = CustomMetricType::where('user_id', Auth::id())->get();
        return view('custom_metrics.create', compact('metricTypes'));
    }


    public function index()
    {
        $customMetrics = CustomMetric::where('user_id', Auth::id())->with('customMetricType')->get();
        return view('custom_metrics.index', compact('customMetrics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daily_stat_id' => 'required|exists:daily_stats,id',
            'custom_metric_type_id' => 'required|exists:custom_metric_types,id',
            'value' => 'required',
        ]);
        
        $metricType = CustomMetricType::findOrFail($validated['custom_metric_type_id']);
        
        $customMetric = CustomMetric::create([
            'daily_stat_id' => $validated['daily_stat_id'],
            'custom_metric_type_id' => $metricType->id,
            'name' => $metricType->name,
            'type' => $metricType->type,
            'value' => $validated['value'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Custom metric added successfully.');
    }

    public function edit(CustomMetric $customMetric)
    {
        $this->authorize('update', $customMetric);
        $metricTypes = CustomMetricType::where('user_id', Auth::id())->get();
        return view('custom_metrics.edit', compact('customMetric', 'metricTypes'));
    }

    public function update(Request $request, CustomMetric $customMetric)
    {
        $this->authorize('update', $customMetric);

        $validated = $request->validate([
            'value' => 'required',
        ]);

        $customMetric->update($validated);
        return back()->with('success', 'Custom metric updated successfully.');
    }

    public function destroy(CustomMetric $customMetric)
    {
        $this->authorize('delete', $customMetric);

        $customMetric->delete();
        return back()->with('success', 'Custom metric deleted successfully.');
    }
}
