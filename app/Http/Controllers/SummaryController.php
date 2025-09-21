<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function today()
{
    $user = auth()->user();

    $foodCalories = $user->foodLogs()
        ->whereDate('created_at', today())
        ->sum('calories');

    $burned = $user->workouts()
        ->whereDate('created_at', today())
        ->sum('calories_burned');

    $water = $user->waterLogs()
        ->whereDate('created_at', today())
        ->sum('liters');

    return [
        'calories_consumed' => $foodCalories,
        'calories_burned' => $burned,
        'net_calories' => $foodCalories - $burned,
        'bmi' => $user->bmi,
        'goal' => $user->goal,
        'water_intake' => $water,
        'water_goal' => 2
    ];
}

}
