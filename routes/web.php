<?php

use App\Filament\Pages\LaporanAktivitas;
use App\Filament\Pages\LaporanBulanan;
use App\Filament\Pages\LaporanHarian;
use App\Http\Controllers\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class);

Route::prefix('/admin')->group(function () {
  Route::post('/laporan-harian/export', [LaporanHarian::class, "export"]);
  Route::post('/laporan-bulanan/export', [LaporanBulanan::class, "export"]);
  Route::post('/laporan-aktivitas/export', [LaporanAktivitas::class, "export"]);
});
