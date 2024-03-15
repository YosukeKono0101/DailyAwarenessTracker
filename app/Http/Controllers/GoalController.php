<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    // Read
    public function index() {
        $goals = Goal::all();
        return view("goals.index", compact("goals"));
    }

    public function show($id) {
        $goal = Goal::findOrFail($id);
        return view("goals.show", compact('goal'));
    }

    // Create
    public function create(){
        return view("goals.create");
    }

    public function store(Request $request) {        
        $validatedData = $request->validate([            
            'title' => 'required|max:255', // Title required with the limit of 255 letters
            'notes' => 'nullable|max:1000', // Notes are optional
            'category' => 'nullable|string|max:255', // Category is optional
            'priority' => 'nullable|string',
            'deadline' => 'nullable|date',
            //'progress' => 'required|integer|between:0,100', 
            //'is_completed' => 'required|boolean'
        ]);        

        $validatedData['user_id'] = auth()->id();
        Goal::create($validatedData);
        return redirect()->route('goals.index')
            ->with('success','Goal created successfully');
    }

    // Update
    public function edit($id) {
        $goal = Goal::findOrFail($id);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([            
            'title' => 'required|max:255', // Title required with the limit of 255 letters
            'notes' => 'nullable|max:1000', // Notes are optional
            'category' => 'nullable|string|max:255', // Category is optional
            'priority' => 'nullable|string',
            'deadline' => 'nullable|date',
            //'progress' => 'required|integer|between:0,100', 
            //'is_completed' => 'required|boolean'
        ]);        

        Goal::where('id', $id)->update($validatedData);
        return redirect()->route('goals.index')
            ->with('success','Goal updated successfully');
    }

    // Destroy
    public function destroy($id) {
        $goal = Goal::findOrFail($id);
        $goal->delete();
        return redirect()->route('goals.index')
            ->with('success','Goal deleted successfully');
    }    
}
