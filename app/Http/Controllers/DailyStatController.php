<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStat;
use App\Models\CustomMetric;
use App\Models\CustomMetricType;


class DailyStatController extends Controller
{    
    public function index()
    {
        $dailystats = DailyStat::where('user_id', auth()->id())->orderBy('date', 'desc')->get();
        return view('dailystats.index', compact('dailystats'));
    }

    public function create()
    {
        $metricTypes = CustomMetricType::where('user_id', auth()->id())->get();
        return view('dailystats.create', compact('metricTypes'));
    }
 
    public function show(DailyStat $dailystat)
    {        
        if(auth()->id() !== $dailystat->user_id) {
            abort(403);
        }

        return view('dailystats.show', compact('dailystat'));
    }
        
    public function store(Request $request)
{
    $customMessages = [
        'hours.required' => 'The time field is required.',
        'metrics.*.value.required' => 'Each metric must have a value.',
    ];
    $validated = $request->validate([
        'date' => 'required|date',
        'hours' => 'required|integer',
        'minutes' => 'required|integer',
        'quality_score' => 'required|string',
        'diary' => 'nullable|string',
        'metrics' => 'nullable|array',
        'metrics.*.type_id' => 'exists:custom_metric_types,id',
        'metrics.*.value' => 'required',
    ], $customMessages);

    $totalMinutes = $validated['hours'] * 60 + $validated['minutes'];

    $dailystat = DailyStat::create([
        'user_id' => auth()->id(),
        'date' => $validated['date'],
        'time' => $totalMinutes,
        'quality_score' => $validated['quality_score'],
        'diary' => $validated['diary'],
    ]);

    if (isset($validated['metrics'])) {
        foreach ($validated['metrics'] as $metric) {
            $metricType = CustomMetricType::find($metric['type_id']);
            if ($metricType) {
                CustomMetric::create([
                    'daily_stat_id' => $dailystat->id,
                    'custom_metric_type_id' => $metric['type_id'],
                    'name' => $metricType->name,
                    'type' => $metricType->type,
                    'value' => $metric['value'],
                    'user_id' => auth()->id(),
                ]);
            }
        }
    }

    return redirect()->route('dailystats.index')->with('success', 'DailyStat created successfully.');
}

 
    public function edit(DailyStat $dailystat)
    { 
        if(auth()->id() !== $dailystat->user_id) {
            abort(403);
        }
        
        $metricTypes = CustomMetricType::where('user_id', auth()->id())->get();
        return view('dailystats.edit', compact('dailystat', 'metricTypes'));
    }
 
    public function update(Request $request, DailyStat $dailystat)
{

    $customMessages = [
        'hours.required' => 'The time field is required.',
        'metrics.*.value.required' => 'Each metric must have a value.',
    ];
    $validated = $request->validate([
        'date' => 'required|date',
        'hours' => 'required|integer',
        'minutes' => 'required|integer',
        'quality_score' => 'required|string',
        'diary' => 'nullable|string',
        'metrics' => 'nullable|array',
        'metrics.*.type_id' => 'exists:custom_metric_types,id',
        'metrics.*.value' => 'required',
    ], [$customMessages]);

    $totalMinutes = $validated['hours'] * 60 + $validated['minutes'];

    $dailystat->update([
        'date' => $validated['date'],
        'time' => $totalMinutes,
        'quality_score' => $validated['quality_score'],
        'diary' => $validated['diary'],
    ]);

    if (isset($validated['metrics'])) {
        $existingMetrics = $dailystat->customMetrics->keyBy('custom_metric_type_id');

        foreach ($validated['metrics'] as $metric) {
            $metricType = CustomMetricType::find($metric['type_id']);
            if ($metricType) {
                if (isset($existingMetrics[$metric['type_id']])) {
                    $existingMetrics[$metric['type_id']]->update([
                        'value' => $metric['value'],
                        'name' => $metricType->name,
                        'type' => $metricType->type,
                    ]);
                } else {
                    CustomMetric::create([
                        'daily_stat_id' => $dailystat->id,
                        'custom_metric_type_id' => $metric['type_id'],
                        'value' => $metric['value'],
                        'name' => $metricType->name,
                        'type' => $metricType->type,
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }
    }

    return redirect()->route('dailystats.index')->with('success', 'DailyStat updated successfully.');
}


    public function destroy(DailyStat $dailystat)
    {                
        if (auth()->id() !== $dailystat->user_id) {            
            abort(403);
        }
        
        $dailystat->delete();
        return back()->with('success', 'DailyStat deleted successfully.');
    }
} 

