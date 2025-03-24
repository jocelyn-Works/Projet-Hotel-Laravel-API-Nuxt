<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class AvailabilityController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
        ]);

        $dateDebut = $request->input('dateDebut');
        $dateFin = $request->input('dateFin');

        $chambresReservees = Booking::where(function ($query) use ($dateDebut, $dateFin) {
            $query->whereBetween('started_at', [$dateDebut, $dateFin])
                ->orWhereBetween('ended_at', [$dateDebut, $dateFin])
                ->orWhere(function ($q) use ($dateDebut, $dateFin) {
                    $q->where('started_at', '<=', $dateDebut)
                        ->where('ended_at', '>=', $dateFin);
                });
        })->pluck('room_id');

        $chambresDisponibles = Room::whereNotIn('id', $chambresReservees)
            ->with('type')
            ->get();

        $typesDisponibles = $chambresDisponibles
            ->groupBy('type.id')
            ->map(function ($rooms) {
                $type = $rooms->first()->type;
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'description' => $type->description,
                    'price' => $type->price,
                    'disponibles' => $rooms->count(),
                ];
            })->values();

        return response()->json([
            'typesDisponibles' => $typesDisponibles
        ]);
    }
}
