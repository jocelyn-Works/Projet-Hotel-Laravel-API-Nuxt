<?php

namespace App\Http\Controllers;

use App\Models\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    //  -----------------------  Main  ----------------------- //
    public function showMain(): \Illuminate\Http\JsonResponse
    {
        $mains = Main::all();

        foreach ($mains as $main) {

            if ($main->image) {
                $main->image_url = url('storage/' . $main->image);
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
            'content' =>'nullable|string'
        ]);
        $main = Main::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($main->image && Storage::disk('public')->exists('mains/' . $main->image)) {
                Storage::disk('public')->delete('mains/' .$main->image);
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

}
