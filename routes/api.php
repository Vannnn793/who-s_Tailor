<?php

use App\Models\Jasa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TailorController;
use App\Http\Controllers\Api\PortfolioController;



Route::middleware('web')
     ->group(base_path('routes/web.php'));
