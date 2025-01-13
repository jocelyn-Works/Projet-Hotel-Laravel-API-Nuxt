<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('User')->controller(UserController::class)->group(function () {
    // Tous les users avec leurs categories = /product
    Route::get('/', 'usershow');

    // Recuperer un utilisateur par son id
    Route::get('/{id}',  'userShowid');

    // Modifier un utilisateur par son id
    Route::put('/update/{id}', 'updateUser')->middleware('auth:sanctum');

    // crée un users
    Route::post('/post',  'postUser');

    // supprimer un user
   // Route::delete('delete/{id}', 'deleteUser')->middleware('auth:sanctum', AdminUser::class);


    // recupère un user avec ses toutes ces commandes
   // Route::get('/{id}/Orders/', 'getOrdersByUserId')->middleware('auth:sanctum', AdminUser::class);

});//*******************************************************************************************************************