<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CampaignController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  function () {
    return redirect('/campaigns');
});
Route::group(['namespace' => 'Frontend', 'prefix' => 'campaigns'], function () {
    Route::get('/', [CampaignController::class, 'index'])->name('campaigns.list');
    Route::get('/create', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::get('/{id}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
});