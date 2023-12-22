<?php

use App\Http\Controllers\Api\Appointment;
use App\Http\Controllers\Api\AuthControllers_api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Patient\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|Verb          Path                             Action  Route Name
|GET           /associates                      index   associates.index
|GET           /associates/create               create  associates.create
|POST          /associates                      store   associates.store
|GET           /associates/{associates}         show    associates.show
|GET           /associates/{associates}/edit    edit    associates.edit
|PUT|PATCH     /associates/{associates}         update  associates.update
|DELETE        /associates/{associates}         destroy associates.destroy
|--------------------------------------------------------------------------
|Roles
|--------------------------------------------------------------------------
|super-admin
|Branch-manager
|Receptionist
|Call-center
|Hr
|Lab
|Doctor
|Accountant
|Stocker
|Operation
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//--- All Apis


Route::post('login', [AuthControllers_api::class, 'login'])->middleware('checkApiPass');

Route::group(['middleware' => ['auth:sanctum','checkApiPass']], function () {
    Route::resource('appointment', Appointment::class)->middleware('ability:Super-admin,Call-center');

});
