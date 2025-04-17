<?php

namespace App\Http\Controllers;
use App\Models\Header;
use App\Models\Main;
use App\Models\Social;
use Illuminate\Routing\Controller;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// API/app/Http/Controllers/HotelController.php
/**
 * @OA\Info(title="API Hotel", version="1.0")
 */


class HotelController extends Controller
{
    /**
     * Afficher les infos de l'hôtel
     *
     * @OA\Get(
     *     path="/api/hotel/all",
     *     tags={"Hotel"},
     *     summary="Afficher les informations de l'hôtel",
     *     @OA\Response(
     *         response=200,
     *         description="Succès"
     *     ),
     * )
     */
    // -------------------   Hotel  ----------------------  //
    public function showHotel(): \Illuminate\Http\JsonResponse
    {
        $hotels = Hotel::all();
        foreach ($hotels as $hotel) {

            if ($hotel->image) {
                $hotel->image_url = url('storage/' . $hotel->image);
            }
        }
        return response()->json($hotels);
    }

    /**
     * Créer un nouvel hôtel
     *
     * @OA\Post(
     *     path="/api/hotel/new",
     *     tags={"Hotel"},
     *     summary="Créer un nouvel hôtel",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name", "street", "city", "phone_number", "email", "image"},
     *                 @OA\Property(property="name", type="string", example="Hôtel Artichaut"),
     *                 @OA\Property(property="street", type="string", example="14 rue de la Paix"),
     *                 @OA\Property(property="city", type="string", example="Paris"),
     *                 @OA\Property(property="phone_number", type="string", example="0123456789"),
     *                 @OA\Property(property="email", type="string", example="contact@hotel.fr"),
     *                 @OA\Property(property="image", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hôtel créé avec succès"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erreur de validation"
     *     )
     * )
     */
    public function newHotel(Request $request): \Illuminate\Http\JsonResponse
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'street' => 'required|string',
            'city' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|string|email|unique:hotels,email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('hotel', $imageName, 'public');

            $validatedData['image'] = $path;
        }

        $hotel = new Hotel($validatedData);

        $hotel->save();

        return response()->json([
            'message' => 'Hotel created successfully!',
            'hotel' => $hotel
        ], 201);
    }

    /**
     * Mettre à jour un hôtel existant
     *
     * @OA\Post(
     *     path="/api/hotel/update/{id}",
     *     tags={"Hotel"},
     *     summary="Met à jour un hôtel existant",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'hôtel à mettre à jour",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", example="Nouveau nom de l'hôtel"),
     *                 @OA\Property(property="street", type="string", example="Nouvelle rue"),
     *                 @OA\Property(property="city", type="string", example="Nouvelle ville"),
     *                 @OA\Property(property="phone_number", type="string", example="0612345678"),
     *                 @OA\Property(property="email", type="string", example="nouveau@hotel.fr"),
     *                 @OA\Property(property="image", type="string", format="binary")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hôtel mis à jour avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hôtel non trouvé"
     *     )
     * )
     */
    public function updateHotel($id, Request $request): \Illuminate\Http\JsonResponse
    {

        $updateHotel = $request->validate([
            'name' => 'nullable|string|max:50',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'nullable|string|email|unique:hotels,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
         $hotel = Hotel::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($hotel->image && Storage::disk('public')->exists('hotel/' . $hotel->image)) {
                Storage::disk('public')->delete('hotel/' . $hotel->image);
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('hotel', $imageName, 'public');

            $updateHotel['image'] = $path;
        }

         $hotel->update($updateHotel);


        return response()->json([
            'message' => 'Hotel updated successfully!',
            'hotel' => $hotel,
        ], 201);


    }
    /**
     * Supprimer un hôtel
     *
     * @OA\Delete(
     *     path="/api/hotel/delete/{id}",
     *     tags={"Hotel"},
     *     summary="Supprimer un hôtel",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'hôtel à supprimer",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hôtel supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hôtel non trouvé"
     *     )
     * )
     */
    public function deleteHotel($id): \Illuminate\Http\JsonResponse
    {
        $deleteHotel = Hotel::findOrFail($id);
        $deleteHotel->delete();
        return response()->json(Hotel::all());
    }



}
