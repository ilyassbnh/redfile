<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index(Request $request) {
        $favorites = Favorite::where('user_id', $request->user()->id)->get();
        return response()->json($favorites);
    }

    public function store(Request $request) {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $favorite = Favorite::create([
            'user_id' => $request->user()->id,
            'hotel_id' => $request->hotel_id,
        ]);

        return response()->json(['success' => 'Hotel added to favorites.', 'favorite' => $favorite]);
    }

    public function destroy($id) {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json(['success' => 'Favorite removed successfully.']);
    }
}
