<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStat;
use App\Models\CustomMetric;

class DailyStatController extends Controller
{
    // Read
    public function index(){
    $dailystats = DailyStat::orderBy('date', 'desc')->get();
    return view('dailystats.index', compact('dailystats'));
    }
    public function show($id) {
        $dailystat = DailyStat::findOrFail($id);
        return view('dailystats.show', compact('dailystat'));
    }
    // Create
    public function create() {
        return view('dailystats.create');
    }

    public function store(Request $request) {    
        $validatedData = $request->validate([            
            'date' => 'required|date',
            'hours' => 'required|integer',
            'minutes' => 'required|integer',
            'quality_score' => 'required|string',
            'diary' => 'nullable|string|max:1000'
        ]);                
    
        $totalMinutes = $validatedData['hours'] * 60 + $validatedData['minutes'];
        
        $dataToStore = [
            'user_id' => auth()->id(),
            'date' => $validatedData['date'],
            'time' => $totalMinutes,
            'quality_score' => $validatedData['quality_score'],
            'diary' => $validatedData['diary'] ?? null
        ];

        $existingDailyStat = DailyStat::where('user_id', auth()->id())
                                        ->whereDate('date', $validatedData['date'])
                                        ->first();
        if($existingDailyStat) { 
            return redirect()->back()->withInput()->with('date_error', 'You have already entered data for this date.');

        }
        
        $dailyStat = DailyStat::create($dataToStore);
            
        $customMetrics = $request->get('custom_metrics', []);
        foreach ($customMetrics as $metric) {
            if (empty($metric['name'])) {
                continue;
            }
            CustomMetric::create([
                'daily_stat_id' => $dailyStat->id,
                'user_id' => auth()->id(),
                'name' => $metric['name'],
                'value' => $metric['value'],
            ]);
        }                     
        return redirect()->route('dailystats.index')
            ->with('success', 'DailyStats created successfully');
    }

    // Edit
    public function edit($id){
        $dailystat = DailyStat::findOrFail($id);
        return view('dailystats.edit', compact('dailystat'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([            
            'date' => 'required|date',
            'hours' => 'required|integer',
            'minutes' => 'required|integer',
            'quality_score' => 'required|string',
            'diary' => 'nullable|string|max:1000'
        ]);                
    
        $totalMinutes = $validatedData['hours'] * 60 + $validatedData['minutes'];
        
        $dataToStore = [
            'user_id' => auth()->id(),
            'date' => $validatedData['date'],
            'time' => $totalMinutes,
            'quality_score' => $validatedData['quality_score'],
            'diary' => $validatedData['diary'] ?? null
        ];
    
        $dailyStat = DailyStat::create($dataToStore);
            
        $customMetrics = $request->get('custom_metrics', []);
        foreach ($customMetrics as $metric) {
            if (empty($metric['name'])) {
                continue;
            }
            CustomMetric::create([
                'daily_stat_id' => $dailyStat->id,
                'user_id' => auth()->id(),
                'name' => $metric['name'],
                'value' => $metric['value'],
            ]);
        }                       
        return redirect()->route('dailystats.index')
            ->with('success','DailyStat updated successfully');
    }

    // Destroy
    public function destroy($id) {
        $dailystat = DailyStat::findOrFail($id);
        $dailystat->delete();
        return redirect()->route('dailystats.index')
          ->with('success', 'DailyStat deleted successfully');
    }        
}

