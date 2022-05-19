<?php
// use App\Models\Members;
use App\Http\Controllers\MembersController;
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

// Route::get('/members', function(){
//     return Members::all();
// }); pindah ke MembersController

// Route::post('/add-member', function(){
//     return Members::create([
//         'nomor_induk' => '01232',
//         'name' => 'agung',
//         'jenis_kelamin' => 'pria'
//     ]);
// }); pindah ke MembersController

Route::get('/members', [MembersController::class, 'index']);
Route::post('/add-member', [MembersController::class, 'addMember']);
Route::get('/find-member-id/{id}', [MembersController::class, 'findMemberById']);
Route::get('/find-member-name/{name}', [MembersController::class, 'findMemberByName']);
Route::get('/find-member-gender/{index_gender}', [MembersController::class, 'findMemberByJenisKelamin']);
Route::get('/find-member-status-aktif/{index_status_aktif}', [MembersController::class, 'findMemberByStatusAktif']);
Route::get('/find-member-status-iuran/{index_status_iuran}', [MembersController::class, 'findMemberByStatusIuran']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
