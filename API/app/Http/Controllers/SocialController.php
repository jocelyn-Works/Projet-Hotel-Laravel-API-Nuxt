<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    // -----------------------    Social   ---------------------------------- //

    public function showSocial(): \Illuminate\Http\JsonResponse
    {
        $socials = Social::all();
        foreach ($socials as $social) {

            if ($social->icon) {
                $social->image_url = url('storage/' . $social->icon);
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

    public function updateSocial($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'url' =>'nullable|string'
        ]);
        $social = Social::findOrFail($id);

        if ($request->hasFile('icon')) {
            if ($social->icon && Storage::disk('public')->exists('socials/' . $social->icon)) {
                Storage::disk('public')->delete('socials/' .$social->icon);
            }

            $icon = $request->file('icon');

            $imageName = time() . '.' . $icon->getClientOriginalExtension();

            $path = $icon->storeAs('socials', $imageName, 'public');

            $validatedData['icon'] = $path;
        }

        $social->update($validatedData);

        return response()->json([
            'message' => 'Social updated successfully!',
            'Social' => $social,
        ], 201);

    }

    public function deleteSocial($id): \Illuminate\Http\JsonResponse
    {
        $deleteSocial = Social::findOrFail($id);
        $deleteSocial->delete();
        return response()->json(Social::all());
    }
}
