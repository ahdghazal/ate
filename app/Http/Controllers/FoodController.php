<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    // List foods
    public function index()
    {
        return Food::all();
    }

    // Add food log
    public function logFood(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
            'quantity' => 'required|integer|min:1',
        ]);

        $log = FoodLog::create([
            'user_id' => Auth::id(),
            'food_id' => $request->food_id,
            'meal_type' => $request->meal_type,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Food logged', 'log' => $log]);
    }

    // Get today’s food logs
    public function today()
    {
        $logs = FoodLog::where('user_id', Auth::id())
                       ->whereDate('created_at', now())
                       ->with('food')
                       ->get();

        $total = $logs->sum(fn($log) => $log->quantity * $log->food->calories);

        return response()->json([
            'logs' => $logs,
            'total_calories' => $total
        ]);
    }
}
