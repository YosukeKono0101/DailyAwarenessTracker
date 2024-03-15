<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStat;

class DailyStatController extends Controller
{

    // Read
    public function index(){
        $dailystats = DailyStat::all();
        return view("dailystats.index", compact('dailystats'));
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
                     
        DailyStat::create($dataToStore);        
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
                     
        DailyStat::create($dataToStore);        
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

