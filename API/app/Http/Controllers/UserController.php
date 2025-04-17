<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userShow(): \Illuminate\Http\JsonResponse
    {
        $users = User::all();

        return response()->json(
            $users,
        );
    }


    public function userShowId($id): JsonResponse
    {

        $users=User::find($id);

        return response()->json([
            'users'=>$users
        ]);

    }

    public function postUser(Request $request): JsonResponse
    {

        // Valider les données reçues
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        // Créer un nouvel utilisateur
        $newUser = new User([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);
        $newUser->save();

//        // Gérer l'image de profil si elle est fournie
//        if ($request->hasFile('profile_image')) {
//            $image = $request->file('profile_image');
//            if ($image->isValid()) {
//                $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
//                $path = $image->storeAs('profileImages', $imageName, 'public');
//
//                $newUser->profile_image = $path;
//                $newUser->save();
//            }
//        }

        return response()->json([
            'message' => 'User created successfully!',
            'user' => $newUser,
        ], 201);

    }

    public function updateUser($id, Request $request): JsonResponse
    {

        // Valider les données reçues
        $validatedData = $request->validate([
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'sometimes|string',
            'address' => 'sometimes|string',
        ]);

        // Trouver l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Mettre à jour les informations de l'utilisateur
        if (isset($validatedData['first_name'])) {
            $user->first_name = $validatedData['first_name'];
        }
        if (isset($validatedData['last_name'])) {
            $user->last_name = $validatedData['last_name'];
        }
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

//        // Gérer l'image de profil si elle est fournie
//        if ($request->hasFile('profile_image')) {
//            $image = $request->file('profile_image');
//            if ($image->isValid()) {
//                $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
//                $path = $image->storeAs('profileImages', $imageName, 'public');
//
//                $user->profile_image = $path;
//            }
//        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully!',
            'user' => $user,
        ], 201);

    }

    public function deleteUser($id): JsonResponse
    {

        $users = User::find($id);
        $users->delete();

        return response()->json([
            'users'=>$this->userShow()
        ]);


    }
}
