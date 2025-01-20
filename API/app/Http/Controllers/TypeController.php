<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\Hotel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    public function showTypes(): \Illuminate\Http\JsonResponse
    {
        $types = Type::all();
        return response()->json($types);

    }

    public function addType(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

        ]);

        $newType = new Type([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
        ]);
        $newType->save();

       $imagePaths = [];

       foreach ($request->file('images') as $image) {

           if ($image->isValid()) {

               $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();

               $path = $image->storeAs('typeRoom', $imageName, 'public');

               $newType->imageTypes()->create([
                   'image' => $path,
               ]);

               $imagePaths[] = asset('storage/' . $path);
           }
       }

       dd($request->all());

        return response()->json([
            'message' => 'type of room created successfully!',
            'type' => $newType,
            'images_path' => $imagePaths
        ], 201);
    }

    public function deleteType(int $id): \Illuminate\Http\JsonResponse
    {
        $deleteType = Type::findOrFail($id);
        $deleteType->delete();
        return response()->json(Type::all());
    }
}
