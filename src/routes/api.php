<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\WorkController;
use Illuminate\Auth\Events\Registered;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',function (Request $request) {
    $credentials = $request -> only('email','password');

    if (Auth::attempt($credentials)){
        $user = Auth::user();
        $token = $user -> createToken('token-name')-> plainTextToken;
        return response() -> json(['token' => $token]);
    }

    return response() -> json(['error' => 'Unauthorized'],401);
});

Route::apiResource('/register', RegisteredUserController::class);

Route::post('/', [WorkController::class, 'start']);
Route::post('/', [WorkController::class, 'end']);