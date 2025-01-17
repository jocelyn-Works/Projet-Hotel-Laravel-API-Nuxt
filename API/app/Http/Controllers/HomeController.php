<?php

namespace App\Http\Controllers;
use App\Models\Header;
use Illuminate\Routing\Controller;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // -------------------   Hotel  ----------------------  //
    public function showHotel(): \Illuminate\Http\JsonResponse
    {
        $hotels = Hotel::all();
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
         $hotel = Hotel::findOrFail($id);
         $hotel->update($updateHotel);
         return response()->json($updateHotel);

    }

    public function deleteHotel($id): \Illuminate\Http\JsonResponse
    {
        $deleteHotel = Hotel::findOrFail($id);
        $deleteHotel->delete();
        return response()->json(Hotel::all());
    }



    //  -----------------------  Header   ----------------------- //
    public function showHeader(): \Illuminate\Http\JsonResponse
    {
        $header = Header::all();
        return response()->json($header);
    }

    public function newHeader(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'content' =>'required|string'

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('headers', $imageName, 'public');

            $validatedData['image'] = $path;
        }

        $header = new Header($validatedData);

        $header->save();

        return response()->json([
            'message' => 'Header created successfully!',
            'hotel' => $header
        ], 201);
    }

    public function updateHeader($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'content' =>'required|string'
        ]);
        $header = Header::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($header->image && Storage::disk('public')->exists('headers/' . $header->image)) {
                Storage::disk('public')->delete('headers/' .$header->image);
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('headers', $imageName, 'public');

            $validatedData['image'] = $path;
        }

        $header->update($validatedData);

        return response()->json([
            'message' => 'Header updated successfully!',
            'header' => $header,
        ], 201);

    }

    public function deleteHeader($id): \Illuminate\Http\JsonResponse
    {
        $deleteHeader = Header::findOrFail($id);
        $deleteHeader->delete();
        return response()->json(Hotel::all());
    }
}
