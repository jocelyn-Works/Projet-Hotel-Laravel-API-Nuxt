<?php

namespace App\Http\Controllers;
use App\Models\Header;
use App\Models\Main;
use App\Models\Social;
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
        foreach ($hotels as $hotel) {

            if ($hotel->image) {
                $hotel->image_url = Storage::url($hotel->image);
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
        $headers = Header::all();

        foreach ($headers as $header) {

            if ($header->image) {
                $header->image_url = Storage::url($header->image);
            }
        }

        return response()->json($headers);
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




    //  -----------------------  Main  ----------------------- //
    public function showMain(): \Illuminate\Http\JsonResponse
    {
        $mains = Main::all();

        foreach ($mains as $main) {

            if ($main->image) {
                $main->image_url = Storage::url($main->image);
            }
        }

        return response()->json($mains);
    }

    public function newMain(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'content' =>'required|string'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('mains', $imageName, 'public');

            $validatedData['image'] = $path;
        }

        $main = new Main($validatedData);

        $main->save();

        return response()->json([
            'message' => 'Maincreated successfully!',
            'main' => $main
        ], 201);
    }

    public function updateMain($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'content' =>'required|string'
        ]);
        $main = Main::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($main->image && Storage::disk('public')->exists('headers/' . $main->image)) {
                Storage::disk('public')->delete('mainss/' .$main->image);
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $path = $image->storeAs('mains', $imageName, 'public');

            $validatedData['image'] = $path;
        }

        $main->update($validatedData);

        return response()->json([
            'message' => 'Main updated successfully!',
            'Main' => $main,
        ], 201);

    }

    public function deleteMain($id): \Illuminate\Http\JsonResponse
    {
        $deleteHeader = Main::findOrFail($id);
        $deleteHeader->delete();
        return response()->json(Main::all());
    }

    // -----------------------    Social   ---------------------------------- //

    public function showSocial(): \Illuminate\Http\JsonResponse
    {
        $socials = Social::all();
        foreach ($socials as $social) {

            if ($social->icon) {
                $social->image_url = Storage::url($social->icon);
            }
        }
        return response()->json($socials);
    }

    public function newSocial(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'url' =>'required|string'
        ]);
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('socials', $imageName, 'public');
            $validatedData['icon'] = $path;
        }
        $social = new Social($validatedData);
        $social->save();

        return response()->json([
            'message' => 'Social created successfully!',
            'main' => $social
        ], 201);
    }
}
