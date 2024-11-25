<?php

use App\Http\Controllers\FolioController;
use App\Http\Controllers\InvitadoController;

Route::post('/folios', [FolioController::class, 'store']);
Route::get('/folios/{numero_folio}', [FolioController::class, 'show']);

Route::post('/invitados', [InvitadoController::class, 'store']);
Route::put('/invitados/{id}', [InvitadoController::class, 'update']);
Route::get('/folios/{folio_id}/principal', [InvitadoController::class, 'getPrincipal']);