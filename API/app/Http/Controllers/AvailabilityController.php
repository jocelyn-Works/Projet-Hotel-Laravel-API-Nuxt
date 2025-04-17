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
            $query->whereBetween('start_date', [$dateDebut, $dateFin])
                ->orWhereBetween('end_date', [$dateDebut, $dateFin])
                ->orWhere(function ($q) use ($dateDebut, $dateFin) {
                    $q->where('start_date', '<=', $dateDebut)
                        ->where('end_date', '>=', $dateFin);
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
                    'image_paths' => $type->imageTypes->pluck('image')->map(function($path) {
                        return asset('storage/' . $path);
                    }),
                    'rooms' => $rooms->pluck('id'),
                ];
            })->values();

        return response()->json([
            'typesDisponibles' => $typesDisponibles
        ]);
    }
}
