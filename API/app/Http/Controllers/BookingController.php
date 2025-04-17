<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Str;
use App\Models\Room;
class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $roomId = $request->room_id;
        $start = $request->start_date;
        $end = $request->end_date;

        // 🔒 Vérifie s'il y a un chevauchement de réservation
        $existeDeja = Booking::where('room_id', $roomId)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                    });
            })
            ->exists();

        if ($existeDeja) {
            return response()->json([
                'message' => 'Cette chambre est déjà réservée sur ces dates.'
            ], 409); // 409 Conflict
        }

        // ✅ Réservation autorisée
        $booking = Booking::create([
            'id' => Str::uuid(),
            'user_id' => $request->user()->id,
            'room_id' => $roomId,
            'start_date' => $start,
            'end_date' => $end,
            'quantity' => $request->quantity ?? 1,
            'status' => 'Pending',
        ]);

        return response()->json([
            'message' => 'Réservation effectuée avec succès',
            'booking' => $booking
        ]);
    }
    public function userBookings(Request $request)
    {
        $user = $request->user(); // récupère l'utilisateur connecté

        $bookings = Booking::with(['room.type']) // récupère les relations room et type
        ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'bookings' => $bookings
        ]);
    }
}
