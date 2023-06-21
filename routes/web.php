<?php

use Illuminate\Support\Facades\Route;


//в роут добавляю лаконічний ресурсний контроллер, який буде зручно масштабувати по CRUD
Route::resource('/users', App\Http\Controllers\UserController::class)->withTrashed();

