<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodLogController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'food_id' => 'required|exists:foods,id',
        'meal_type' => 'required|in:breakfast,lunch,dinner,snacks',
        'quantity' => 'required|numeric'
    ]);

    $food = Food::findOrFail($request->food_id);
    $calories = ($request->quantity / 100) * $food->calories_per_100g;

    $log = FoodLog::create([
        'user_id' => auth()->id(),
        'food_id' => $food->id,
        'meal_type' => $request->meal_type,
        'quantity' => $request->quantity,
        'calories' => round($calories),
    ]);

    return $log;
}

}
