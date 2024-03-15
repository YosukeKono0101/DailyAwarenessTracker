<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomMetric;

class CustomMetricController extends Controller
{    
    public function store(Request $request){
    $validatedData = $request->validate([
        'metric_name' => 'required|string|max:255',
        'metric_type' => 'required|string',
        'metric_value' => 'required',
    ]);

    $customMetric = new CustomMetric();
    $customMetric->user_id = auth()->id();
    $customMetric->metric_name = $validatedData['metric_name'];
    $customMetric->metric_type = $validatedData['metric_type'];
    $customMetric->metric_value = $validatedData['metric_value'];
    $customMetric->save();

    return redirect()->route('custom_metrics.index')->with('success', 'Custom Metric Added');
    }

}


