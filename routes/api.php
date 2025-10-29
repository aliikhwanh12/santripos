<?php
// routes/api.php
use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Route;
Route::prefix('api')->name('api.')->group(function () {
    Route::post('/deposit', [APIController::class, 'deposit'])->name('deposit');
    Route::post('/user', [APIController::class, 'user'])->name('user');
    Route::post('/sales', [APIController::class, 'sales'])->name('sales');
});