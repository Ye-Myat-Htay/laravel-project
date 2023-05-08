<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Models\User;

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

Route::post('/login', function() {
    $user = User::where("email", request()->email)->first();
    if($user) {
        if(password_verify(request()->password, $user->password)) {
            return $user->createToken("client")->plainTextToken;
        }
    }

    return response(["msg" => "Incorrect Login"], 403);
});

Route::apiResource('/categories', CategoryApiController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
