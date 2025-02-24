<?php

namespace App\Http\Controllers;
use App\Models\Header;
use App\Models\Main;
use App\Models\Social;
use Illuminate\Routing\Controller;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
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

    public function deleteHotel($id): \Illuminate\Http\JsonResponse
    {
        $deleteHotel = Hotel::findOrFail($id);
        $deleteHotel->delete();
        return response()->json(Hotel::all());
    }



}
