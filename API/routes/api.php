<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//Users***************************************************************************************************************
Route::prefix('user')->controller(UserController::class)->group(function () {
    // Tous les users avec leurs categories = /product
    Route::get('/', 'usershow'); 

    // Recuperer un utilisateur par son id
    Route::get('/{id}',  'userShowid');

    // Modifier un utilisateur par son id
    Route::put('/update/{id}', 'updateUser')->middleware('auth:sanctum');

    // crée un users
    Route::post('/post',  'postUser');

    // supprimer un user
    Route::delete('delete/{id}', 'deleteUser')->middleware('auth:sanctum');


    // recupère un user avec ses toutes ces commandes
    Route::get('/{id}/Orders/', 'getOrdersByUserId')->middleware('auth:sanctum');

});//*******************************************************************************************************************
