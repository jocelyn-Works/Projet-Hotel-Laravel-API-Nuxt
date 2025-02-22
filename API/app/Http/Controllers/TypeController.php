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
//        $types = Type::all();
//        return response()->json($types);

        // Charger tous les types avec leurs images associées
        $types = Type::with('imageTypes')->get();

        // Ajouter les chemins d'accès aux images dans la réponse
        $typesWithImages = $types->map(function ($type) {
            $type->image_paths = $type->imageTypes->map(function ($imageType) {
                return asset('storage/' . $imageType->image);
            })->toArray();
            return $type;
        });

        return response()->json($typesWithImages);


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

//       dd($request->all());

        return response()->json([
            'message' => 'type of room created successfully!',
            'type' => $newType,
            'images_path' => $imagePaths
        ], 201);
    }

    public function updateType(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        // Valider les données reçues
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'images' => 'nullable|array',
            'images.*' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Trouver le type de chambre à mettre à jour
        $type = Type::findOrFail($id);

        // Mettre à jour les informations du type de chambre
        if (isset($validatedData['name'])) {
            $type->name = $validatedData['name'];
        }
        if (isset($validatedData['description'])) {
            $type->description = $validatedData['description'];
        }
        if (isset($validatedData['price'])) {
            $type->price = $validatedData['price'];
        }
        $type->save();

        $imagePaths = [];

        // Mettre à jour les images
        if ($request->hasFile('images')) {
            // Supprimer les anciennes images si nécessaire
            $type->imageTypes()->delete();

            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('typeRoom', $imageName, 'public');

                    $type->imageTypes()->create([
                        'image' => $path,
                    ]);

                    $imagePaths[] = asset('storage/' . $path);
                }
            }
        }

        return response()->json([
            'message' => 'Type of room updated successfully!',
            'type' => $type,
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
