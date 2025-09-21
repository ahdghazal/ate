<?php

namespace App\Http\Controllers;

use App\Models\WaterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaterController extends Controller
{
    public function logWater(Request $request)
    {
        $request->validate(['liters' => 'required|numeric|min:0.1']);

        $log = WaterLog::create([
            'user_id' => Auth::id(),
            'liters' => $request->liters,
        ]);

        return response()->json(['message' => 'Water logged', 'log' => $log]);
    }

    public function today()
    {
        $total = WaterLog::where('user_id', Auth::id())
                         ->whereDate('created_at', now())
                         ->sum('liters');

        return response()->json([
            'total_liters' => $total,
            'goal' => '2L',
            'remaining' => max(0, 2 - $total)
        ]);
    }
}
