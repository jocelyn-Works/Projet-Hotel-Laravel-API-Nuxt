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



//    HomeController  Hotel  Headear Main Social ***************************************************************************************************************
Route::prefix('home')->controller(\App\Http\Controllers\HomeController::class)->group(function () {
    // Hotel
    // afficher les infos de hotel
    Route::get('/hotel', 'showHotel');

    // crée un hotel
    Route::post('/postHotel',  'newHotel');

    // modifier hotel
    Route::put('/updateHotel/{id}', 'updateHotel');

    // suprimer info hotel
    Route::delete('/deleteHotel/{id}', 'deleteHotel');


    // Header
    // afficher les infos de header
    Route::get('/header', 'showHeader');

    // crée un header
    Route::post('/postHeader',  'newHeader');

    // modifier le header
    Route::put('/updateHeader/{id}', 'updateHeader');

    // suprimer header
    Route::delete('/deleteHeader/{id}', 'deleteHeader');
});//*******************************************************************************************************************
