<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyStat;
use App\Models\Goal;

class DashboardController extends Controller
{
    // Calculate average time and score
    public function Dashboard() {
        $averageTimeSpent = DailyStat::avg('time');
        $averageQualityScore = DailyStat::avg('quality_score');
        $recentGoal = Goal::latest()->first();

        return view('dashboard', compact('averageTimeSpent','averageQualityScore', 'recentGoal'));
    }
}
