<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserImage;


//Cтворюю гет запит на отримання даних з бази даних
Route::get('/users', function () {
    $users = User::withCount('images')
        ->orderBy('images_count', 'desc')
        ->get();

    return response()->json($users);
});

//Створюю пост запит для добавлення записів в базу даних, заповнюючи певні поля
Route::post('/users', function (Request $request) {
    $user = User::create([
        'name' => $request->input('name'),
        'city' => $request->input('city'),
    ]);

    $user->images()->create([
        'image' => $request->input('image'),
    ]);

    return response()->json($user);
});





//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
