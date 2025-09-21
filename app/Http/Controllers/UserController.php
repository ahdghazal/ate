<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me()
    {
        $user = Auth::user();
        $user->bmi = $user->calculateBMI();
        $user->save();

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update($request->only(['weight', 'height', 'goal']));
        $user->bmi = $user->calculateBMI();
        $user->save();

        return response()->json(['message' => 'Profile updated', 'user' => $user]);
    }
}

