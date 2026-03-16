<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;

Route::get("/", function () {
    return view("welcome");
})->name("landing");

Route::get("/pengajuan", [PengajuanController::class, "index"])->name("pengajuan.index");
Route::post("/pengajuan", [PengajuanController::class, "store"])->name("pengajuan.store");
Route::get("/pengajuan/{id}", [PengajuanController::class, "show"])->name("pengajuan.show");
Route::get("/pengajuan/{id}/edit", [PengajuanController::class, "edit"])->name("pengajuan.edit");
Route::put("/pengajuan/{id}", [PengajuanController::class, "update"])->name("pengajuan.update");
Route::delete("/pengajuan/{id}", [PengajuanController::class, "destroy"])->name("pengajuan.destroy");
Route::put("/pengajuan/{id}/status", [PengajuanController::class, "updateStatus"])->name("pengajuan.updateStatus");

