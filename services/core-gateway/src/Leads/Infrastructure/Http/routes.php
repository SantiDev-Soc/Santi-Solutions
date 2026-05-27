<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Http\routes;

use Illuminate\Support\Facades\Route;
use Santi\Leads\Infrastructure\Http\Controllers\LeadController;

// Esta ruta será: http://localhost:8001/api/leads/capture
Route::post('/capture', LeadController::class);

// (Opcional) Puedes dejar la de test para verificar que el GET sigue funcionando
Route::get('/test', function() {
    return response()->json(['message' => 'Rutas de Leads activas']);
});

