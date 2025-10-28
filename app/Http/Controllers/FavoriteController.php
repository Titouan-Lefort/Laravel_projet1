<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request): JsonResponse
    {
        $universId = $request->input('univers_id');
        $userId = Auth::id();

        $favorite = Favorite::where('user_id', $userId)
            ->where('univers_id', $universId)
            ->first();

        if ($favorite) {
            $favorite->delete();

            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'univers_id' => $universId,
            ]);

            return response()->json(['status' => 'added']);
        }
    }
}
