<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiGatewayController;


Route::any('{any}', [ApiGatewayController::class, 'handle'])->where('any', '.*');

