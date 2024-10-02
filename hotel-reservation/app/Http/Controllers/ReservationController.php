<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Afficher toutes les réservations de l'utilisateur
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return response()->json($reservations);
    }

    // Créer une nouvelle réservation
    public function store(Request $request)
    {
        $request->validate([
            'hotel_name' => 'required|string',
            'reservation_date' => 'required|date',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'hotel_name' => $request->hotel_name,
            'reservation_date' => $request->reservation_date,
        ]);

        return response()->json($reservation, 201);
    }
}
