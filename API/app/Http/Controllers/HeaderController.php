<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{

    //  -----------------------  show Header with image url   ----------------------- //
    public function showHeader(): \Illuminate\Http\JsonResponse
    {
        $headers = Header::all();

        foreach ($headers as $header) {

            if ($header->image) {  // add image a  URL
                $header->image_url = url('storage/' . $header->image);
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
            'content' =>'nullable|string'
        ]);
        $header = Header::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($header->image && Storage::disk('public')->exists('headers/' . $header->image)) {
                Storage::disk('public')->delete('headers/' . $header->image);
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
        return response()->json(Header::all());
    }
}
