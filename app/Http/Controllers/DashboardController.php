<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tailor;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    $user = Auth::user();

    $tailor = $user->tailor; // ambil data tailor dari user
    $photos = $tailor ? $tailor->photos : collect(); // aman jika belum punya data

    return view('dashboard', compact('user', 'tailor', 'photos'));
}

}
