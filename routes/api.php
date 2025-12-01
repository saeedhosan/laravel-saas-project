<?php

declare(strict_types=1);

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

use App\Http\Controllers\API\MailServerController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/me', 'APIController@me')->name('profile.me');
Route::apiResource('tasks', TaskController::class);

Route::post('/send-email', [MailServerController::class, 'send']);

// Route::any('{any?}', function ($any = null) {
//     return response()->json([
//         'status' => 'error',
//         'message' => "The api endpoint '$any' could not be found."
//     ], 404);
// })->where('any', '.*');
