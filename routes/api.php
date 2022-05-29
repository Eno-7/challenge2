<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('package',\App\Http\Controllers\PackageController::class);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('set-company-package', [\App\Http\Controllers\CompanyPackageController::class, 'setCompanyPackage']);
Route::get('checked-company-package', [\App\Http\Controllers\CompanyPackageController::class, 'getCompanyPackage'])
    ->middleware('auth:sanctum');


