<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BookingController;


// *************************************   HotelController    *******************************************************
Route::prefix('hotel')->controller(\App\Http\Controllers\HotelController::class)->group(function () {

    // afficher les infos de hotel
    Route::get('/all', 'showHotel');

    // crée un hotel
    Route::post('/new',  'newHotel');

    // modifier hotel
    Route::post('/update/{id}', 'updateHotel');

    // suprimer info hotel
    Route::delete('/delete/{id}', 'deleteHotel');


});

//********************************************  HeaderController   *******************************************************************
Route::prefix('header')->controller(\App\Http\Controllers\HeaderController::class)->group(function () {
    // Header
    // afficher les infos de header
    Route::get('/all', 'showHeader');

    // crée un header
    Route::post('/new',  'newHeader');

    // modifier le header
    Route::post('/update/{id}', 'updateHeader');

    // suprimer header
    Route::delete('/delete/{id}', 'deleteHeader');
});





//********************************************  MainController   *******************************************************************
Route::prefix('main')->controller(\App\Http\Controllers\MainController::class)->group(function () {
    // Header
    // afficher les infos de header
    Route::get('/all', 'showMain');

    // crée un header
    Route::post('/new',  'newMain');

    // modifier le header
    Route::post('/update/{id}', 'updateMain');

    // suprimer header
    Route::delete('/delete/{id}', 'deleteMain');

});//******************

//********************************************  SocialController   *******************************************************************
Route::prefix('social')->controller(\App\Http\Controllers\SocialController::class)->group(function () {
    // Header
    // afficher les infos de header
    Route::get('/all', 'showSocial');

    // crée un header
    Route::post('/new',  'newSocial');

    // modifier le header
    Route::post('/update/{id}', 'updateSocial');

    // suprimer header
    Route::delete('/delete/{id}', 'deleteSocial');

});//******************




});



//***************************************   typeController    **************************************************************
Route::prefix('type')->controller(\App\Http\Controllers\TypeController::class)->group(function () {
    // Tous les type de chambres
    Route::get('/all', 'showTypes');

    // ajouter un type de chambre
    Route::post('/new',  'addType');

    // Mettre à jour un type de chambre
    Route::post('/update/{id}', 'updateType');

    // Mettre à jour image par image ajouter par eric
    Route::post('/updateImage/{id}', 'updateTypeImage');

    // Supprime un type de chambre
    Route::delete('/delete/{id}', 'deleteType');

});


Route::prefix('connexion')->controller(\App\Http\Controllers\AuthController::class)->group(function () {
    // Se créer un compte/Register
    Route::post('/register', 'register')->name('register');

    // Se connecter/Login
    Route::post('/login', 'login')->name('login');

    // Se déconnecter/Logout
    Route::post('/logout', 'logout')->middleware('auth:sanctum');


});

Route::prefix('user')->controller(UserController::class)->group(function () {
    // Tous les users avec leurs categories = /product
    Route::get('/all', 'userShow');

    // Recuperer un utilisateur par son id
    Route::get('/{id}',  'userShowId');

    // Modifier un utilisateur par son id
    Route::post('/update/{id}', 'updateUser');

    // crée un users
    Route::post('/post',  'postUser');

    // supprimer un user
    Route::delete('/delete/{id}', 'deleteUser');

});

    // retourne utilisateurs connectés

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->get('/user/profile', [UserController::class, 'profile']);


Route::post('/check-availability', [AvailabilityController::class, 'check']);



Route::prefix('service')->controller(\App\Http\Controllers\ServiceController::class)->group(function () {
    // affiche les service
    Route::get('/show', 'showService')->name('showService');



});


Route::post('/bookings', [BookingController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user/bookings', [BookingController::class, 'userBookings']);

    // Supprime un type de chambre
    Route::delete('/delete/{id}', 'deleteType');

});




