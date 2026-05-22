<?php
declare(strict_types=1);

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/test', LeadController::class);

