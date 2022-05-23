<?php
// use App\Models\Members;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\AuthController;
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

//public routes
Route::prefix('/member')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('logout', function(){});
});
Route::post('/add-member', [MembersController::class, 'addMember']);
Route::get('/members', [MembersController::class, 'index']);




//protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::delete('/delete-member/{id}', [MembersController::class, 'deleteMember']);
    Route::get('/find-member-id/{id}', [MembersController::class, 'findMemberById']);
    Route::get('/find-member-name/{name}', [MembersController::class, 'findMemberByName']);
    Route::get('/find-member-gender/{index_gender}', [MembersController::class, 'findMemberByJenisKelamin']);
    Route::get('/find-member-status-aktif/{index_status_aktif}', [MembersController::class, 'findMemberByStatusAktif']);
    Route::get('/find-member-status-iuran/{index_status_iuran}', [MembersController::class, 'findMemberByStatusIuran']);
    Route::put('/update-member-data/{id}', [MembersController::class, 'updateMemberData']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
