<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Models\siswa;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('dtlstts', [SiswaController::class, 'cekDetail'])->name('cekDetail');
Route::post('siswa', [SiswaController::class, 'storeAPI']);
Route::get('pendataan', function () {
    return response()->json(
        [
            'data' => siswa::all(),
        ]
    );
});

Route::get('kelasByAngkatan', [KelasController::class, 'getByAngkatan'])->name('kelasByAngkatan');
Route::post('cekLink', [\App\Http\Controllers\ShortlinkController::class, 'cekLink'])->name('cekLink');
Route::post('links',[\App\Http\Controllers\ShortlinkController::class,'store']);
