<?php

use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\SecurityController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use PhpParser\Node\Stmt\TryCatch;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/security', [SecurityController::class, 'edit'])->name('security.edit');

    Route::put('settings/password', [SecurityController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('user-password.update');

    Route::inertia('settings/appearance', 'settings/appearance')->name('appearance.edit');
});

Route::post('/createUser', function(Request $request){
    $name = $request -> name;
    $age = $request -> age;

    return response()-> json([
        'name' =>  $name,
        'age' => $age
    ]);
});

Route::get('/customApi', function(){
    return response()->json([
        'message' => 'customApi Response'
    ]);
});

Route::get('/users', function(){
    $user = User::all();
    return response()->json([
    'users' => $user
    ]);
});

// Route::get('/test-db', function () {
//     try {
//         DB::connection()->getPdo();
//         return "DB connected SuccessFull";
//     } catch (\Throwable $th) {
//         return "Db is not Connected";
//     }
// });
